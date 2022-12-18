<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Theaters extends CI_Controller {

	private $table1 = 'theaters';

	public function __construct()
	{
		parent::__construct();
        //Cek_login::ceklogin();
		$this->load->model('Createtable');
		$this->load->model('Datatable_gugus');
	}

	public function index()
	{
        $this->Createtable->location('eadmin/theaters/table_show');
        $this->Createtable->table_name('tableku');
        $this->Createtable->create_row(["No","Foto","Nama"," Alamat"," Lokasi"," Telp"," Studio", "action"]);
        $this->Createtable->order_set('0, 7');
		$show = $this->Createtable->create();

		$data['datatable'] = $show;
        $this->load->view('templateadmin/head');
        $this->load->view('eadmin/theaters/view', $data);
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
                        'row' => ["foto","nama","alamat","lokasi","telp","studio"]
                    ],
                    'table-draw' => post('draw'),
                    'table-show' => [
                        'key' => 'id',
                        'data' => ["foto","nama","alamat","lokasi","telp","studio"]
                    ],
                    "action" => "standart",
                    'order' => [
                        'order-default' => ['id', 'ASC'],
                        'order-data' => $setorder,
                        'order-option' => [ "1"=>"foto", "2"=>"nama", "3"=>"alamat", "4"=>"lokasi", "5"=>"telp", "6"=>"studio", "7"=>"created_at", "8"=>"updated_at", "9"=>"delete_set"],
                    ],
                    
                ]
            );
            $this->Datatable_gugus->table_show();
        }elseif ($action == "update") {
            $data_row = $this->db->query("SELECT * FROM ".$this->table1." WHERE id = '".$keyword."'")->row();
            $data['form_data'] = $data_row;
            $this->load->view('templateadmin/head');
            $this->load->view('eadmin/theaters/edit', $data);
            $this->load->view('templateadmin/footer');
        }elseif ($action == "delete") {
            $hapus_data = $this->db->query("UPDATE ".$this->table1." SET delete_set = '1' WHERE id = '".post("id")."'");
        }
    }

    public function tambah_data()
    {
        $this->load->view('templateadmin/head');
        $this->load->view('eadmin/theaters/tambah');
        $this->load->view('templateadmin/footer');
    }


    public function simpan(){
        $foto = Form::getfile("foto", "assets/gambar/$this->table1/");
$nama = post("nama");
$alamat = post("alamat");
$lokasi = post("lokasi");
$telp = post("telp");
$studio = post("studio");

        

        $simpan = $this->db->query("
            INSERT INTO theaters
            (foto,nama,alamat,lokasi,telp,studio) VALUES ('$foto','$nama','$alamat','$lokasi','$telp','$studio')
        ");
    

        if($simpan){
            redirect('eadmin/theaters');
        }
    }

    public function update(){
          $key = post('id'); $foto = Form::getfile("foto", "assets/gambar/$this->table1/", $key, $this->table1);
$nama = post("nama");
$alamat = post("alamat");
$lokasi = post("lokasi");
$telp = post("telp");
$studio = post("studio");

        $simpan = $this->db->query("
            UPDATE theaters SET  foto = '$foto', nama = '$nama', alamat = '$alamat', lokasi = '$lokasi', telp = '$telp', studio = '$studio' WHERE id = '$key'
            ");
    

        if($simpan){
            redirect('eadmin/theaters');
        }
    }
    
    public function exls(array $data = [], array $headers = [], $fileName = 'data-theaters.xlsx')
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = ["No","Foto","Nama"," Alamat"," Lokasi"," Telp"," Studio", "action"];

        $calldata = ["foto","nama","alamat","lokasi","telp","studio"];

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
