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
$route['master-karyawan']='MasterKaryawan';
$route['master-karyawan/simpan-data']='MasterKaryawan/createpost';
$route['master-karyawan/jsonkar']='MasterKaryawan/jsonkar';
$route['master-karyawan/edit/(:any)']='MasterKaryawan/edit/$1';
$route['master-cabang']='MasterCabang';
$route['master-cabang/simpan-data']='MasterCabang/createpost';
$route['master-cabang/jsoncab']='MasterCabang/jsoncab';
$route['master-cabang/edit/(:any)']='MasterCabang/edit/$1';
$route['master-kustomer']='MasterKustomer';
$route['master-kustomer/simpan-data']='MasterKustomer/createpost';
$route['master-kustomer/jsonkus']='MasterKustomer/jsonkus';
$route['master-kustomer/edit/(:any)']='MasterKustomer/edit/$1';
$route['master-supplier']='MasterSupplier';
$route['master-supplier/simpan-data']='MasterSupplier/createpost';
$route['master-supplier/jsonsup']='MasterSupplier/jsonsup';
$route['master-supplier/edit/(:any)']='MasterSupplier/edit/$1';
$route['master-diskon']='MasterDiskon';
$route['master-diskon/simpan-data']='MasterDiskon/createpost';
$route['master-diskon/jsondis']='MasterDiskon/jsondis';
$route['master-diskon/edit/(:any)']='MasterDiskon/edit/$1';
$route['master-kategori']='MasterKategori';
$route['master-kategori/simpan-data']='MasterKategori/createpost';
$route['master-kategori/addjenis']='MasterKategori/addjenis';
$route['master-kategori/addstorage']='MasterKategori/addstorage';
$route['master-kategori/addvariant']='MasterKategori/addvariant';
$route['master-kategori/jsonkat/(:any)'] = 'MasterKategori/jsonkat/$1';
$route['master-kategori/hapus/(:num)'] = 'MasterKategori/deletepost/$1';
$route['master-barang']='MasterBarang';
$route['master-barang/simpan-data']='MasterBarang/createpost';
$route['master-barang/update-data']='MasterBarang/updatepost';
$route['master-barang/loadbrg']='MasterBarang/loadbrg';
$route['master-barang/edit/(:any)'] = 'MasterBarang/edit/$1';
$route['master-barang/hapus/(:any)'] = 'MasterBarang/deletepost/$1';
$route['master-bank']='MasterBank';
$route['master-bank/loadbank']='MasterBank/loadbank';
$route['master-bank/simpan-data']='MasterBank/createpost';
$route['master-bank/update-data']='MasterBank/updatepost';
$route['master-bank/hapus/(:num)'] = 'MasterBank/deletepost/$1';
$route['master-bank/edit/(:num)'] = 'MasterBank/edit/$1';
$route['barang-masuk']='InventoriStok/bm';
$route['barang-masuk/loadbm']='InventoriStok/loadbm';
$route['barang-masuk/simpan-barang-baru']='InventoriStok/addmb';
$route['barang-masuk/simpan-barang-bekas']='InventoriStok/addmk';
$route['barang-masuk/hapus/(:num)'] = 'InventoriStok/deletepost/$1';
$route['barang-keluar']='BarangKeluar';
$route['barang-keluar/stock/(:any)']='BarangKeluar/datacount/$1';
$route['barang-keluar/loadbk']='BarangKeluar/loadbk';
$route['barang-keluar/getsk/(:any)']='BarangKeluar/getsk/$1';
$route['barang-keluar/getdetailsk/(:any)']='BarangKeluar/getdetailsk/$1';
$route['barang-keluar/groupsk']='BarangKeluar/groupsk';
$route['barang-keluar/simpan-barang-baru']='BarangKeluar/addmb';
$route['barang-keluar/simpan-barang-bekas']='BarangKeluar/addmk';
$route['barang-keluar/hapus/(:num)'] = 'BarangKeluar/deletepost/$1';
$route['barang-keluar/printsk/(:any)'] = 'BarangKeluar/formatsk/$1';
$route['terima-barang']='BarangTerima';
$route['terima-barang/groupsk']='BarangTerima/groupsk';
$route['terima-barang/filtersk/(:any)']='BarangTerima/filtersk/$1';
$route['terima-barang/approve']='BarangTerima/approve';
$route['stock-opname']='StockOpname';