<?php
//sitemap.php

class sitemap{

    public function getDepartment(){
        return mysqli_connect('localhost', 'indowebs_indo', '#gugusd090397', 'indowebs_indo');
    }

    public function dbquery($qr){
        $getConnection = $this->getDepartment();

        $query = mysqli_query($getConnection, $qr);

        if(preg_match('/\SELECT\b/',$qr)){
	        $box = [];
	        while ($data = mysqli_fetch_assoc($query) ) {
	            $box[] = (object) array_map('utf8_encode', $data);
	        }
	        return $box;
    	}else{
    		return $query;
    	}
    }

    public function run(){
        var_dump($this->dbquery("SELECT DISTINCT(transaksi) FROM properti"));
    }
}

$rd = new sitemap;

$base_url = 'https://indowebs.my.id/';

// $base_url = "http://localhost/tutorial/php-sitemap/";

$xmlfile = "";

header("Content-Type: application/xml; charset=utf-8");

echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
$xmlfile .= '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;
$xmlfile .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;

foreach($rd->dbquery("SELECT slug as tr FROM post WHERE delete_set = '0'") as $post)
{
        echo '<url>' . PHP_EOL;
        echo '<loc>'.$base_url.$post->tr.'/</loc>' . PHP_EOL;
        echo '<changefreq>daily</changefreq>' . PHP_EOL;
        echo '</url>' . PHP_EOL;
        $xmlfile .= '<url>' . PHP_EOL;
        $xmlfile .= '<loc>'.$base_url.$post->tr.'/</loc>' . PHP_EOL;
        $xmlfile .= '<changefreq>daily</changefreq>' . PHP_EOL;
        $xmlfile .= '</url>' . PHP_EOL;
}

echo '</urlset>' . PHP_EOL;
$xmlfile .='</urlset>' . PHP_EOL;

// $myfile = fopen("sitemap.xml", "w") or die("Unable to open file!");
// $txt = $xmlfile;
// fwrite($myfile, $txt);
// fclose($myfile);

?>
