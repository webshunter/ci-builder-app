<?php

function create_session($name = "", $data_arr)
{
    $_SESSION[$name.'cvkaryacarmaperkasa'] = $data_arr;
}

function destroy_session($name)
{
    unset($_SESSION[$name.'cvkaryacarmaperkasa']);
}

function generate_session($name = "", $defaultnull = "")
{
    if(isset($_SESSION[$name.'cvkaryacarmaperkasa'])){
        if ($_SESSION[$name.'cvkaryacarmaperkasa'] != "") {
            return $_SESSION[$name.'cvkaryacarmaperkasa'];
        }else{
            return $defaultnull;
        }
    }else{
        if ($defaultnull != "") {
            return $defaultnull;
        }else{
            return "";
        }
    }
}

function iduser($name = "", $defaultnull = "")
{
    if(generate_session('loginid') != ''){
        return generate_session('loginid');
    }else{
        return '';
    }
}


function cek($class = [], $name = "")
{
    if (isset($class->$name)) {
        return $class->$name;
    }else{
        return "";
    }
}

function postaxio()
{
    $post = json_decode(file_get_contents("php://input"),true);
    if ($post != NULL) {
        $_POST = $post;
    }
}

function pesan($pesan='', $type = "create", $info = "Success!")
{
    if($type == 'create'){
      create_session('pesan', $pesan);
    }elseif($type == "show"){
      if (generate_session('pesan') != "") {
        $pesan = generate_session('pesan');

        if ($info == "Success!") {
          echo "
          <div class=\"alert alert-success alert-dismissible\">
          <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
          <strong>$info</strong> $pesan
          </div>
          ";
        }elseif($info == "Warning!"){
          echo "
          <div class=\"alert alert-danger alert-dismissible\">
          <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
          <strong>$info</strong> $pesan
          </div>
          ";
        }else{
          echo "
          <div class=\"alert alert-primary alert-dismissible\">
          <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
          <strong>$info</strong> $pesan
          </div>
          ";
        }

        destroy_session('pesan');
      }
    }
}

function datalogin($name = null)
{
    if (generate_session('datalogin') != '') {
        if (isset(generate_session('datalogin')->$name)) {
            return generate_session('datalogin')->$name;
        }else{
            return '';
        }
    }else{
        return '';
    }
}
