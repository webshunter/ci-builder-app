<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Film extends CI_Controller {

	private $table1 = 'film';

	public function __construct()
	{
		parent::__construct();
        //Cek_login::ceklogin();
		$this->load->model('Createtable');
		$this->load->model('Datatable_gugus');
	}

	public function index()
	{
        $this->Createtable->location('eadmin/film/table_show');
        $this->Createtable->table_name('tableku');
        $this->Createtable->create_row(["no","cover","judul","producer","distributor", "action"]);
        $this->Createtable->order_set('0, 5');
		$show = $this->Createtable->create();

		$data['datatable'] = $show;
        $this->load->view('templateadmin/head');
        $this->load->view('eadmin/film/view', $data);
        $this->load->view('templateadmin/footer');
	}

	public function table_show($action = 'show', $keyword = '')
	{
		if ($action == "show") {
        
            if (isset($_POST['order'])): $setorder = $_POST['order']; else: $setorder = ''; endif;

            $this->Datatable_gugus->datatable(
                [
                    "table" => $this->table1,
                    "select" => [
						"*"
					],
                    'where' => [
                        ['delete_set', '=', '0']
                    ],
                    'limit' => [
                        'start' => post('start'),
                        'end' => post('length')
                    ],
                    'search' => [
                        'value' => $this->Datatable_gugus->search(),
                        'row' => ["cover","judul","producer","distributor"]
                    ],
                    'table-draw' => post('draw'),
                    'table-show' => [
                        'key' => 'id',
                        'data' => ["cover","judul","producer","distributor"]
                    ],
                    "action" => "standart",
                    'order' => [
                        'order-default' => ['id', 'ASC'],
                        'order-data' => $setorder,
                        'order-option' => [ "1"=>"cover", "2"=>"judul", "3"=>"deskripsi", "4"=>"producer", "5"=>"director", "6"=>"writer", "7"=>"cast", "8"=>"distributor", "9"=>"website", "10"=>"created_at", "11"=>"updated_at", "12"=>"delete_set"],
                    ],
                    
                ]
            );
            $this->Datatable_gugus->table_show();
        }elseif ($action == "update") {
            $data_row = $this->db->query("SELECT * FROM ".$this->table1." WHERE id = '".$keyword."'")->row();
            $data['form_data'] = $data_row;
            $this->load->view('templateadmin/head');
            $this->load->view('eadmin/film/edit', $data);
            $this->load->view('templateadmin/footer');
        }elseif ($action == "delete") {
            $hapus_data = $this->db->query("UPDATE ".$this->table1." SET delete_set = '1' WHERE id = '".post("id")."'");
        }
    }

    public function tambah_data()
    {
        $this->load->view('templateadmin/head');
        $this->load->view('eadmin/film/tambah');
        $this->load->view('templateadmin/footer');
    }


    public function simpan(){
        $cover = Form::getfile("cover", "assets/gambar/$this->table1/");
$judul = post("judul");
$deskripsi = post("deskripsi");
$producer = post("producer");
$director = post("director");
$writer = post("writer");
$cast = post("cast");
$distributor = post("distributor");
$website = post("website");

        

        $simpan = $this->db->query("
            INSERT INTO film
            (cover,judul,deskripsi,producer,director,writer,cast,distributor,website) VALUES ('$cover','$judul',\"$deskripsi\",'$producer','$director','$writer','$cast','$distributor','$website')
        ");
    

        if($simpan){
            redirect('eadmin/film');
        }
    }

    public function update(){
          $key = post('id'); $cover = Form::getfile("cover", "assets/gambar/$this->table1/", $key, $this->table1);
$judul = post("judul");
$deskripsi = post("deskripsi");
$producer = post("producer");
$director = post("director");
$writer = post("writer");
$cast = post("cast");
$distributor = post("distributor");
$website = post("website");

        $simpan = $this->db->query("
            UPDATE film SET  cover = '$cover', judul = '$judul', deskripsi = \"$deskripsi\", producer = '$producer', director = '$director', writer = '$writer', cast = '$cast', distributor = '$distributor', website = '$website' WHERE id = '$key'
            ");
    

        if($simpan){
            redirect('eadmin/film');
        }
    }
    
    public function exls(array $data = [], array $headers = [], $fileName = 'data-film.xlsx')
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = ["no","cover","judul","producer","distributor", "action"];

        $calldata = ["cover","judul","producer","distributor"];

        for ($i = 0, $l = sizeof($headers); $i < $l; $i++) {
            $sheet->setCellValueByColumnAndRow($i + 1, 1, $headers[$i]);
        }
        
        $qr = $this->db->query("SELECT * FROM $this->table1")->result();

        foreach($qr as $i => $vv){
            $j = 1;
            $sheet->setCellValueByColumnAndRow(0 + 1, ($i + 1 + 1), $i + 1);
            foreach ($calldata as $k => $v) { // column $j
                $sheet->setCellValueByColumnAndRow($j + 1, ($i + 1 + 1), $vv->$v);
                $j++;
            }
        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');

    }


}
