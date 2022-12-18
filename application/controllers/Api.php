
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

    public function __construct()
    {
          parent::__construct();
          header("Access-Control-Allow-Origin: *");
          header("Access-Control-Allow-Methods: GET, OPTIONS, POST, GET, PUT");
          header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
          $this->load->model('Tabledx');
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


    public function fintech(){

        echo json_encode($this->db->query("SELECT DISTINCT nama_fintech FROM api_remainder ")->result());

    }
    // backup
    // public function gets($time1="", $time2="", $tmp = "tgl_tempo")
    // {

    //     $fintech = "";

    //     if(isset($_POST['cp3'])){
    //         $fintech = $_POST['cp3'];
    //     }

    //     if($time1 == 'null'){
    //         $time1 = "";
    //     }

    //     if($time2 == 'null'){
    //         $time2 = "";
    //     }

    //     if($time1 != "" || $time2 != "" || $fintech != ""){

    //         $kondisi1 = "";

    //         if($time1 != "" && $time2 != ""){
    //             $kondisi1 = "AND $tmp BETWEEN '$time1' AND '$time2'";
    //         }

    //         //echo "SELECT * FROM api_remainder WHERE nama_fintech LIKE '%$fintech%' AND status <> 'selesai' $kondisi1 ORDER BY id ASC";

    //         echo json_encode($this->db->query("SELECT * FROM api_remainder WHERE nama_fintech LIKE '%$fintech%' AND status = 'selesai' $kondisi1 ORDER BY id ASC")->result());
    //     }else{
    //         echo json_encode($this->db->query("SELECT * FROM api_remainder WHERE status = 'selesai' ORDER BY id ASC")->result());
    //     }

    // }


    // backup 2
    //  public function gets($time1="", $time2="", $tmp = "tgl_tempo")
    // {

    //     $fintech = "";

    //     if(isset($_POST['cp3'])){
    //         $fintech = $_POST['cp3'];
    //     }

    //     if($time1 == 'null'){
    //         $time1 = "";
    //     }

    //     if($time2 == 'null'){
    //         $time2 = "";
    //     }

    //     if($time1 != "" || $time2 != "" || $fintech != ""){

    //         $kondisi1 = "";

    //         if($time1 != "" && $time2 != ""){
    //             $kondisi1 = "AND $tmp BETWEEN '$time1' AND '$time2'";
    //         }

    //         //echo "SELECT * FROM api_remainder WHERE nama_fintech LIKE '%$fintech%' AND status <> 'selesai' $kondisi1 ORDER BY id ASC";

    //         echo json_encode($this->db->query("SELECT * FROM api_remainder WHERE nama_fintech LIKE '%$fintech%' $kondisi1 ORDER BY id ASC")->result());
    //     }else{
    //         echo json_encode($this->db->query("SELECT * FROM api_remainder ORDER BY id ASC")->result());
    //     }

    // }









    public function gets($time1="")
    {

        $fintech = "";

        if(isset($_POST['cp3'])){
            $fintech = $_POST['cp3'];
        }


        if($time1 != "" ||  $fintech != ""){

            $kondisi1 = "";

            if($time1 != ""){
                $kondisi1 = "AND status = '$time1'";
            }

            if($time1 == "belum"){
                $kondisi1 = "AND status = ''";
            }

            //echo "SELECT * FROM api_remainder WHERE nama_fintech LIKE '%$fintech%' AND status <> 'selesai' $kondisi1 ORDER BY id ASC";

            echo json_encode($this->db->query("SELECT * FROM api_remainder WHERE nama_fintech LIKE '%$fintech%' AND delete_set = '0' $kondisi1 ORDER BY tgl_tempo ASC")->result());
        }else{
            echo json_encode($this->db->query("SELECT * FROM api_remainder WHERE delete_set = '0' ORDER BY tgl_tempo ASC")->result());
        }

    }


    public function get($time1="", $time2="", $tmp = "tgl_tempo")
    {

        $fintech = "";

        if(isset($_POST['cp3'])){
            $fintech = $_POST['cp3'];
        }

        if($time1 == 'null'){
            $time1 = "";
        }

        if($time2 == 'null'){
            $time2 = "";
        }

        if($time1 != "" || $time2 != "" || $fintech != ""){

            $kondisi1 = "";

            if($time1 != "" && $time2 != ""){
                $kondisi1 = "AND $tmp BETWEEN '$time1' AND '$time2'";
            }

            //echo "SELECT * FROM api_remainder WHERE nama_fintech LIKE '%$fintech%' AND status <> 'selesai' $kondisi1 ORDER BY id ASC";

            echo json_encode($this->db->query("SELECT *, IF(tgl_tempo <> '' AND top IS NULL, tgl_tempo, date_add(tgl_cair, INTERVAL top DAY)) as byord FROM api_remainder WHERE nama_fintech LIKE '%$fintech%' AND status <> 'selesai' AND delete_set = '0' $kondisi1 ORDER BY byord ASC")->result());
        }else{
            echo json_encode($this->db->query("SELECT *, IF(tgl_tempo <> '' AND top IS NULL, tgl_tempo, date_add(tgl_cair, INTERVAL top DAY)) as byord FROM api_remainder WHERE status <> 'selesai' AND delete_set = '0' ORDER BY byord ASC")->result());
        }

    }

    public function count()
    {
        echo json_encode([
            "total" => $this->db->query("SELECT * FROM api_remainder")->num_rows(),
            "lastid" => $this->db->query("SELECT * FROM api_remainder ORDER BY id DESC")->row()
        ]);
    }

    public function get2()
    {
        echo json_encode($this->db->query("SELECT * FROM api_remainder WHERE status = 'selesai' AND delete_set = '0' ORDER BY id ASC")->result());
    }

    public function regist($ok)
    {
      $ok = str_replace("2", " ", $ok);
      $ok = json_decode(binaryToString($ok), true);
      $username = $ok['username'];
      $password = $ok['password'];
      $token = md5(date('ymdhis'));
      $save = $this->db->query("INSERT INTO userapp (username, password, token) VALUES ('$username', '$password', '$token') ");
      if ($save) {
        echo "simpan";
      }
    }

    public function okb($ok = "", $token){
      if ($this->db->query("SELECT * FROM userapp WHERE token = \"$token\" ")->row() != NULL) {
        $ok = str_replace("2", " ", $ok);
        $ok = binaryToString($ok);
        // echo $ok;
        $data = $this->db->query($ok);

        if(strpos($ok, "SELECT")){
          $data = $data->result();
          echo json_encode($data);
        }else{
          echo "simpan";
        }
      }
    }

    public function getToken($ok){
      $ok = str_replace("2", " ", $ok);
      $ok = json_decode(binaryToString($ok), true);
      $username = $ok['username'];
      $password = $ok['password'];
      $cek = $this->db->query("SELECT token FROM userapp WHERE username = '$username' AND password = '$password' ")->row();
      if ($cek != NULL) {
        echo $cek->token;
      }else{
        echo "nodata";
      }
    }

    public function save()
    {
        $table = $_POST['table'];
        $qr = $_POST['query'];
        $this->db->query($qr);
        $tr = new Tabledx;
        $tr->table($table);
        echo json_encode($tr->getLast());
    }

    public function json()
    {
        $qr = $_POST['query'];
        $mm = $this->db->query($qr)->result();
        echo json_encode($mm);
    }

}
