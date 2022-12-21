<?php

require_once 'database.php';

class db_table_set extends Database{

    function createTbleNewUpdateDel()
    {
        require_once 'gugus_artisan/db_table.php';
        return crdb();
    }

    function database_created()
    {
        $this->cekDatbase();
    }

    function createnewtabblenow()
    {
        $ax = $this->createTbleNewUpdateDel();

        foreach($ax as $xz => $ay){
            $cek_d = $this->cekTable($ay["table"], $ay["data"]);
        }

    }

    function insertData()
    {
        $ax = $this->createTbleNewUpdateDel();

        foreach($ax as $xz => $ay){
            if(isset($ay["value"])){
                $tbl = $ay["table"];
                $this->query("
                    TRUNCATE $tbl
                ");
                foreach($ay["value"] as $ct => $ctdat){
                    $this->sql_save_query($ay["table"], $ctdat);
                }
            }
            $cek_d = $this->cekTable($ay["table"], $ay["data"]);
        }
    }

    function hapus_table(){

        $data = $this->dbquery("
            SELECT
                DISTINCT(TABLE_NAME) as nama_table
            FROM
                information_schema. COLUMNS
            WHERE
            TABLE_SCHEMA = '".$this->database."'
        ");

        $dataTable = [];

        $ax = $this->createTbleNewUpdateDel();

        foreach ($ax as $nilaiax) {
            $dataTable[] = $nilaiax["table"];
        }

        $dataArr = [];

        foreach ($data as $value) {
            $dataArr[] = $value->nama_table;  
        }

        foreach ($dataArr as $nilaiArr) {
            if(in_array($nilaiArr, $dataTable)){
                // no action
            }else{
                $this->drop_table($nilaiArr);
            }
        }
        
    }

}
        
$db_create_table = new db_table_set;

$cek_table_base = $db_create_table->createTbleNewUpdateDel();

$db_create_table->database_created();

if($db_create_table->createnewtabblenow()){
    print "database dibuat";
}

$db_create_table->insertData();

$db_create_table->hapus_table();


