<?php

require_once 'gugus_artisan/openC/setting.php';

$location_created = "application/controllers/eadmin/";
$location_view = "application/views/eadmin/";

if(!file_exists($location_view)){
    mkdir($location_view, 0777, true);
}

if(!file_exists($location_created)){
    mkdir($location_created, 0777, true);
}

// make foleder template
if(!isset($argument[3]) || $argument[3] == "--default"){

    mkdir($location_created.$argument[2], 0777, true);
    print "create ".$argument[2]." \n";
    mkdir($location_created.$argument[2]."/controllers");
        $myfile = "templating/default/controller.template";
        $mytemplate = fopen($myfile, "r");
        $data = fread($mytemplate, filesize($myfile));
        $data = str_replace("{{ className_controller }}", ucfirst($argument[2]), $data);
        $data = str_replace("{{ className }}", $argument[2], $data);
        fclose($mytemplate);
        $filecreate = $location_created.$argument[2]."/controllers/".ucfirst($argument[2]).".php";
        $create = fopen($filecreate, "w");
        fwrite($create, $data);
        fclose($create);
    print "create ".$argument[2]." controllers \n";
    mkdir($location_created.$argument[2]."/models");
        // createtable models
        $myfile = "templating/datatable/Createtable.template";
        $mytemplate = fopen($myfile, "r");
        $data = fread($mytemplate, filesize($myfile));
        fclose($mytemplate);
        $filecreate = $location_created.$argument[2]."/models/Createtable.php";
        $create = fopen($filecreate, "w");
        fwrite($create, $data);
        fclose($create);

        // Datatable_gugus models
        $myfile = "templating/datatable/Datatable_gugus.template";
        $mytemplate = fopen($myfile, "r");
        $data = fread($mytemplate, filesize($myfile));
        fclose($mytemplate);
        $filecreate = $location_created.$argument[2]."/models/Datatable_gugus.php";
        $create = fopen($filecreate, "w");
        fwrite($create, $data);
        fclose($create);

        print "create ".$argument[2]." Models \n";

        // view area --------------------------------------------------------------------------//

        mkdir($location_created.$argument[2]."/views");

        // Datatable_gugus models
        $myfile = "templating/default/view.template";
        $mytemplate = fopen($myfile, "r");
        $data = fread($mytemplate, filesize($myfile));
        fclose($mytemplate);
        $filecreate = $location_created.$argument[2]."/views/view.php";
        $create = fopen($filecreate, "w");
        fwrite($create, $data);
        fclose($create);

    print "create ".$argument[2]." views ";
}
elseif( $argument[3] == "--crud"){

    function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }


    if (file_exists($location_created.$argument[2])) {
        deleteDir($location_created.$argument[2]);
    }
    if (file_exists($location_view.$argument[2])) {
        deleteDir($location_view.$argument[2]);
    }

    // make foleder template

        $total_row = $db->total_row_table($argument[4]) - 1;

        $table_head = getrowname($argument[4]);
        $data_show = $db->dapatkan_nama_column($argument[4], [0 => "no"], [], 'show');
        $data_order = $db->dapatkan_nama_column($argument[4], [0 => "no"], [], 'order');

        $data_show = str_replace(",\"delete_set\"", "", $data_show);


        $myfile = "templating/datatable/controller.template";
        $mytemplate = fopen($myfile, "r");
        $data = fread($mytemplate, filesize($myfile));
        $data = str_replace("{{ className_controller }}", ucfirst($argument[2]), $data);
        $data = str_replace("{{ link }}", str_replace('_', '_', $argument[2]), $data);
        $data = str_replace("{{ className }}", $argument[2], $data);

        $data = str_replace("{{ total_row }}", countRow($argument[4]), $data);
        
        $data = str_replace("{{ simpan_control }}", create_action($argument[4]), $data);
        $data = str_replace("{{ update_control }}", update_action($argument[4], $db->get_primary_key($argument[4])), $data);

        $data = str_replace("{{ table_name }}", $argument[4], $data);
        $data = str_replace("{{ table_head }}", str_replace("_"," ",$table_head), $data);
        $data = str_replace("{{custome}}", tablecustome($argument[4]), $data);
        $data = str_replace("{{newapi}}", newapi($argument[4]), $data);
        $data = str_replace("{{ search }}", searchrow($argument[4]), $data);
        $data = str_replace("{{ order }}", $data_order, $data);
        $data = str_replace("{{ keys }}", $db->get_primary_key($argument[4]), $data);
        if(isset($argument[4])){
            $cariKata = '--table:';
            if(preg_match("/$cariKata/i", $argument[4])) {
                $nama_table = str_replace("--table:", "", $argument[4]);
                print $nama_table." \n";
            }
        }
        fclose($mytemplate);
        $filecreate = $location_created.ucfirst($argument[2]).".php";
        $create = fopen($filecreate, "w");
        fwrite($create, $data);
        fclose($create);
        print "create ".$argument[2]." controllers \n";

        // view area --------------------------------------------------------------------------//

        mkdir($location_view.$argument[2]."", 0777, true);

        // Datatable_gugus view
        $myfile = "templating/datatable/view.template";
        $mytemplate = fopen($myfile, "r");
        $data = fread($mytemplate, filesize($myfile));
        $data = str_replace("{{ className }}", $argument[2], $data);
        $data = str_replace("{{ title }}", title($argument[4], 'view'), $data);
        $data = str_replace("{{ link }}", str_replace('_', '_', $argument[2]), $data);
        fclose($mytemplate);
        $filecreate = $location_view.$argument[2]."/view.php";
        $create = fopen($filecreate, "w");
        fwrite($create, $data);
        fclose($create);

        // Datatable_gugus tambah
        $myfile = "templating/datatable/tambah.template";
        $mytemplate = fopen($myfile, "r");
        $data = fread($mytemplate, filesize($myfile));
        $data = str_replace("{{ form }}", create_form($argument[4]), $data);
        $data = str_replace("{{ className }}", $argument[2], $data);
        $data = str_replace("{{ title }}", title($argument[4], 'new'), $data);
        $data = str_replace("{{ link }}", str_replace('_', '_', $argument[2]), $data);
        fclose($mytemplate);
        $filecreate = $location_view.$argument[2]."/tambah.php";
        $create = fopen($filecreate, "w");
        fwrite($create, $data);
        fclose($create);

        // Datatable_gugus edit
        $myfile = "templating/datatable/edit.template";
        $mytemplate = fopen($myfile, "r");
        $data = fread($mytemplate, filesize($myfile));
        $data = str_replace("{{ form }}", create_form_edit($argument[4]), $data);
        $data = str_replace("{{ className }}", $argument[2], $data);
        $data = str_replace("{{ title }}", title($argument[4], 'edit'), $data);
        $data = str_replace("{{ link }}", str_replace('_', '_', $argument[2]), $data);
        fclose($mytemplate);
        $filecreate = $location_view.$argument[2]."/edit.php";
        $create = fopen($filecreate, "w");
        fwrite($create, $data);
        fclose($create);
        print "create ".$argument[2]." views ";
}

// excel template automaticaly ----------------------------------------------- //
