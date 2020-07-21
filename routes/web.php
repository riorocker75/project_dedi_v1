<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','Front\FrontCtrl');
Route::get('/simulasi','Front\FrontCtrl@simulasi');


/*
=========================== 
		Login
===========================
*/

Route::get('/login/tes' ,'Auth\UserController@tes');


/*
=========================== 
		Login User
===========================
*/
Route::get('/login/user' ,'Auth\AdminLogin');


/*
=========================== 
		Admin
===========================
*/

Route::get('/login/admin' ,'Auth\AdminLogin');
Route::post('/AdminValidate', 'Auth\AdminLogin@loginCheck');
Route::get('/logout/admin' ,'Auth\AdminLogin@logout');

// mulai dashboard admin
Route::get('/dashboard/admin', 'Admin\AdminController');

Route::get('/dashboard/admin/operator', 'Admin\OperatorCtrl@operator');
Route::get('/dashboard/admin/operator_tambah', 'Admin\OperatorCtrl@operator_tambah');
Route::post('/dashboard/admin/operator_act', 'Admin\OperatorCtrl@operator_act');
Route::get('/dashboard/admin/operator_hapus/{id}', 'Admin\OperatorCtrl@operator_hapus');
Route::get('/dashboard/admin/operator_edit/{id}','Admin\OperatorCtrl@operator_edit');
Route::post('/dashboard/admin/operator_update', 'Admin\OperatorCtrl@operator_update');
// Route::post('/dashboard/admin/operator_update', 'Admin\OperatorCtrl@operator_update');

Route::get('/dashboard/admin/anggota', 'Admin\AnggotaCtrl@anggota');
Route::get('/dashboard/admin/anggota_tabungan/{id}', 'Admin\AnggotaCtrl@anggota_tabungan');

// pengaturan simpanan
Route::get('/dashboard/admin/atur_simpanan', 'Admin\SimpananCtrl');
//--pengaturan simpanan umum
Route::get('/admin/pengaturan/simpanan-umum', 'Admin\SimpananCtrl@atur_umum');
Route::post('/admin/pengaturan/simpanan-umum/update', 'Admin\SimpananCtrl@atur_umum_update');

//--pengaturan simpanan deposit
Route::get('/admin/pengaturan/simpanan-deposit', 'Admin\SimpananCtrl@atur_deposit');
Route::post('/admin/pengaturan/simpanan-deposit/tambah','Admin\SimpananCtrl@atur_deposit_act');
Route::get('/admin/pengaturan/simpanan-deposit/edit/{id}', 'Admin\SimpananCtrl@atur_deposit_edit');
Route::post('/admin/pengaturan/simpanan-deposit/update/{id}', 'Admin\SimpananCtrl@atur_deposit_update');

Route::get('/admin/pengaturan/simpanan-deposit/hapus/{id}','Admin\SimpananCtrl@atur_deposit_hapus');


//--pengaturan simpanan lain(umroh dan pendidikan)
Route::get('/admin/pengaturan/simpanan-lain', 'Admin\SimpananCtrl@atur_lain');



// kategori pinjaman
Route::get('/dashboard/admin/kategori_pinjaman', 'Admin\KategoriCtrl@kategori_pinjaman');
Route::post('/dashboard/admin/kategori_pinjaman_act', 'Admin\KategoriCtrl@kategori_pinjaman_act');
Route::get('/dashboard/admin/kategori_pinjaman_hapus/{id}', 'Admin\KategoriCtrl@kategori_pinjaman_hapus');
Route::post('/dashboard/admin/kategori_pinjaman_update', 'Admin\KategoriCtrl@kategori_pinjaman_update');

// permohonan peminjam
Route::get('/admin/permohonan-pinjam','Admin\PinjamanCtrl@permohonan_pinjam');
Route::get('/admin/cek-mohon/{id}','Admin\PinjamanCtrl@cek_mohon');
Route::post('/admin/review-act/{id}','Admin\PinjamanCtrl@review_pinjaman_act');


// data pekerjaan
Route::get('/admin/pekerjaan', 'Admin\PekerjaanCtrl');
Route::post('/admin/pekerjaan/tambah-act', 'Admin\PekerjaanCtrl@tambah_act');
Route::get('/admin/pekerjaan/delete-act/{id}', 'Admin\PekerjaanCtrl@tambah_delete');

// data pengajuan
//---anggota gabung
Route::get('/admin/mohon-gabung','Admin\PengajuanCtrl@anggota_gabung');
Route::get('/admin/detail/anggota-mohon/{id}','Admin\PengajuanCtrl@detail_gabung');

//---tambah anggota
Route::get('/admin/anggota/tambah','Admin\AnggotaCtrl@tambah_anggota');
Route::post('/admin/anggota/tambah/act','Admin\AnggotaCtrl@tambah_anggota_act');

// --detail,edit hapus anggota
Route::get('/admin/detail/anggota/{id}','Admin\AnggotaCtrl@detail_anggota');
Route::post('/admin/detail/anggota/update/{id}','Admin\AnggotaCtrl@update_anggota');
Route::get('/admin/detail/anggota/hapus/{id}','Admin\AnggotaCtrl@hapus_anggota');


//---pinjaman
Route::get('/admin/data-pinjaman','Admin\PengajuanCtrl@data_peminjam');

Route::get('/admin/review-pinjaman/{id}','Admin\PengajuanCtrl@data_peminjam_detail');

//---simpanan
Route::get('/admin/pemohon/simpanan','Admin\PengajuanCtrl@mohon_simpanan');


// Bagian Transaksi
Route::get('/admin/transaksi/simpanan','Admin\TransaksiCtrl@transaksi_simpanan');
Route::get('/admin/transaksi/pinjaman','Admin\TransaksiCtrl@transaksi_pinjaman');

// simpanan umum
Route::get('/admin/transaksi/simpanan-umum','Admin\TransaksiCtrl@transaksi_simpanan_umum');

// simpanan berjangka
Route::get('/admin/transaksi/simpanan-berjangka','Admin\TransaksiCtrl@transaksi_deposito');

// simpanan umroh
Route::get('/admin/transaksi/simpanan-umroh','Admin\TransaksiCtrl@transaksi_umroh');

// simpanan pendidikan
Route::get('/admin/transaksi/simpanan-pendidikan','Admin\TransaksiCtrl@transaksi_pendidikan');

// bagian pembayaran
Route::get('/admin/pembayaran/pinjaman','Admin\PembayaranCtrl@bayar_pinjaman');
Route::get('/admin/pembayaran/pinjaman/detail/{id}','Admin\PembayaranCtrl@detail_bayar_pinjaman');
Route::post('/admin/pembayaran/pinjaman/bayar','Admin\PembayaranCtrl@bayar_pinjaman_act');
Route::get('/admin/pembayaran/pinjaman/transaksi/hapus/{id}','Admin\PembayaranCtrl@hapus_tr_pinjaman');



// laporan
//-- laporan shu
Route::get('/admin/laporan/shu','Admin\LaporanCtrl@laporan_shu');


/*
=========================== 
		Operator
===========================
*/
Route::get('/login/operator' ,'Auth\OperatorLogin');

Route::post('/OperatorValidate', 'Auth\OperatorLogin@loginCheck');
Route::get('/logout/operator' ,'Auth\OperatorLogin@logout');

// mulai dashboard operator
Route::get('/dashboard/operator' ,'Operator\OperatorController');

// data pribadi 
Route::get('/operator/data-pribadi/{id}','Operator\OperatorController@data_pribadi');
Route::post('/operator/data-pribadi-update/{id}','Operator\OperatorController@data_pribadi_update');

// masalah approve anggota baru
Route::get('/operator/mohon-gabung','Operator\AnggotaGabung');
Route::get('/operator/detail/anggota-mohon/{id}','Operator\AnggotaGabung@detail_pemohon');
Route::post('/operator/gabung-act/{id}','Operator\AnggotaGabung@gabung_act');


// masalah peminjaman
Route::get('/operator/data-pinjaman','Operator\OperatorController@data_peminjam');
Route::get('/operator/review-pinjaman/{id}','Operator\OperatorController@review_peminjam');
Route::post('/operator/review-act/{id}','Operator\OperatorController@review_pinjaman_act');

// masalah simpanan
Route::get('/operator/data-simpanan','Operator\AnggotaSimpanan');

//--simpanan umum aju dari sisi anggota
Route::get('/operator/detail/aju/simpanan-umum/{id}','Operator\AnggotaSimpanan@aju_sim_umum');
Route::post('/operator/aju/simpanan-umum/act/{id}', 'Operator\AnggotaSimpanan@aju_umum_act');
Route::get('/operator/detail/aju/simpanan-umum/hapus/{id}', 'Operator\AnggotaSimpanan@aju_umum_hapus');

Route::post('/operator/detail/aju/simpanan-umum/pesan/act','Operator\AnggotaSimpanan@pesan_sim_umum');

//--simpanan deposit aju dari sisi anggota
Route::get('/operator/detail/aju/simpanan-deposit/{id}', 'Operator\AnggotaSimpanan@aju_sim_deposit');
Route::post('/operator/aju/simpanan-deposit/act/{id}', 'Operator\AnggotaSimpanan@aju_deposit_act');
Route::get('/operator/detail/aju/simpanan-deposit/hapus/{id}', 'Operator\AnggotaSimpanan@aju_deposit_hapus');

Route::post('/operator/detail/aju/simpanan-deposit/pesan/act','Operator\AnggotaSimpanan@pesan_sim_deposit');

//--simpanan umroh aju dari sisi anggota
Route::get('/operator/detail/aju/simpanan-umroh/{id}', 'Operator\AnggotaSimpanan@aju_sim_umroh');
Route::post('/operator/aju/simpanan-umroh/act', 'Operator\AnggotaSimpanan@aju_umroh_act');

Route::post('/operator/detail/aju/simpanan-umroh/pesan/act','Operator\AnggotaSimpanan@pesan_sim_umroh');


//--simpanan pendidikan aju dari sisi anggota
Route::get('/operator/detail/aju/simpanan-pendidikan/{id}', 'Operator\AnggotaSimpanan@aju_sim_pendidikan');
Route::post('/operator/aju/simpanan-pendidikan/act', 'Operator\AnggotaSimpanan@aju_pendidikan_act');

Route::post('/operator/detail/aju/simpanan-pendidikan/pesan/act','Operator\AnggotaSimpanan@pesan_sim_pendidikan');


// pesan





/*
=========================== 
		Anggota
===========================
*/

// login 
Route::get('/login/anggota' ,'Auth\AnggotaLogin');

Route::post('/AnggotaValidate', 'Auth\AnggotaLogin@loginCheck');
Route::get('/logout/anggota' ,'Auth\AnggotaLogin@logout');

// daftar 
Route::get('/daftar/anggota' ,'Auth\AnggotaLogin@daftar');
Route::post('/daftar/anggota-act' ,'Auth\AnggotaLogin@daftar_act');

// cek validasi
Route::post('/anggota/cek_nik', 'Auth\AnggotaLogin@cek_nik');
Route::post('/anggota/cek_username', 'Auth\AnggotaLogin@cek_username');

// mulai dashboard anggota
Route::get('/dashboard/anggota', 'Anggota\AnggotaController');


// data pribadi anggota
Route::get('/anggota/data-pribadi/{id}', 'Anggota\AnggotaController@data_pribadi');
Route::post('/anggota/data-pribadi-update/{id}', 'Anggota\AnggotaController@data_pribadi_update');

//ajukan pinjaman anggota
Route::get('/anggota/data-pinjaman/{id}' , 'Anggota\AnggotaController@data_pinjam');
Route::get('/anggota/ajukan-pinjaman' , 'Anggota\AnggotaController@aju_pinjam');
Route::post('/anggota/ajukan-pact' , 'Anggota\AnggotaController@aju_pinjam_act');
Route::get('/anggota/view-pinjaman/{id}', 'Anggota\AnggotaController@view_pinjaman');

// pengecekan di ajax
Route::post('/anggota/cek-angsur','Anggota\AnggotaController@cek_angsuran');
Route::post('/anggota/cek-angsur-fix','Anggota\AnggotaController@cek_angsuran_fix');
Route::post('/anggota/cek-deposit','Anggota\AnggotaController@cek_deposit');



// detail pinjaman
Route::get('/anggota/detail-pinjaman/{id}', 'Anggota\Ang_PinjamanCtrl@simulasi_bayar');


// bagian ajukan simpanan
Route::get('/anggota/aju-simpanan','Anggota\Ang_SimpananCtrl');

//--ajukan simpanan umum
Route::get('/anggota/ajukan/simpanan-umum','Anggota\Ang_SimpananCtrl@aju_simpanan_umum');
Route::post('/anggota/ajukan/simpanan-umum/act','Anggota\Ang_SimpananCtrl@aju_simpanan_umum_act');

//--ajukan simpanan berjangka
Route::get('/anggota/ajukan/simpanan-deposit','Anggota\Ang_SimpananCtrl@aju_simpanan_deposit');
Route::post('/anggota/ajukan/simpanan-deposit/act','Anggota\Ang_SimpananCtrl@aju_deposit_act');

Route::get('/anggota/ajukan/simpanan-umroh','Anggota\Ang_SimpananCtrl@aju_simpanan_umroh');
Route::get('/anggota/ajukan/simpanan-pendidikan','Anggota\Ang_SimpananCtrl@aju_simpanan_pendidikan');

// bagian transaksi
Route::get('/anggota/riwayat/transaksi/','Anggota\Ang_Transaksi@histori_simpanan');

