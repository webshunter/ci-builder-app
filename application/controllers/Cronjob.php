<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cronjob extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Createtable');
        $this->load->model('Datatable_gugus');
    }
    
    
    public function cek(){
        $file = fopen("test.txt","w");
        echo fwrite($file,"Hello World. Testing! ".date('Y-m-d h:i:s') );
        fclose($file);
    }
    
    
}