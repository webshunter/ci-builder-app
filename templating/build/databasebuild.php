<?php
unlink('../../application/config/database.php');
$filecreate = '../../application/config/database.php';
$create = fopen($filecreate, "w");
fwrite($create, $_POST['data']);
fclose($create);
print "Artisan Update updated";

unlink('../../gugus_artisan/database.php');
$filecreate = '../../gugus_artisan/database.php';
$create = fopen($filecreate, "w");
fwrite($create, $_POST['data2']);
fclose($create);
print "Artisan Update updated";