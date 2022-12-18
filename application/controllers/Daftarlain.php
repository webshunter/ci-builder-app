<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daftarlain extends CI_Controller
{

    public function __construct()
    {
      parent::__construct();
          Cek_login::ceklogin();
          $this->load->model('Createtable');
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
      $this->load->view('daftar');
      $this->load->view('templateadmin/footer');
    }
    public function detail()
    {
        $this->load->view('artikel/detail');
    }

    public function diagram()
  	{
  		$this->load->view('diagram');

  	}
}
