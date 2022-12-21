<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Project extends CI_Controller {

	private $table1 = 'project';

	public function __construct()
	{
		parent::__construct();
        Cek_login::ceklogin();
		$this->load->model('Createtable');
		$this->load->model('Datatable_gugus');
	}

	public function index()
	{
        $this->Createtable->location('admin/project/table_show');
        $this->Createtable->table_name('tableku');
        $this->Createtable->create_row(["no","nama","tanggal","keterangan","status","created at","updated at", "action"]);
        $this->Createtable->order_set('0, 7');
		$show = $this->Createtable->create();

		$data['datatable'] = $show;
        $this->load->view('templateadmin/head');
        $this->load->view('admin/project/view', $data);
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
                        'row' => ["nama","tanggal","keterangan","status","created_at","updated_at"]
                    ],
                    'table-draw' => post('draw'),
                    'table-show' => [
                        'key' => 'id',
                        'data' => ["nama","tanggal","keterangan","status","created_at","updated_at"]
                    ],
                    "action" => "standart",
                    'order' => [
                        'order-default' => ['id', 'ASC'],
                        'order-data' => $setorder,
                        'order-option' => [ "1"=>"nama", "2"=>"tanggal", "3"=>"keterangan", "4"=>"status", "5"=>"created_at", "6"=>"updated_at", "7"=>"delete_set"],
                    ],
                    
                ]
            );
            $this->Datatable_gugus->table_show();
        }elseif ($action == "update") {
            $data_row = $this->db->query("SELECT * FROM ".$this->table1." WHERE id = '".$keyword."'")->row();
            $data['form_data'] = $data_row;
            $this->load->view('templateadmin/head');
            $this->load->view('admin/project/edit', $data);
            $this->load->view('templateadmin/footer');
        }elseif ($action == "delete") {
            $hapus_data = $this->db->query("UPDATE ".$this->table1." SET delete_set = '1' WHERE id = '".post("id")."'");
        }
    }

    public function tambah_data()
    {
        $this->load->view('templateadmin/head');
        $this->load->view('admin/project/tambah');
        $this->load->view('templateadmin/footer');
    }

    public function simpan(){
        $nama = post("nama");
        $tanggal = post("tanggal");
        $keterangan = post("keterangan");
        $status = post("status");
        $simpan = $this->db->query("
            INSERT INTO project
            (nama,tanggal,keterangan,status) VALUES ('$nama','$tanggal','$keterangan','$status')
        ");
        if($simpan){
            redirect('admin/project');
        }
    }

    public function update(){
        $key = post('id'); $nama = post("nama");
        $tanggal = post("tanggal");
        $keterangan = post("keterangan");
        $status = post("status");
        $simpan = $this->db->query("
            UPDATE project SET  nama = '$nama', tanggal = '$tanggal', keterangan = '$keterangan', status = '$status' WHERE id = '$key'
        ");
        if($simpan){
            redirect('admin/project');
        }
    }

    public function exls(array $data = [], array $headers = [], $fileName = 'data-project.xlsx')
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $headers = ["no","nama","tanggal","keterangan","status","created at","updated at", "action"];
        $calldata = ["nama","tanggal","keterangan","status","created_at","updated_at"];
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
