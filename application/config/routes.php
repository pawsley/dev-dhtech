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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['finansial']='welcome/finansial';
$route['produk']='welcome/produk';
$route['master-karyawan']='masterkaryawan';
$route['master-karyawan/simpan-data']='masterkaryawan/createpost';
$route['master-karyawan/jsonkar']='masterkaryawan/jsonkar';
$route['master-karyawan/edit/(:any)']='masterkaryawan/edit/$1';
$route['master-cabang']='mastercabang';
$route['master-cabang/simpan-data']='mastercabang/createpost';
$route['master-cabang/jsoncab']='mastercabang/jsoncab';
$route['master-cabang/edit/(:any)']='mastercabang/edit/$1';
$route['master-kustomer']='masterkustomer';
$route['master-kustomer/simpan-data']='masterkustomer/createpost';
$route['master-kustomer/jsonkus']='masterkustomer/jsonkus';
$route['master-kustomer/edit/(:any)']='masterkustomer/edit/$1';
$route['master-supplier']='mastersupplier';
$route['master-supplier/simpan-data']='mastersupplier/createpost';
$route['master-supplier/jsonsup']='mastersupplier/jsonsup';
$route['master-supplier/edit/(:any)']='mastersupplier/edit/$1';
$route['master-diskon']='masterdiskon';
$route['master-diskon/simpan-data']='masterdiskon/createpost';
$route['master-diskon/jsondis']='masterdiskon/jsondis';
$route['master-diskon/edit/(:any)']='masterdiskon/edit/$1';
$route['master-kategori']='masterkategori';
$route['master-kategori/simpan-data']='masterkategori/createpost';
$route['master-kategori/addjenis']='masterkategori/addjenis';
$route['master-kategori/addstorage']='masterkategori/addstorage';
$route['master-kategori/addvariant']='masterkategori/addvariant';
$route['master-kategori/jsonkat/(:any)'] = 'masterkategori/jsonkat/$1';
$route['master-kategori/hapus/(:num)'] = 'masterkategori/deletepost/$1';
$route['master-barang']='masterbarang';
$route['master-barang/simpan-data']='masterbarang/createpost';
$route['master-barang/update-data']='masterbarang/updatepost';
$route['master-barang/loadbrg']='masterbarang/loadbrg';
$route['master-barang/edit/(:any)'] = 'masterbarang/edit/$1';
$route['master-barang/hapus/(:any)'] = 'masterbarang/deletepost/$1';
$route['master-bank']='masterbank';
$route['master-bank/loadbank']='masterbank/loadbank';
$route['master-bank/simpan-data']='masterbank/createpost';
$route['master-bank/update-data']='masterbank/updatepost';
$route['master-bank/hapus/(:num)'] = 'masterbank/deletepost/$1';
$route['master-bank/edit/(:num)'] = 'masterbank/edit/$1';