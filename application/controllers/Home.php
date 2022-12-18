<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
      parent::__construct();
          Cek_login::ceklogin();
          $this->load->model('Createtable');
          $this->load->model('Tabledx');
          $this->load->model('Datatable_gugus');
    }
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
      $this->load->view('templateadmin/head');
      $this->load->view('admin');
      $this->load->view('templateadmin/footer');
    }
    
    public function edittmp()
    {
      $this->load->view('templateadmin/head');
      $this->load->view('edittmp');
      $this->load->view('templateadmin/footer');
    }
    
    public function detail()
    {
        $this->load->view('artikel/detail');
    }
    
    public function whoami()
    {
        var_dump(exec('whoami'));
    }

    public function diagram()
  	{
  		$this->load->view('diagram');

  	}

    public function profile()
  	{
      $this->load->view('templateadmin/head');
  		$this->load->view('profile');
      $this->load->view('templateadmin/footer');

  	}

    public function setting()
    {
      $this->load->view('templateadmin/head');
  		$this->load->view('menusetting');
      $this->load->view('templateadmin/footer');
    }

    public function simpanicon()
    {
      $dt = $_POST;

      $dat = json_decode(ffread('.set'), true);

      $dat["menu-setting"][$dt['dat']][$dt['name']] = $dt['val'];

      $save = json_encode($dat,true);

      ffwrite('.set', $save);

      echo "save";

    }

    public function simpanopsi()
    {
      $dt = $_POST;

      $dat = json_decode(ffread('.set'), true);

      $dat["menu-setting"][$dt['dat3']][$dt['dat2']][$dt['dat1']] = $dt['val'];

      $save = json_encode($dat,true);

      ffwrite('.set', $save);

      echo "save";

    }

    public function text($value='')
    {


      $auth = [];

      $auth["Setting Menu"] = 'admin';


      print_r();

      print_r($auth);


      $menu = [
          "Dasbor" => "home",
          "Laporan" => "laporan",
          "Data Master" => "#sub",
          "Kontak" => "kontak",
          "Daftar Akun" => "akun",
          "Produk" => "produk",
          "Daftar Lain" => "daftarlain",
          "Transaksi" => "#sub",
          // "Kas & Bank" => "kasbank",
          "Produksi" => "produksi",
          "Biaya" => "biaya",
          "Pembelian" => "pembelian",
          "Penjualan" => "penjualan",
          "Setting" => "#sub",
          "User" => "user",
          "Profile" => "profile",
          "Setting Menu" => "setting",
        ];

        $icon = [
          "Dasbor" => "fa fa-desktop",
          "Laporan" => "fas fa-book",
          "Kontak" => "fas fa-address-book",
          "Daftar Akun" => "fas fa-clipboard-list",
          "Produk" => "fas fa-archive",
          "Daftar Lain" => "fas fa-file-alt",
          // "Kas & Bank" => "fas fa-wallet",
          "Produksi" => "fas fa-industry",
          "Biaya" => "fas fa-tags",
          "Pembelian" => "fas fa-shopping-cart",
          "Penjualan" => "fas fa-credit-card",
          "User" => "fas fa-user",
          "Profile" => "fas fa-user",
          "Setting Menu" => "fas fa-cog",
        ];



    }

    

}
