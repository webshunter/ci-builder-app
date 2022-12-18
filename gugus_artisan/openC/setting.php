<?php


function tablecustome($table)
{
    require_once 'gugus_artisan/db_table.php';
    $cc = null;
    $datar = crdb();
    foreach($datar as $eld){
        if($eld["table"] == $table){
            $cc = $eld;
        }
    }
    if(isset($cc['custome'])){
        $custome  = " 'custome' => [
            ".$cc['custome'].''.'],';
        return $custome;
    }else{
        $custome  = "";
        return $custome;
    }
}


function newapi($table)
{
    require_once 'gugus_artisan/db_table.php';
    $cc = null;
    $datar = crdb();
    foreach($datar as $eld){
        if($eld["table"] == $table){
            $cc = $eld;
        }
    }
    if(isset($cc['newapi'])){
        $custome = $cc['newapi'];
        return $custome;
    }else{
        $custome  = "";
        return $custome;
    }
}

function countRow($table)
{
    require_once 'gugus_artisan/db_table.php';
    $cc = null;
    $datar = crdb();
    foreach($datar as $eld){
        if($eld["table"] == $table){
            $cc = $eld;
        }
    }

    $name  = count($cc['name']);
    return $name;
}

function searchrow($table)
{
    require_once 'gugus_artisan/db_table.php';
    $cc = null;
    $datar = crdb();
    foreach($datar as $eld){
        if($eld["table"] == $table){
            $cc = $eld;
        }
    }

    $name  = '["'.join('","', $cc['show'] ).'"]';
    return $name;
}

function getrowname($table)
{
    require_once 'gugus_artisan/db_table.php';
    $cc = null;
    $datar = crdb();
    foreach($datar as $eld){
        if($eld["table"] == $table){
            $cc = $eld;
        }
    }
    $name  = '["'.implode('","' , $cc['name']).'", "action"]';
    return $name;
}

function title($table, $title)
{
    require_once 'gugus_artisan/db_table.php';
    $cc = null;
    $datar = crdb();
    foreach($datar as $eld){
        if($eld["table"] == $table){
            $cc = $eld;
        }
    }
    return $cc['title'][$title];
}

function create_action($table = ""){
    require_once 'gugus_artisan/db_table.php';

    $cc = null;

    $datar = crdb();

    foreach($datar as $eld){
        if($eld["table"] == $table){
            $cc = $eld;
        }
    }

    // form
    $form = $cc["form"];

    $nm = $cc["data"];
    $thname = $cc["name"];

    $html = "";

    $ex1 = "(";
    $ex2 = "(";

    $number = 0;
    foreach($nm as $key => $nm){
        if($form[$key] == "no"){

        }elseif($form[$key] == "text"){
            $html .= '$'.$key.' = post("'.$key.'");'."\n";
            $ex1 .= $key.',';
            $ex2 .= "'\$".$key."',";
        }elseif($form[$key] == "editor"){
            $html .= '$'.$key.' = post("'.$key.'");'."\n";
            $ex1 .= $key.',';
            $ex2 .= '\"$'.$key.'\",';
        }
        elseif($form[$key] == "file"){
            $html .= '$'.$key.' = Form::getfile("'.$key.'", "assets/gambar/$this->table1/");'."\n";
            $ex1 .= $key.',';
            $ex2 .= "'\$".$key."',";
        }
        elseif($form[$key] == "hidden"){
            $html .= '$'.$key.' = post("'.$key.'");'."\n";
            $ex1 .= $key.',';
            $ex2 .= "'\$".$key."',";
        }
        elseif($form[$key] == "number"){
            $html .= '$'.$key.' = post("'.$key.'");'."\n";
            $ex1 .= $key.',';
            $ex2 .= "'\$".$key."',";
        }
        elseif($form[$key] == "email"){
            $html .= '$'.$key.' = post("'.$key.'");'."\n";
            $ex1 .= $key.',';
            $ex2 .= "'\$".$key."',";
        }
        elseif($form[$key] == "username"){
            $html .= '$'.$key.' = post("'.$key.'");'."\n";
            $ex1 .= $key.',';
            $ex2 .= "'\$".$key."',";
        }
        elseif($form[$key] == "date"){
            $html .= '$'.$key.' = post("'.$key.'");'."\n";
            $ex1 .= $key.',';
            $ex2 .= "'\$".$key."',";
        }
        elseif($form[$key] == "password"){
            $html .= '$'.$key.' = md5(md5(post("'.$key.'")));'."\n";
            $ex1 .= $key.',';
            $ex2 .= "'\$".$key."',";
        }
        elseif($form[$key] == "login"){
            $html .= '$'.$key.' = post("'.$key.'");'."\n";
            $ex1 .= $key.',';
            $ex2 .= "'\$".$key."',";
        }
        elseif(is_array($form[$key])){
            if ($form[$key]["type"] == "select") {
                $html .= '$'.$key.' = post("'.$key.'");'."\n";
                $ex1 .= $key.',';
                $ex2 .= "'\$".$key."',";
            }
            if ($form[$key]["type"] == "multicheck") {
                $html .= '$'.$key.' = post("'.$key.'");'."\n";
                $ex1 .= $key.',';
                $ex2 .= "'\$".$key."',";
            }
            if ($form[$key]["type"] == "multiple") {
                $html .= '$'.$key.' = post("'.$key.'");'."\n";
                $ex1 .= $key.',';
                $ex2 .= "'\$".$key."',";
            }
            if ($form[$key]["type"] == "slug") {
                $html .= '$'.$key.' = slug(post("'.$form[$key]["row"].'"));'."\n";
                $ex1 .= $key.',';
                $ex2 .= "'\$".$key."',";
            }
        }
        $number++;
    }

    $ex1 .= ")";
    $ex2 .= ")";

    $ex1 = str_replace(",)",")",$ex1);
    $ex2 = str_replace(",)",")",$ex2);

    $html .= "
        \n
        \$simpan = \$this->db->query(".'"'."
            INSERT INTO $table
            $ex1 VALUES $ex2
        ".'"'.");
    ";
    return $html;
}

function update_action($table = "", $primary){
    require_once 'gugus_artisan/db_table.php';

    $cc = null;

    $datar = crdb();

    foreach($datar as $eld){
        if($eld["table"] == $table){
            $cc = $eld;
        }
    }

    // form
    $form = $cc["form"];

    $nm = $cc["data"];
    $thname = $cc["name"];

    $html = "";
    $html .= "  \$key = post('$primary'); ";

    $ex1 = "(";
    $ex2 = "(";

    $number = 0;
    foreach($nm as $key => $nm){
        if($form[$key] == "no"){

        }elseif($form[$key] == "text"){
            $html .= '$'.$key.' = post("'.$key.'");'."\n";
            $ex2 .= " $key = '\$".$key."',";
        }elseif($form[$key] == "editor"){
            $html .= '$'.$key.' = post("'.$key.'");'."\n";
            $ex2 .= ' '.$key.' = \"$'.$key.'\",';
        }
        elseif($form[$key] == "file"){
            $html .= '$'.$key.' = Form::getfile("'.$key.'", "assets/gambar/$this->table1/", $key, $this->table1);'."\n";
            $ex2 .= " $key = '\$".$key."',";
        }
        elseif($form[$key] == "hidden"){
            $html .= '$'.$key.' = post("'.$key.'");'."\n";
            $ex2 .= " $key = '\$".$key."',";
        }
        elseif($form[$key] == "number"){
            $html .= '$'.$key.' = post("'.$key.'");'."\n";
            $ex2 .= " $key = '\$".$key."',";
        }
        elseif($form[$key] == "email"){
            $html .= '$'.$key.' = post("'.$key.'");'."\n";
            $ex2 .= " $key = '\$".$key."',";
        }
        elseif($form[$key] == "username"){
            $html .= '$'.$key.' = post("'.$key.'");'."\n";
            $ex2 .= " $key = '\$".$key."',";
        }
        elseif($form[$key] == "date"){
            $html .= '$'.$key.' = post("'.$key.'");'."\n";
            $ex2 .= " $key = '\$".$key."',";
        }
        elseif($form[$key] == "password"){
            $html .= "\$$key = post(\"$key\");
            if(\$this->db->query(\"SELECT * FROM \$this->table1 WHERE id = '\$key'\")->row()->$key != post(\"$key\")){
                \$$key = md5(md5(post(\"\$key\")));
            }";
            $html .= '$'.$key.' = md5(md5(post("'.$key.'")));'."\n";
            $ex2 .= " $key = '\$".$key."',";
        }
        elseif($form[$key] == "login"){
            $html .= '$'.$key.' = post("'.$key.'");'."\n";
            $ex2 .= " $key = '\$".$key."',";
        }
        elseif(is_array($form[$key])){
            if ($form[$key]["type"] == "select") {
                $html .= '$'.$key.' = post("'.$key.'");'."\n";
                $ex2 .= " $key = '\$".$key."',";
            }
            if ($form[$key]["type"] == "multicheck") {
                $html .= '$'.$key.' = post("'.$key.'");'."\n";
                $ex2 .= " $key = '\$".$key."',";
            }
            if ($form[$key]["type"] == "multiple") {
                $html .= '$'.$key.' = post("'.$key.'");'."\n";
                $ex2 .= " $key = '\$".$key."',";
            }
            if ($form[$key]["type"] == "slug") {
                // $html .= '$'.$key.' = slug(post("'.$form[$key]["row"].'"));'."\n";
                // $ex2 .= " $key = '\$".$key."',";
            }
        }
        $number++;
    }
    $ex2 .= ")";
    $ex2 = str_replace(",)","",$ex2);
    $ex2 = str_replace("(","",$ex2);
    $html .= "
        \$simpan = \$this->db->query(".'"'."
            UPDATE $table SET $ex2 WHERE $primary = '\$key'
            ".'"'.");
    ";
    return $html;
}


function create_form($table = ""){
    require_once 'gugus_artisan/db_table.php';

    $cc = null;

    $datar = crdb();

    foreach($datar as $eld){
        if($eld["table"] == $table){
            $cc = $eld;
        }
    }

    // form
    $form = $cc["form"];

    $nm = $cc["data"];
    $thname = $cc["fname"];

    $html = "";

    $number = 0;
    foreach($nm as $key => $nm){
        if($form[$key] == "no"){

        }elseif($form[$key] == "text"){
            $html .= '
                <?=
                    form::input([
                        "title" => "'.$thname[$number].'",
                        "type" => "text",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                    ])
                ?>
            ';
        }elseif($form[$key] == "editor"){
            $html .= '
                <?=
                    form::editor([
                        "title" => "'.$thname[$number].'",
                        "type" => "text",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                    ])
                ?>
            ';
        }
        elseif($form[$key] == "file"){
            $html .= '
                <?=
                    form::input([
                        "title" => "'.$thname[$number].'",
                        "type" => "file",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                    ])
                ?>
            ';
        }
        elseif($form[$key] == "hidden"){
            $html .= '
                <?=
                    form::input([
                        "title" => "'.$thname[$number].'",
                        "type" => "hidden",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                    ])
                ?>
            ';
        }
        elseif($form[$key] == "number"){
            $html .= '
                <?=
                    form::input([
                        "title" => "'.$thname[$number].'",
                        "type" => "number",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                    ])
                ?>
            ';
        }
        elseif($form[$key] == "email"){
            $html .= '
                <?=
                    form::input([
                        "title" => "'.$thname[$number].'",
                        "type" => "email",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                    ])
                ?>
            ';
        }
        elseif($form[$key] == "username"){
            $html .= '
                <?=
                    form::input([
                        "title" => "'.$thname[$number].'",
                        "type" => "username",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                    ])
                ?>
            ';
        }
        elseif($form[$key] == "date"){
            $html .= '
                <?=
                    form::input([
                        "title" => "'.$thname[$number].'",
                        "type" => "date",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                    ])
                ?>
            ';
        }
        elseif($form[$key] == "password"){
            $html .= '
                <?=
                    form::input([
                        "title" => "'.$thname[$number].'",
                        "type" => "password",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                    ])
                ?>
            ';
        }
        elseif($form[$key] == "login"){
            $html .= '
                <?=
                    form::input([
                        "title" => "'.$thname[$number].'",
                        "type" => "hidden",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                        "value" => iduser(),
                    ])
                ?>
            ';
        }
        elseif(is_array($form[$key])){
            if ($form[$key]["type"] == "select") {
                $html .= '
                <?=
                    form::select_db([
                        "title" => "'.$thname[$number].'",
                        "type" => "password",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                        "db" => "'.$form[$key]["data"]['db'].'",
                        "data" => "'.$form[$key]["data"]['data'].'",
                        "name" => "'.$form[$key]["data"]['name'].'",
                    ])
                ?>
            ';
        }elseif($form[$key]["type"] == "multicheck"){
                $html .= '
                <?=
                    form::multicheck([
                        "title" => "'.$thname[$number].'",
                        "type" => "password",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                        "db" => "'.$form[$key]["data"]['db'].'",
                        "data" => "'.$form[$key]["data"]['data'].'",
                        "name" => "'.$form[$key]["data"]['name'].'",
                    ])
                ?>
            ';
            }elseif($form[$key]["type"] == "slug"){

            }
        }
        elseif(is_array($form[$key])){
            if ($form[$key]["type"] == "multiple") {
                $html .= '
                <?=
                    form::multiple([
                        "title" => "'.$thname[$number].'",
                        "type" => "password",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                        "db" => "'.$form[$key]["data"]['db'].'",
                        "data" => "'.$form[$key]["data"]['data'].'",
                        "name" => "'.$form[$key]["data"]['name'].'",
                    ])
                ?>
            ';
            }
        }
        $number++;
    }
    return $html;
}

function create_form_edit($table = ""){
    require_once 'gugus_artisan/db_table.php';

    $cc = null;

    $datar = crdb();

    foreach($datar as $eld){
        if($eld["table"] == $table){
            $cc = $eld;
        }
    }

    // form
    $form = $cc["form"];

    $nm = $cc["data"];

    $html = "";


    $html .= '
        <?=
            form::input([
                "type" => "hidden",
                "fc" => "id",
                "value" => $form_data->id,
            ])
        ?>
    ';


    $thname = $cc["fname"];
    $number = 0;
    foreach($nm as $key => $nm){
        if($form[$key] == "no"){

        }elseif($form[$key] == "text"){
            $html .= '
                <?=
                    form::input([
                        "title" => "'.$thname[$number].'",
                        "type" => "text",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                        "value" => $form_data->'.$key.',
                    ])
                ?>
            ';
        }elseif($form[$key] == "editor"){
            $html .= '
                <?=
                    form::editor([
                        "title" => "'.$thname[$number].'",
                        "type" => "text",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                        "value" => $form_data->'.$key.',
                    ])
                ?>
            ';
        }
        elseif($form[$key] == "file"){
            $html .= '
                <?=
                    form::input([
                        "title" => "'.$thname[$number].'",
                        "type" => "file",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                        "value" => $form_data->'.$key.',
                    ])
                ?>
            ';
        }
        elseif($form[$key] == "hidden"){
            $html .= '
                <?=
                    form::input([
                        "title" => "'.$thname[$number].'",
                        "type" => "hidden",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                        "value" => $form_data->'.$key.',
                    ])
                ?>
            ';
        }
        elseif($form[$key] == "number"){
            $html .= '
                <?=
                    form::input([
                        "title" => "'.$thname[$number].'",
                        "type" => "number",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                        "value" => $form_data->'.$key.',
                    ])
                ?>
            ';
        }
        elseif($form[$key] == "date"){
            $html .= '
                <?=
                    form::input([
                        "title" => "'.$thname[$number].'",
                        "type" => "date",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                        "value" => $form_data->'.$key.',
                    ])
                ?>
            ';
        }
        elseif($form[$key] == "email"){
            $html .= '
                <?=
                    form::input([
                        "title" => "'.$thname[$number].'",
                        "type" => "email",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                        "value" => $form_data->'.$key.',
                    ])
                ?>
            ';
        }
        elseif($form[$key] == "username"){
            $html .= '
                <?=
                    form::input([
                        "title" => "'.$thname[$number].'",
                        "type" => "username",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                        "value" => $form_data->'.$key.',
                    ])
                ?>
            ';
        }
        elseif($form[$key] == "password"){
            $html .= '
                <?=
                    form::input([
                        "title" => "'.$thname[$number].'",
                        "type" => "password",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                        "value" => $form_data->'.$key.',
                    ])
                ?>
            ';
        }
        elseif($form[$key] == "login"){
            $html .= '
                <?=
                    form::input([
                        "title" => "'.$thname[$number].'",
                        "type" => "hidden",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                        "value" => iduser(),
                    ])
                ?>
            ';
        }
        elseif(is_array($form[$key])){
            if ($form[$key]["type"] == "select") {
                $html .= '
                <?=
                    form::select_db([
                        "title" => "'.$thname[$number].'",
                        "type" => "password",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                        "db" => "'.$form[$key]["data"]['db'].'",
                        "data" => "'.$form[$key]["data"]['data'].'",
                        "name" => "'.$form[$key]["data"]['name'].'",
                        "selected" => $form_data->'.$key.',
                    ])
                ?>
            ';
        }elseif($form[$key]["type"] == "multicheck"){
                $html .= '
                <?=
                    form::multicheck([
                        "title" => "'.$thname[$number].'",
                        "type" => "password",
                        "fc" => "'.$key.'",
                        "placeholder" => "tambahkan '.$key.'",
                        "db" => "'.$form[$key]["data"]['db'].'",
                        "data" => "'.$form[$key]["data"]['data'].'",
                        "name" => "'.$form[$key]["data"]['name'].'",
                        "selected" => $form_data->'.$key.',
                    ])
                ?>
            ';
            }elseif($form[$key]["type"] == "slug"){

            }
        }
        $number++;
    }

    return $html;

}
