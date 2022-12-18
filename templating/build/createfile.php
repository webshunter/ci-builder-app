<?php
$dir = "../setting/";
if (file_exists($dir.$_POST['name'])) {
    unlink($dir.$_POST['name']);
}
$filecreate = $dir.$_POST['name'];
$create = fopen($filecreate, "w");
fwrite($create, $_POST['data']);
fclose($create);
print "Artisan Update updated";