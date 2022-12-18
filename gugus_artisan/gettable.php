<?php

require_once 'database.php';

$dd = new Database();
        
print $dd->database."\n";


$table = $dd->query_result_object("SELECT
DISTINCT TABLE_NAME
FROM
INFORMATION_SCHEMA.COLUMNS 
WHERE
TABLE_SCHEMA = '$dd->database'");

$text = "\$arr = []; \n";

foreach($table as $key => $elm){

    $text .= "\$arr[] = [ \n";
    $text .= "  'table' => '$elm->TABLE_NAME', \n";

    $rowname = $dd->query_result_object("SELECT
	COLUMN_NAME, DATA_TYPE, COLUMN_KEY, EXTRA
FROM
	INFORMATION_SCHEMA.COLUMNS 
WHERE
	TABLE_SCHEMA = '$dd->database' AND TABLE_NAME = '$elm->TABLE_NAME'");
    
    $text .= "  'data' => [ \n";
    foreach($rowname as $key => $row ){
        if($row->EXTRA == 'auto_increment'){
            $text .= "      '$row->COLUMN_NAME' => ai(), \n";
        }else{
            $text .= "      '$row->COLUMN_NAME' => char(255), \n";
        }
    }
    $text .= "  ], \n";
    $text .= "  'form' => [ \n";
    foreach($rowname as $key => $row ){
        if($row->EXTRA == 'auto_increment'){
            $text .= "      '$row->COLUMN_NAME' => 'no', \n";
        }else{
            $text .= "      '$row->COLUMN_NAME' => 'text', \n";
        }
    }
    $text .= "  ], \n";
    $text .= "  'name' => [ \n";
    foreach($rowname as $key => $row ){
        if($row->EXTRA == 'auto_increment'){
            $text .= "      'no', \n";
        }else{
            $text .= "      '$row->COLUMN_NAME', \n";
        }
    }
    $text .= "  ], \n";
    $text .= '  "title" => [
        "view" => "'.$elm->TABLE_NAME.'",
        "edit" => "Ubah '.$elm->TABLE_NAME.'",
        "new" => "Tambahkan '.$elm->TABLE_NAME.'"
    ],'."\n";
    $text .= "  'command' => 'php gugus template $elm->TABLE_NAME --crud $elm->TABLE_NAME' \n";
    $text .= "]; \n \n";
}

    // {{ replace-temp }}

// print_r($text);

$myfile = "templating/db_table.temp";
$mytemplate = fopen($myfile, "r");
$data = fread($mytemplate, filesize($myfile));

$data = str_replace("{{ replace-temp }}", $text, $data);
print_r($data );

$create = fopen('gugus_artisan/db_table.php', "w");
fwrite($create, $data);
fclose($create);

fclose($mytemplate);
