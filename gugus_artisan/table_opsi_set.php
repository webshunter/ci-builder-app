<?php 

function ai($value = 11)
{
	return 'INT('.$value.') AUTO_INCREMENT PRIMARY KEY';
}

function char($value = 255, $def = NULL)
{
	if ($def != NULL) {
		return " VARCHAR($value) NOT NULL DEFAULT '$def' ";
	}else{
		return " VARCHAR($value) ";
	}
}

function no($value = 11)
{
	return 'INT('.$value.')';
}

function text()
{
	return 'TEXT';
}

function textlong()
{
	return 'LONGTEXT';
}
function timestamp()
{
	return ' TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ';
}
function timestampupdate()
{
	return ' TIMESTAMP NULL DEFAULT NULL ';
}

function relation($table, $tablerow, $relation, $key = "id")
{
	return 'ALTER TABLE `'.$table.'` ADD FOREIGN KEY (`'.$tablerow.'`) REFERENCES `'.$relation.'`(`'.$key.'`) ON DELETE RESTRICT ON UPDATE RESTRICT;';
}


function command( $link_name ,$table){
	return "php gugus template $link_name --crud $table";
}



// comand for get custome

function custome1($el ,$key, $content)
{
	return "
        \"$el\" => [
            \"key\" => [$key],
            \"content\" => \"$content\",
        ],
    ";
}

function custome2($el ,$table, $condition, $value, $get)
{
	return "
        \"$el\" => [
            \"replacerow\" => [
				\"table\" => \"$table\",
				\"condition\" => [$condition],
				\"value\" => [$value],
				\"get\" => \"$get\",
			],
        ],
    ";
}



