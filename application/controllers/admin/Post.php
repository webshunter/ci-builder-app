<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Post extends CI_Controller {

	private $table1 = 'post';

	public function __construct()
	{
		parent::__construct();
    Cek_login::ceklogin();
		$this->load->model('Createtable');
		$this->load->model("Tabledx");
		$this->load->model('Datatable_gugus');
	}

	public function index()
	{
        $this->Createtable->location('admin/post/table_show');
        $this->Createtable->table_name('tableku');
        $this->Createtable->create_row(["No","No Post","Judul","Slug","Kategori","Thumbnails","Tanggal","Tag","action"]);
        $this->Createtable->order_set('0, 7');
		$show = $this->Createtable->create();

		$data['datatable'] = $show;
        $this->load->view('templateadmin/head');
        $this->load->view('admin/post/view', $data);
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
                        'row' => ["no_post","judul","slug","kategori","thumbnails","tanggal","tag","created_at","updated_at"]
                    ],
                    'table-draw' => post('draw'),
                    'table-show' => [
                        'key' => 'id',
                        'data' => ["no_post","judul","slug","kategori","thumbnails","tanggal","tag"]
                    ],
                    "action" => "standart",
                    'order' => [
                        'order-default' => ['id', 'DESC'],
                        'order-data' => $setorder,
                        'order-option' => [ "1"=>"no_post", "2"=>"judul", "3"=>"slug", "4"=>"kategori", "5"=>"thumbnails", "6"=>"tanggal", "7"=>"tag", "8"=>"created_at", "9"=>"updated_at", "10"=>"delete_set"],
                    ],

                ]
            );
            $this->Datatable_gugus->table_show();
        }elseif ($action == "update") {
            $data_row = $this->db->query("SELECT * FROM ".$this->table1." WHERE id = '".$keyword."'")->row();
            $data['form_data'] = $data_row;
            $this->load->view('templateadmin/head');
            $this->load->view('admin/post/edit', $data);
            $this->load->view('templateadmin/footer');
        }elseif ($action == "delete") {
            $hapus_data = $this->db->query("UPDATE ".$this->table1." SET delete_set = '1' WHERE id = '".post("id")."'");
        }
    }

    public function tambah_data()
    {
				$tr = new Tabledx;
				$tr->table($this->table1);
				$tr->condition([
					"no_post" => [
						'opsi' => "LIKE",
						'val' => 'post-'.date('ym').'%',
					]
				]);
				$x = $tr->num_rows() + 1;
				$code = "post-".date('ym');
				$code2 = str_pad($x, 5, '0', STR_PAD_LEFT);
				$data['code'] = $code.'-'.$code2;

        $this->load->view('templateadmin/head');
        $this->load->view('admin/post/tambah', $data);
        $this->load->view('templateadmin/footer');
    }

		public function getFile($getfile = '', $key = 0)
		{
				if($getfile != null){
					return [
						"name" => $getfile["name"][$key],
						"type" => $getfile["type"][$key],
						"tmp_name" => $getfile["tmp_name"][$key],
						"error" => $getfile["error"][$key],
						"size" => $getfile["size"][$key],
						"ext" => pathinfo($getfile["name"][$key]['kontent'], PATHINFO_EXTENSION)
					];
				}else{
					return [];
				}
		}

    public function simpan(){
			$datasp = [];
			if (isset($_FILES["databarangpembelian"])) {
				$datsp = $_FILES["databarangpembelian"];
			}


			$tr = new Tabledx;

			$tr->table($this->table1);

			$tr->getInput();

			$tr->postget['thumbnails'] = Form::getfile("thumbnails", "assets/gambar/$this->table1/");

			$produk = $tr->postget['databarangpembelian'];

			unset($tr->postget['tipe_kontent']);

			unset($tr->postget['databarangpembelian']);

			// input disimpan pertamakali
			$tr->addUpdated();

			$tr->newData();

			$idlast = $tr->getLast()->id;
			// input disimpan kedua
			foreach($produk as $key => $elf){
					$elf['post_id'] = $idlast;

					if ($elf["tipe_kontent"] == 2 || $elf["tipe_kontent"] == 5) {
						$elf["kontent"] = Form::getfile($this->getFile($datsp, $key), "assets/gambar/tipe-kontent/");
					}else{
						$elf["kontent"] = json_encode($elf["kontent"]);
					}

					$tr = new Tabledx;
					$tr->table('datapost');
					$tr->getInput($elf);
					$tr->addUpdated();
					$tr->newData();
			}

			return redirect('admin/post/table_show/update/'.$idlast);


    }

    public function update(){
			$datasp = [];
			if (isset($_FILES["databarangpembelian"])) {
				$datsp = $_FILES["databarangpembelian"];
			}


			$tr = new Tabledx;

			$tr->table($this->table1);

			$tr->getInput();

			if (isset($_FILES["thumbnails"])) {
				$tr->postget['thumbnails'] = Form::getfile("thumbnails", "assets/gambar/$this->table1/", post('id'), $this->table1);
			}

			$produk = $tr->postget['databarangpembelian'];

			unset($tr->postget['tipe_kontent']);

			unset($tr->postget['databarangpembelian']);

			// input disimpan pertamakali
			$tr->addUpdated();

			$tr->setToUpdate();

			$tr->updateData();

			$tr = new Tabledx;

			$tr->table('datapost');

			$tr->condition([
					'post_id' => post('id')
			]);

			$tr->delData();
			
			var_dump($produk);
			
			// input disimpan kedua
			foreach($produk as $key => $elf){
					$elf['post_id'] = post('id');

					if ($elf["tipe_kontent"] == 2 || $elf["tipe_kontent"] == 5) {
						if (is_array($elf["tipe_kontent"])) {
							$elf["kontent"] = Form::getfile($this->getFile($datsp, $key), "assets/gambar/tipe-kontent/");
						}
					}else{
						$elf["kontent"] = json_encode($elf["kontent"]);
					}

					$tr = new Tabledx;
					$tr->table('datapost');
					$tr->getInput($elf);
					$tr->addUpdated();
					$tr->newData();
			}

// 			return redirect('admin/post/table_show/update/'.post('id'));
    }

    public function exls(array $data = [], array $headers = [], $fileName = 'data-post.xlsx')
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $headers = ["No","No Post","Judul","Slug","Kategori","Thumbnails","Tanggal","Tag","created at","updated at","delete set", "action"];

        $calldata = ["no_post","judul","slug","kategori","thumbnails","tanggal","tag","created_at","updated_at"];

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

		public function temp($urutan, $tipe = null)
    {
        $data['urutan'] = $urutan;
        $data['tipe'] = $tipe;
        $this->load->view('admin/post/temp', $data);
    }


}
