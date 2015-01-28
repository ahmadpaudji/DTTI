<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "admin/beranda";
$route['404_override'] = "welcome";

$route['admin/logout'] = "admin/logout";
$route['admin/login'] = "admin/login";

$route['admin/demo'] = "admin/demo";

//////Modul Master Data
//daftar bank
$route['admin/daftarbank'] = "admin/daftarbank";
$route['admin/daftarbank/tambah'] = "admin/daftarbank/tambah";
$route['admin/daftarbank/aksi_tambah'] = "admin/daftarbank/aksi_tambah";
$route['admin/daftarbank/ubah/(:num)'] = "admin/daftarbank/ubah/$1";
$route['admin/daftarbank/aksi_ubah/(:num)'] = "admin/daftarbank/aksi_ubah/$1";

//////Akhir Modul Master Data

//////Modul Pegawai
//pegawai
$route['admin/pegawai'] = "admin/pegawai";
$route['admin/pegawai/detail/(:num)'] = "admin/pegawai/detail/$1";
$route['admin/pegawai/tambah'] = "admin/pegawai/tambah";
$route['admin/pegawai/aksi_tambah'] = "admin/pegawai/aksi_tambah";
$route['admin/pegawai/aktifasi/(:num)/(:num)'] = "admin/pegawai/aktifasi/$1/$2";

//sim
$route['admin/sim'] = "admin/sim";
$route['admin/sim/tambah'] = "admin/sim/tambah";
$route['admin/sim/aksi_tambah'] = "admin/sim/aksi_tambah";

//bank
$route['admin/bank'] = "admin/bank";
$route['admin/bank/tambah'] = "admin/bank/tambah";
$route['admin/bank/aksi_tambah'] = "admin/bank/aksi_tambah";
$route['admin/bank/ubah/(:num)'] = "admin/bank/ubah/$1";
$route['admin/bank/aksi_ubah/(:num)'] = "admin/bank/aksi_ubah/$1";

//formal
$route['admin/formal'] = "admin/formal";
$route['admin/formal/tambah'] = "admin/formal/tambah";
$route['admin/formal/aksi_tambah'] = "admin/formal/aksi_tambah";

//informal
$route['admin/informal'] = "admin/informal";
$route['admin/informal/tambah'] = "admin/informal/tambah";
$route['admin/informal/aksi_tambah'] = "admin/informal/aksi_tambah";

//usaha
$route['admin/usaha'] = "admin/usaha";
$route['admin/usaha/tambah'] = "admin/usaha/tambah";
$route['admin/usaha/aksi_tambah'] = "admin/usaha/aksi_tambah";

//anak
$route['admin/anak'] = "admin/anak";
$route['admin/anak/tambah'] = "admin/anak/tambah";
$route['admin/anak/aksi_tambah'] = "admin/anak/aksi_tambah";
$route['admin/anak/ubah/(:num)'] = "admin/anak/ubah/$1";

//kendaraan
$route['admin/kendaraan'] = "admin/kendaraan";
$route['admin/kendaraan/tambah'] = "admin/kendaraan/tambah";
$route['admin/kendaraan/aksi_tambah'] = "admin/kendaraan/aksi_tambah";
//////Akhir Modul Pegawai

//////Modul Muhasabah
$route['admin/muhasabah'] = "admin/muhasabah";
$route['admin/muhasabah/cari'] = "admin/muhasabah/index/cari";
$route['admin/muhasabah/tambah/(:num)/(:num)'] = "admin/muhasabah/tambah/$1/$2";
$route['admin/muhasabah/aksi_tambah/(:num)/(:num)'] = "admin/muhasabah/aksi_tambah/$1/$2";
//////Akhir Modul Muhasabah

//////Modul Absen
$route['admin/absen'] = "admin/absen";
$route['admin/absen/cari'] = "admin/absen/index/cari";
$route['admin/presensi'] = "admin/absen/presensi";
$route['admin/presensi/cari'] = "admin/absen/presensi/cari";
$route['admin/upload'] = "admin/absen/upload";
$route['admin/absen/ubah/(:num)'] = "admin/absen/ubah/$1";
//////AkhirModul Absen

//////Modul Pengajuan
//Izin Presensi
$route['admin/izin'] = "admin/izin";
$route['admin/izin/cari'] = "admin/izin/index/cari";
$route['admin/izin/tambah'] = "admin/izin/tambah";

//Pelatihan
$route['admin/pelatihan'] = "admin/pelatihan";
$route['admin/pelatihan/cari'] = "admin/pelatihan/index/cari";
$route['admin/pelatihan/tambah'] = "admin/pelatihan/tambah";
$route['admin/pelatihan/ubah/(:num)'] = "admin/pelatihan/ubah/$1";

//SPPD
$route['admin/sppd/cari'] = "admin/sppd/index/cari";

//////AkhirModul Pengajuan

/* End of file routes.php */
/* Location: ./application/config/routes.php */