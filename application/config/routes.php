<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['generate_menu'] = 'admin/Main/generate_menu';

$route['admin-dashboard'] = 'admin/Dashboard';

$route['master/manajemen-kriteria'] = 'admin/Kriteria';
$route['getDataKriteria'] = 'admin/Kriteria/getData';
$route['simpanDataKriteria/(:any)'] = 'admin/Kriteria/simpan/$1';
$route['getKodeKriteria'] = 'admin/Kriteria/getKodeKriteria';
$route['getKriteriaById'] = 'admin/Kriteria/getKriteriaById';
$route['delKriteria'] = 'admin/Kriteria/delete';

$route['kriteria/manajemen-nilai-kriteria'] = 'admin/Kriteria/nilaiKriteria';
$route['updateNilai/(:any)'] = 'admin/Kriteria/updateNilai/$1';
$route['getJumlah'] = 'admin/Kriteria/getJumlah';

$route['master/manajemen-alternatif'] = 'admin/Alternatif';
$route['getDataAlternatif'] = 'admin/Alternatif/getData';
$route['delAlternatif'] = 'admin/Alternatif/delete';

$route['master/manajemen-nilai-alternatif'] = 'admin/Alternatif/nilai_alternatif';
$route['updateNilaiAlternatif'] = 'admin/Alternatif/updateNilaiAlternatif';
$route['getKodeAlternatif'] = 'admin/Alternatif/getKodeAlternatif';
$route['simpanDataAlternatif/(:any)'] = 'admin/Alternatif/simpan/$1';


$route['normalisasi-alternatif'] = 'admin/Normalisasi';

$route['perankingan'] = 'admin/Perankingan';


$route['menu/manajemen-menu'] = 'admin/Menu/manajemen';
$route['getDataMenu'] = 'admin/Menu/getData';
$route['getMenuById/(:any)'] = 'admin/Menu/getMenuById/$1';
$route['getOptionMain'] = 'admin/Menu/getOption';
$route['simpanDataMenu/(:any)'] = 'admin/Menu/simpan/$1';
$route['delMenu/(:any)'] = 'admin/Menu/delete/$1';


$route['menu/manajemen-posisi'] = 'admin/Menu/posisi';
$route['getPosisiMenu'] = 'admin/Menu/getPosisi';
$route['ubahPosisiMenu'] = 'admin/Menu/ubahPosisiMenu';

$route['pengguna/manajemen-jabatan'] = 'admin/Jabatan/manajemen';
$route['getDataJabatan'] = 'admin/Jabatan/getData';
$route['getJabatanById/(:any)'] = 'admin/Jabatan/getJabatanById/$1';
$route['simpanDataJabatan/(:any)'] = 'admin/Jabatan/simpan/$1';
$route['delJabatan/(:any)'] = 'admin/Jabatan/delete/$1';

$route['getPrevilegeJabatan/(:any)'] = 'admin/Jabatan/getPrevilegeJabatan/$1';
$route['simpanPrevileJabatan'] = 'admin/Jabatan/simpanPrevileJabatan';

$route['pengguna/manajemen-akun'] = 'admin/Akun/manajemen';
$route['getDataAkun'] = 'admin/Akun/getData';
$route['getAkunById'] = 'admin/Akun/getAkunById';
$route['simpanDataAkun/(:any)'] = 'admin/Akun/simpan/$1';
$route['delAkun/(:any)'] = 'admin/Akun/delete/$1';

$route['profile'] = 'admin/Akun/profile';

$route['cekLogin'] = 'Auth/cekLogin';
$route['logout'] = 'Auth/logout';

$route['blocked'] = 'Auth/forbidden';

$route['default_controller'] = 'Auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
