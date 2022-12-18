<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome/blog';
$route['404_override'] = 'welcome/error';


//set slug
$route['app/login'] = 'login';
$route['app/login/process'] = 'login/prosses';

$route['translate_uri_dashes'] = FALSE;
$route['admin/pembelian-baru'] = 'admin/pembelian/tambah_data/';
$route['admin/daftarlain'] = 'daftarlain/index/';
$route['admin/home'] = 'home/index/';
$route['admin/setting/temp'] = 'home/edittmp/';
$route['admin/laporan'] = 'laporan/index/';
$route['admin/kasbank'] = 'admin/akun/cashbank';
$route['admin/profile'] = 'home/profile';
$route['admin/laporan-jurnal'] = 'jurnal/index/1';
$route['admin/laporan-jurnal/hari-ini'] = 'jurnal/index/1';
$route['admin/laporan-jurnal/bulan-ini'] = 'jurnal/index/2';
$route['admin/laporan-jurnal/custome/(:any)/(:any)'] = 'jurnal/cst/3/$1/$2';

$route['admin/list-penjualan'] = 'lp/listjual/index/1';
$route['admin/list-penjualan/hari-ini'] = 'lp/listjual/index/1';
$route['admin/list-penjualan/bulan-ini'] = 'lp/listjual/index/2';
$route['admin/list-penjualan/custome/(:any)/(:any)'] = 'lp/listjual/cst/3/$1/$2';

$route['admin/list-pembelian'] = 'lp/listbeli/index/1';
$route['admin/list-pembelian/hari-ini'] = 'lp/listbeli/index/1';
$route['admin/list-pembelian/bulan-ini'] = 'lp/listbeli/index/2';
$route['admin/list-pembelian/custome/(:any)/(:any)'] = 'lp/listbeli/cst/3/$1/$2';

$route['admin/umur-piutang'] = 'lp/listjual/umurpiutang/1';
$route['admin/umur-piutang/hari-ini'] = 'lp/listjual/umurpiutang/1';
$route['admin/umur-piutang/bulan-ini'] = 'lp/listjual/umurpiutang/2';
$route['admin/umur-piutang/custome/(:any)'] = 'lp/listjual/umurpiutangw/3/$1';

$route['admin/umur-hutang'] = 'lp/listbeli/umurpiutang/1';
$route['admin/umur-hutang/hari-ini'] = 'lp/listbeli/umurpiutang/1';
$route['admin/umur-hutang/bulan-ini'] = 'lp/listbeli/umurpiutang/2';
$route['admin/umur-hutang/custome/(:any)'] = 'lp/listbeli/umurpiutangw/3/$1';

$route['admin/setting'] = 'home/setting';

$route['admin/list-produk'] = 'lp/listproduk';
$route['admin/laporan-persediaan'] = 'lp/listproduk/persediaan';
$route['(:any)'] = 'welcome/blog/$1';
