<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Listproduk extends CI_Controller
{

    public function __construct()
    {
      parent::__construct();
          Cek_login::ceklogin();
          $this->load->model('Tabledx');
          $this->load->model('Createtable');
          $this->load->model('Datatable_gugus');
    }

    public function index($type = 1)
    {
      $data['type'] = $type;
      $this->load->view('templateadmin/head');
      $this->load->view('laporan/listproduk', $data);
      $this->load->view('templateadmin/footer');
    }

    public function persediaan()
    {
      $this->load->view('templateadmin/head');
      $this->load->view('laporan/persediaan');
      $this->load->view('templateadmin/footer');
    }

}
