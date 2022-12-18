<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class User extends CI_Controller {

	private $table1 = 'user';

	public function __construct()
	{
		parent::__construct();
        //Cek_login::ceklogin();
		$this->load->model('Createtable');
		$this->load->model('Datatable_gugus');
	}

	public function index()
	{
        $this->Createtable->location('admin/user/table_show');
        $this->Createtable->table_name('tableku');
        $this->Createtable->create_row(["no","foto","nama","level","username","password","passwordview","created at","updated at","delete set", "action"]);
        $this->Createtable->order_set('0, 9');
		$show = $this->Createtable->create();

		$data['datatable'] = $show;
        $this->load->view('templateadmin/head');
        $this->load->view('admin/user/view', $data);
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
                        'row' => ["foto","nama","level","username","password","passwordview","created_at","updated_at"]
                    ],
                    'table-draw' => post('draw'),
                    'table-show' => [
                        'key' => 'id',
                        'data' => ["foto","nama","level","username","password","passwordview","created_at","updated_at"]
                    ],
                    "action" => "standart",
                    'order' => [
                        'order-default' => ['id', 'ASC'],
                        'order-data' => $setorder,
                        'order-option' => [ "1"=>"foto", "2"=>"nama", "3"=>"level", "4"=>"username", "5"=>"password", "6"=>"passwordview", "7"=>"created_at", "8"=>"updated_at", "9"=>"delete_set"],
                    ],
                    
                ]
            );
            $this->Datatable_gugus->table_show();
        }elseif ($action == "update") {
            $data_row = $this->db->query("SELECT * FROM ".$this->table1." WHERE id = '".$keyword."'")->row();
            $data['form_data'] = $data_row;
            $this->load->view('templateadmin/head');
            $this->load->view('admin/user/edit', $data);
            $this->load->view('templateadmin/footer');
        }elseif ($action == "delete") {
            $hapus_data = $this->db->query("UPDATE ".$this->table1." SET delete_set = '1' WHERE id = '".post("id")."'");
        }
    }

    public function tambah_data()
    {
        $this->load->view('templateadmin/head');
        $this->load->view('admin/user/tambah');
        $this->load->view('templateadmin/footer');
    }


    public function simpan(){
        $foto = Form::getfile("foto", "assets/gambar/$this->table1/");
$nama = post("nama");
$level = post("level");
$username = post("username");
$password = md5(md5(post("password")));
$passwordview = post("passwordview");
$created_at = post("created_at");
$updated_at = post("updated_at");
$delete_set = post("delete_set");

        

        $simpan = $this->db->query("
            INSERT INTO user
            (foto,nama,level,username,password,passwordview,created_at,updated_at,delete_set) VALUES ('$foto','$nama','$level','$username','$password','$passwordview','$created_at','$updated_at','$delete_set')
        ");
    

        if($simpan){
            redirect('admin/user');
        }
    }

    public function update(){
          $key = post('id'); $foto = Form::getfile("foto", "assets/gambar/$this->table1/", $key, $this->table1);
$nama = post("nama");
$level = post("level");
$username = post("username");
$password = post("password");
            if($this->db->query("SELECT * FROM $this->table1 WHERE id = '$key'")->row()->password != post("password")){
                $password = md5(md5(post("$key")));
            }$password = md5(md5(post("password")));
$passwordview = post("passwordview");
$created_at = post("created_at");
$updated_at = post("updated_at");
$delete_set = post("delete_set");

        $simpan = $this->db->query("
            UPDATE user SET  foto = '$foto', nama = '$nama', level = '$level', username = '$username', password = '$password', passwordview = '$passwordview', created_at = '$created_at', updated_at = '$updated_at', delete_set = '$delete_set' WHERE id = '$key'
            ");
    

        if($simpan){
            redirect('admin/user');
        }
    }
    
    public function exls(array $data = [], array $headers = [], $fileName = 'data-user.xlsx')
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = ["no","foto","nama","level","username","password","passwordview","created at","updated at","delete set", "action"];

        $calldata = ["foto","nama","level","username","password","passwordview","created_at","updated_at"];

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
