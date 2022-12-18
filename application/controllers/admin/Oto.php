<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Oto extends CI_Controller {

	private $table1 = 'oto';

	public function __construct()
	{
		parent::__construct();
        //Cek_login::ceklogin();
		$this->load->model('Createtable');
		$this->load->model('Datatable_gugus');
	}

	public function index()
	{
        $this->Createtable->location('admin/oto/table_show');
        $this->Createtable->table_name('tableku');
        $this->Createtable->create_row(["no","tabel","roww","row tipe 2","row tipe","row name","Form name","view","edit","new","comand", "action"]);
        $this->Createtable->order_set('0, 11');
		$show = $this->Createtable->create();

		$data['datatable'] = $show;
        $this->load->view('templateadmin/head');
        $this->load->view('admin/oto/view', $data);
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
                        'row' => ["tbl","rw","rwt","rwt2","rwn","nf","vw","edt","nw","cmd"]
                    ],
                    'table-draw' => post('draw'),
                    'table-show' => [
                        'key' => 'id',
                        'data' => ["tbl","rw","rwt","rwt2","rwn","nf","vw","edt","nw","cmd"]
                    ],
                    "action" => "standart",
                    'order' => [
                        'order-default' => ['id', 'ASC'],
                        'order-data' => $setorder,
                        'order-option' => [ "1"=>"tbl", "2"=>"rw", "3"=>"rwt", "4"=>"rwt2", "5"=>"rwn", "6"=>"nf", "7"=>"vw", "8"=>"edt", "9"=>"nw", "10"=>"cmd", "11"=>"created_at", "12"=>"updated_at", "13"=>"delete_set", "14"=>"sh"],
                    ],
                    	"custome" => [
							"tbl" => [
									"key" => ['id','tbl'],
									"content" => "
											<a target='_blank' href='{{site_url}}eadmin/{{tbl}}/'>{{tbl}}</a> - 
											<a target='_blank' href='{{site_url}}admin/oto/ec/{{id}}/'>proses</a>
									",
							],
						]
                    
                ]
            );
            $this->Datatable_gugus->table_show();
        }elseif ($action == "update") {
            $data_row = $this->db->query("SELECT * FROM ".$this->table1." WHERE id = '".$keyword."'")->row();
            $data['form_data'] = $data_row;
            $this->load->view('templateadmin/head');
            $this->load->view('admin/oto/edit', $data);
            $this->load->view('templateadmin/footer');
        }elseif ($action == "delete") {
            $hapus_data = $this->db->query("UPDATE ".$this->table1." SET delete_set = '1' WHERE id = '".post("id")."'");
            if($hapus_data){
                exec('php gugus database');
            }
        }
    }

    public function tambah_data()
    {
        $this->load->view('templateadmin/head');
        $this->load->view('admin/oto/tambah');
        $this->load->view('templateadmin/footer');
    }

    public function ec($id = null){
        $e = $this->db->query("SELECT * FROM oto WHERE id = '$id' ")->row()->cmd;
        echo chmod();
        echo shell_exec('*****  php gugus database');
    }

    public function simpan(){
        $tbl = post("tbl");
        $rw = post("rw");
        $rwt = post("rwt");
        $rwt2 = post("rwt2");
        $rwn = post("rwn");
        $nf = post("nf");
        $vw = post("vw");
        $edt = post("edt");
        $nw = post("nw");
        $cmd = post("cmd");
        $sh = post("sh");

        $simpan = $this->db->query("
            INSERT INTO oto
            (tbl,rw,rwt,rwt2,rwn,nf,vw,edt,nw,cmd,sh) VALUES ('$tbl','$rw','$rwt','$rwt2','$rwn','$nf','$vw','$edt','$nw','$cmd','$sh')
        ");
        
        chmod(APPPATH, 0777);
    
        $rn = shell_exec('php gugus database && '.$cmd);
        
        echo $rn;

        if($simpan){
            chmod(APPPATH, 0755);
            redirect('admin/oto');
        }
        
    }

    public function update(){
          $key = post('id'); $tbl = post("tbl");
            $rw = post("rw");
            $rwt = post("rwt");
            $rwt2 = post("rwt2");
            $rwn = post("rwn");
            $nf = post("nf");
            $vw = post("vw");
            $edt = post("edt");
            $nw = post("nw");
            $cmd = post("cmd");
            $sh = post("sh");

        $simpan = $this->db->query("
            UPDATE oto SET  tbl = '$tbl', rw = '$rw', rwt = '$rwt', rwt2 = '$rwt2', rwn = '$rwn', nf = '$nf', vw = '$vw', edt = '$edt', nw = '$nw', cmd = '$cmd', sh = '$sh' WHERE id = '$key'
            ");
        
        chmod(APPPATH, 0777);
        
        if($simpan){
            if(exec('php gugus database && '.$cmd)){
                chmod(APPPATH, 0755);
                redirect('admin/oto');
            }
        }
    }
    
    public function exls(array $data = [], array $headers = [], $fileName = 'data-oto.xlsx')
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = ["no","tabel","roww","row tipe 2","row tipe","row name","Form name","view","edit","new","comand", "action"];

        $calldata = ["tbl","rw","rwt","rwt2","rwn","nf","vw","edt","nw","cmd"];

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
