<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Listbeli extends CI_Controller
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
      $this->load->view('laporan/listbeli', $data);
      $this->load->view('templateadmin/footer');
    }

    public function cst($type = 1, $dt1 = null, $dt2 = null)
    {
      $data['type'] = $type;
      $data['date1'] = $dt1;
      $data['date2'] = $dt2;
      $this->load->view('templateadmin/head');
      $this->load->view('laporan/listbeli', $data);
      $this->load->view('templateadmin/footer');
    }


    public function umurpiutang($type = 1)
    {
      $data['type'] = $type;
      $this->load->view('templateadmin/head');
      $this->load->view('laporan/umurhutang', $data);
      $this->load->view('templateadmin/footer');
    }

    public function umurpiutangw($type = 1, $dt1 = null)
    {
      $data['type'] = $type;
      $data['date1'] = $dt1;
      $this->load->view('templateadmin/head');
      $this->load->view('laporan/umurhutang', $data);
      $this->load->view('templateadmin/footer');
    }

    public function exortpdf()
    {
        $mpdf = new \Mpdf\Mpdf(['orientation'=>'L']);

        $stylesheet = file_get_contents('assets/bootstrap/css/bootstrap.min.css');
        $mpdf->WriteHTML($stylesheet, 1);
        $mpdf->WriteHTML('

        <table class="table">
                <tbody><tr style="background-color: #4c8bf5; color: white;">
                  <th>Akun</th>
                  <th>Debit</th>
                  <th>Kredit</th>
                </tr>

                  <tr style="background: #dff;">
                    <td colspan="3"><span style="color:#4c8bf5; font-weight: bold;">Journal Entry PB2106-00001</span> | <span style="color:#333; font-weight: bold;"> ( Create On 2021-06-25 18:10:16 ) </span> </td>
                  </tr>
                                                                                        <tr>
                      <td>(1-10200) - Persediaan Barang <br> baju</td>
                      <td>Rp. 5.000.000,00</td>
                      <td>Rp. 0,00</td>
                    </tr>
                                                                                                                <tr>
                      <td> (1-10500) - PPN Masukan</td>
                      <td>Rp. 500.000,00</td>
                      <td>Rp. 0,00</td>
                    </tr>
                                                                                                          <tr>
                    <td> (1-10002) - Rekening Bank</td>
                    <td>Rp. 0,00</td>
                    <td>Rp. 5.500.000,00</td>
                  </tr>
                                      <tr style="background: #dff;">
                    <td colspan="3"><span style="color:#4c8bf5; font-weight: bold;">Journal Entry PB2106-00002</span> | <span style="color:#333; font-weight: bold;"> ( Create On 2021-06-25 19:27:15 ) </span> </td>
                  </tr>
                                                                                        <tr>
                      <td>(1-10200) - Persediaan Barang <br> Sepatu</td>
                      <td>Rp. 3.000.000,00</td>
                      <td>Rp. 0,00</td>
                    </tr>
                                                                                                                <tr>
                      <td> (1-10500) - PPN Masukan</td>
                      <td>Rp. 300.000,00</td>
                      <td>Rp. 0,00</td>
                    </tr>
                                                                                                          <tr>
                    <td> (1-10002) - Rekening Bank</td>
                    <td>Rp. 0,00</td>
                    <td>Rp. 3.300.000,00</td>
                  </tr>
                                  </tbody></table>


        ', 2);
        $mpdf->output();
    }

}
