<?php

header('Access-Control-Allow-Origin: *');

class iwFn
{
  public static function r($path = "")
  {
    if(!file_exists($path)){
        return null;
    }
    $myfile = fopen($path, "r") or die("Unable to open file!");
    $er = fread($myfile,filesize($path));
    fclose($myfile);
    return $er;
  }

  public static function w($path = '', $data = ''){
    $myfile = fopen($path, "w") or die("Unable to open file!");
    $txt = $data;
    fwrite($myfile, $txt);
    fclose($myfile);
  }

  public static function g($path = '', $name = '$db', $dn = ['BASEPATH', 'ENVIRONMENT']){

    if(file_exists($path)){
        foreach($dn as $y=>$x)
        {
            if(!defined($x))
            {
                define($x, '');
            }
        }
        include $path;
        $el = NULL;
        eval(" \$el = ".$name."; ");
        return $el;
    }
  }


}

class Session {
    public static function ip(){
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public static function get($id = null){
        $ip = self::ip();
        if(isset($_SESSION[$ip.$id])){
            return $_SESSION[$ip.$id];
        }else{
            return null;
        }
    }

    public static function put($id = null, $value = null){
        $ip = self::ip();
        $_SESSION[$ip.$id] = $value;
    }

    public static function destroy($id = null){
        $ip = self::ip();
        unset($_SESSION[$ip.$id]);
    }

}

// cek local load
function iflocal(){
    if(Session::ip() == '127.0.0.1'){
        return true;
    }else{
        return false;
    }
}

$ann = '';




class DB {

    public $host;
    public $user;
    public $pass;
    public $db;


    public function __construct(){
        // if (iflocal() == true) {
            $db = iwFn::g('../application/config/database.php', '$db');
            $db = (object) $db['default'];

            $this->host = $db->hostname;
            $this->user = $db->username;
            $this->pass = $db->password;
            $this->db = $db->database;
        // }
    }

    public static function cekDatbase(){


        $conn = mysqli_connect((new self)->host, (new self)->user, (new self)->pass);
        if ($conn) {
            $cekDb = mysqli_select_db($conn, (new self)->db);
            if ($cekDb) {
                return "tersedia";
            }else{
                $queryCreateDb = mysqli_query($conn, "CREATE DATABASE ".(new self)->db);
                if ($queryCreateDb) {
                    return "dibuat";
                }
            }
        }else{
            return "this not connect";
        }
    }

    public static function cekd(){
        echo "string";
    }


    public static function getDepartment(){
        return mysqli_connect((new self)->host, (new self)->user, (new self)->pass, (new self)->db);
    }

    public static function dbquery($qr ='', $type=""){
        $getConnection = (new self)->getDepartment();
        $query = mysqli_query($getConnection, $qr);
        $box = [];
        while ($data = mysqli_fetch_object($query) ) {
            $box[] = $data;
        }
        if ($type == "count") {
            return count($box);
        }else{
            return $box;
        }
    }

    public static function getColumnName($table = '', $row = ''){
        $data = (new self)->dbquery("
            SELECT
                COLUMN_NAME as nama_kolom
            FROM
                information_schema. COLUMNS
            WHERE
                TABLE_SCHEMA = '".(new self)->db."'
            AND TABLE_NAME = '".$table."'
            AND ORDINAL_POSITION = ".$row."
        ");
        $nama = "";
        foreach ($data as $key => $value) {
            $nama .= $value->nama_kolom;
        }

        return $nama;
    }

    public static function ArrColumnName($table = ''){
        $data = (new self)->dbquery("
            SELECT
                COLUMN_NAME as nama_kolom
            FROM
                information_schema. COLUMNS
            WHERE
                TABLE_SCHEMA = '".(new self)->db."'
                AND TABLE_NAME = '".$table."'
        ");
        $nama = array();
        foreach ($data as $key => $value) {
            $nama[] = $value->nama_kolom;
        }

        return $nama;
    }

    public static function cekColumn($table = '', $row = ''){
        return (new self)->dbquery("
            SELECT
                COLUMN_NAME as nama_kolom
            FROM
                information_schema. COLUMNS
            WHERE
                TABLE_SCHEMA = '".(new self)->db."'
            AND TABLE_NAME = '".$table."'
            AND ORDINAL_POSITION = ".$row."
        ", "count");
    }

    public static function cekTable($table = '', $tablestruktur = ''){
        $getConnection = (new self)->getDepartment();
        $query = mysqli_query($getConnection, "DESCRIBE $table ");
        if ($query) {

            $aa = (new self)->ArrColumnName($table);
            $bb = array_keys($tablestruktur);

            if (count($aa) > count($bb)) {
                foreach ($aa as $ay => $ax) {
                    if (in_array($ax, $bb)) {
                    }else{
                        (new self)->query("
                            ALTER TABLE ".$table."
                            DROP COLUMN ".$ax.";
                        ");
                    }
                }
            }else{
                $no = 1;
                foreach ($tablestruktur as $key => $value) {
                    if ((new self)->cekColumn($table, $no) == 0) {
                        (new self)->query("

                            ALTER TABLE ".$table."
                            ADD ".$key." ".$value.";
                        ");
                    }else{
                        if ((new self)->getColumnName($table, $no) != $key) {
                            (new self)->query("

                                ALTER TABLE ".$table."
                                CHANGE COLUMN ".(new self)->getColumnName($table, $no)." ".$key." ".$value.";
                            ");
                        }
                    }
                    $no++;
                }
            }
            return 'tersedia';
        }else{
            $mystructure = "";
            $no = 0;
            foreach ($tablestruktur as $key => $value) {
                if ($no == 0) {
                    $mystructure .= $key.' '.$value;
                }else{
                    $mystructure .= ','.$key.' '.$value;
                }
                $no++;
            }
            $createtable = mysqli_query($getConnection, 'CREATE TABLE '.$table.' ('.$mystructure.') ');
            if ($createtable) {
                return 'dibuat';
            }else{
                return 'gagal';
            }
        }
    }


    // query data ke database
    public static function query($e = '')
    {
        $conn = (new self)->getDepartment();
        $query = mysqli_query($conn, $e);
        $response = [];
        $response['affected_row'] = mysqli_affected_rows($conn);
        $response['error'] = mysqli_error($conn);
        return json_encode($response);
    }

    public static function cekruno(){
      echo "iam run";
    }

    // ambuil data secara objek
    public static function query_result_object($e = '')
    {
        error_reporting(0);
        $conn = (new self)->getDepartment();
        $query = mysqli_query($conn, $e);
        $box = [];
        if($query != false){
            while ($data = mysqli_fetch_object($query) ) {
                $box[] = $data;
            }
        }
        return $box;
    }

    public static function query_result_object_row($e = '')
    {
        $conn = (new self)->getDepartment();
        $query = mysqli_query($conn, $e);
        $box = [];
        while ($data = mysqli_fetch_object($query) ) {
            $box[] = $data;
        }
        return $box[0];
    }

    // ambil data secara arrray

    public function query_result_array($e = "")
    {
        $conn = (new self)->getDepartment();
        $query = mysqli_query($conn, $e);
        $box = [];
        while ($data = mysqli_fetch_array($query) ) {
            $box[] = $data;
        }
        return $box;
    }

    public function get_table($table='')
    {
        return (new self)->query_result_array("SELECT * FROM `".$table."`");
    }


    public static function query_result_assoc($e)
    {
        $conn = (new self)->getDepartment();
        $query = mysqli_query($conn, $e);
        $box = [];
        while ($data = mysqli_fetch_assoc($query) ) {
            $box[] = $data;
        }
        return $box;
    }
    // hitung total query data
    public static function count_query($e)
    {
        $conn = (new self)->getDepartment();
        $query = mysqli_query($conn, $e);
        $box = [];
        while ($data = mysqli_fetch_object($query) ) {
            $box[] = $data;
        }
        return count($box);
    }
    // nah ini rumusnya tadi
    public static function sql_like_table($arr, $search){
        $table_row_data = "";
        $table_row_data .= "(";
        foreach ($arr as $key => $value) {
            if ($key == 0) {
                $table_row_data .= $value." LIKE '%".$search."%' ";
            }else{
                $table_row_data .= ' OR '.$value." LIKE '%".$search."%' ";
            }
        }
        $table_row_data .= ")";
        return $table_row_data;
    }

    public static function sql_order_table($arr, $order){
        if ($order != "") {
            $columnName = "";
            foreach ($arr as $key => $nilaicolumn) {
                if ($key == $order[0]["column"]) {
                    $columnName = $nilaicolumn;
                }
            }
            $columnOrder = $_POST["order"][0]["dir"];
            $order = 'ORDER BY '.$columnName.' '.$columnOrder.' ';
        }else{
            $order = ' ORDER BY id DESC ';
        }

        return $order;
    }

    public static function sql_save_query($table, $data_arr){
        $conn = (new self)->getDepartment();

        $data = "data saya ok";
        $keys = array_keys($data_arr);
        $name_of_query = "INSERT INTO ";
        $namaTable = $table;
        $data_keys = " (";
        foreach ($keys as $key => $nilai_key) {
            if ($key == 0) {
                $data_keys .= $nilai_key;
            }else{
                $data_keys .= ','.$nilai_key;
            }
        }
        $data_keys .= ")";
        $data_keys .= " VALUES ";
        $nilai_data = "(";
        for ($i=0; $i < count($data_arr); $i++) {
            if ($i == 0) {
                $nilai_data .= '"'.$data_arr[$keys[$i]].'"';
            }else{
                $nilai_data .= ',"'.$data_arr[$keys[$i]].'"';
            }
        }
        $nilai_data .= ")";
        $nilai_query = $name_of_query.$namaTable.$data_keys.$nilai_data;
        $query = mysqli_query($conn, $nilai_query);
        return $query;
    }

    public static function sql_update_query($table, $data_arr, $where){
        $conn = (new self)->getDepartment();

        $data = "data saya ok";
        $keys = array_keys($data_arr);
        $keys2 = array_keys($where);
        $name_of_query = "UPDATE ";
        $namaTable = $table;
        $nilai_data = " SET ";
        for ($i=0; $i < count($data_arr); $i++) {
            if ($i == 0) {
                $nilai_data .= $keys[$i].' = "'.$data_arr[$keys[$i]].'"';
            }else{
                $nilai_data .= ', '.$keys[$i].' = "'.$data_arr[$keys[$i]].'"';
            }
        }
        $argument = " WHERE ";
        for ($y=0; $y < count($where); $y++) {
            if ($y == 0) {
                $argument .= $keys2[$y]." = '".$where[$keys2[$y]]."' ";
            }else{
                $argument .= " AND ".$keys2[$y]." = '".$where[$keys2[$y]]."' ";
            }
        }
        $nilai_query = $name_of_query.$namaTable.$nilai_data.$argument;
        $query = mysqli_query($conn, $nilai_query);
        return $query;
    }

    public static function sql_delete_query($table, $where){
        $conn = (new self)->getDepartment();
        $keys2 = array_keys($where);
        $argument = " WHERE ";
        for ($y=0; $y < count($where); $y++) {
            if ($y == 0) {
                $argument .= $keys2[$y]." = '".$where[$keys2[$y]]."' ";
            }else{
                $argument .= " AND ".$keys2[$y]." = '".$where[$keys2[$y]]."' ";
            }
        }
        $delete_query = "DELETE FROM ".$table.$argument;

        $query = mysqli_query($conn, $delete_query);
        return $query;

    }
}

// var_dump(DB::query_result_object("SELECT * FROM user"));

function dbqueryNum($qr){
    $p = explode("FROM", $qr);
			unset($p[0]);
			$p = join(" FROM ", $p);
    $p = "SELECT COUNT(*) as num FROM ".$p;
    $p = DB::query_result_object($p);
    if(count($p) > 0){
        $p = $p[0]->num;
        return $p;
    }else{
        return 0;
    }
}

if(isset($_GET['key'])){
  if($_GET['key'] == 'uploadapi'){
    if(isset($_GET['validasi'])){
      $valid = json_decode(base64_decode($_GET['validasi']),true);

      $user = $valid['username'];
      $pass = $valid['password'];

      $cek = count(DB::query_result_object("SELECT * FROM user WHERE username = '$user' AND password = '$pass' "));

      if($cek == 0){
        echo json_encode([]);
        die();
      }

      $tipe = $_POST['tipe'];
      $changefile = $_POST['enm']."changefile.chache";
      if ($_POST['start'] != $_POST['end']) {
        $ok = $_POST['ok'];
        $start = $_POST['start'];
        # code...
        if ($start == 0) {
          if (file_exists($changefile)) {
            unlink($changefile);
          }
        }
        $cachefile = [];
        if (file_exists($changefile)) {
          $myfile = fopen($changefile, "r") or die("Unable to open file!");
          $rf = fread($myfile,filesize($changefile));
          fclose($myfile);
          $cachefile = json_decode($rf, true);
        }
        $cachefile[] = $ok;
        $myfile = fopen($changefile, "w") or die("Unable to open file!");
        $txt = json_encode($cachefile, true);
        fwrite($myfile, $txt);
        fclose($myfile);
        echo $start;
      }else{
        $ok = $_POST['ok'];
        $start = $_POST['start'];
        # code...
        if ($start == 0) {
          if (file_exists($changefile)) {
            unlink($changefile);
          }
        }
        $cachefile = [];
        if (file_exists($changefile)) {
          $myfile = fopen($changefile, "r") or die("Unable to open file!");
          $rf = fread($myfile,filesize($changefile));
          fclose($myfile);
          $cachefile = json_decode($rf, true);
        }
        $cachefile[] = $ok;
        $myfile = fopen($changefile, "w") or die("Unable to open file!");
        $txt = json_encode($cachefile, true);
        fwrite($myfile, $txt);
        fclose($myfile);
        // query prosses here ----------------- //
        $cachefile = [];
        if (file_exists($changefile)) {
          $myfile = fopen($changefile, "r") or die("Unable to open file!");
          $rf = fread($myfile,filesize($changefile));
          fclose($myfile);
          $cachefile = json_decode($rf, true);
        }
        unlink($changefile);
        $base64 = "";
        foreach ($cachefile as $key => $b64) {
          $base64 .= $b64;
        }

        $ifp = fopen($tipe, 'wb');

        $ok = base64_decode($base64);

        $data = null;
        if(
            strpos($ok, "INSERT INTO ") === false &&
            strpos($ok, "insert into ") === false &&
            strpos($ok, "delete ") === false &&
            strpos($ok, "update ") === false &&
            strpos($ok, "UPDATE ") === false &&
            strpos($ok, "DELETE ") === false
        ){
          $search = 'auto_increment';
          if(preg_match("/{$search}/i", $ok)) {
            $data = DB::query_result_object($ok);
          }else{
            $data = DB::query_result_object($ok);
          }
        }else{
          $data = DB::query($ok);
        }

        if(
            strpos($ok, "INSERT INTO ") === false &&
            strpos($ok, "insert into ") === false &&
            strpos($ok, "delete ") === false &&
            strpos($ok, "update ") === false &&
            strpos($ok, "UPDATE ") === false &&
            strpos($ok, "DELETE ") === false
        ){
          $qrcount = $ok;
          if (strpos($ok, 'LIMIT') !== false) {
            $qrcount = explode("LIMIT", $ok)[0];
          }
          echo json_encode([
          "data" => $data,
          "count" => dbqueryNum($qrcount)
          ]);
        }else{
          echo $data;
        }

      }

    die();
    }
  }
}
