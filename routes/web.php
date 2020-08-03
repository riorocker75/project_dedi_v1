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

Route::get('/tes','Anggota\GabungCtrl@tes');
	//
/*
=========================== 
		Login User
===========================
*/
Route::get('/login/user' ,'Auth\AdminLogin');


/*
=========================== 
		Ajax checker
===========================
*/
// 
Route::post('/ajax/cek-angsur','AjaxCtrl@cek_angsuran');
Route::post('/ajax/cek-angsur-fix','AjaxCtrl@cek_angsuran_fix');
Route::post('/ajax/cek-deposit','AjaxCtrl@cek_deposit');
Route::post('/ajax/cek-umroh','AjaxCtrl@cek_umroh');
Route::post('/ajax/cek-pendidikan','AjaxCtrl@cek_pendidikan');


// pengecekan data anggota
Route::post('/ajax/cek-anggota','AjaxCtrl@cek_anggota');


//pengecekan filter laporan shu
Route::post('/ajax/filter-shu','AjaxCtrl@filter_shu');

// pengecekan update baca notif
Route::post('/ajax/notif_ang_update','AjaxCtrl@notif_ang');


/*
=========================== 
		Review File
===========================
*/
Route::get('/review/syarat/{id}','AjaxCtrl@viewfile_pdf');
Route::get('/review/bukti/{id}','AjaxCtrl@viewfile_bukti_pdf');



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
Route::post('/dashboard/admin/operator_update/{id}', 'Admin\OperatorCtrl@operator_update');
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


//--pengaturan simpanan umroh
Route::get('/admin/pengaturan/simpanan-umroh', 'Admin\SimpananCtrl@atur_umroh');
Route::post('/admin/pengaturan/simpanan-umroh/tambah', 'Admin\SimpananCtrl@atur_umroh_act');
Route::get('/admin/pengaturan/simpanan-umroh/edit/{id}', 'Admin\SimpananCtrl@atur_umroh_edit');
Route::post('/admin/pengaturan/simpanan-umroh/update/{id}', 'Admin\SimpananCtrl@atur_umroh_update');

Route::get('/admin/pengaturan/simpanan-umroh/hapus/{id}','Admin\SimpananCtrl@atur_umroh_hapus');





//--pengaturan simpanan pendidikan
Route::get('/admin/pengaturan/simpanan-pendidikan', 'Admin\SimpananCtrl@atur_pendidikan');
Route::post('/admin/pengaturan/simpanan-pendidikan/tambah', 'Admin\SimpananCtrl@atur_pendidikan_act');
Route::get('/admin/pengaturan/simpanan-pendidikan/edit/{id}', 'Admin\SimpananCtrl@atur_pendidikan_edit');
Route::post('/admin/pengaturan/simpanan-pendidikan/update/{id}', 'Admin\SimpananCtrl@atur_pendidikan_update');

Route::get('/admin/pengaturan/simpanan-pendidikan/hapus/{id}','Admin\SimpananCtrl@atur_pendidikan_hapus');


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

/* 
--------------------------------
	mulai data pengajuan
--------------------------------
*/
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

//----simpanan deposit aju
Route::get('/admin/detail/aju/simpanan-deposit/{id}', 'Admin\PengajuanCtrl@aju_sim_deposit');
Route::get('/admin/pemohon/simpanan-deposit/tambah', 'Admin\PengajuanCtrl@aju_sim_deposit_tambah');

Route::post('/admin/pemohon/simpanan-deposit/tambah/act', 'Admin\PengajuanCtrl@aju_sim_deposit_act');


//----simpanan umroh aju
Route::get('/admin/detail/aju/simpanan-umroh/{id}', 'Admin\PengajuanCtrl@aju_sim_umroh');
Route::get('/admin/pemohon/simpanan-umroh/tambah', 'Admin\PengajuanCtrl@aju_sim_umroh_tambah');

Route::post('/admin/pemohon/simpanan-umroh/tambah/act', 'Admin\PengajuanCtrl@aju_sim_umroh_act');

//----simpanan pendidikan aju
Route::get('/admin/detail/aju/simpanan-pendidikan/{id}', 'Admin\PengajuanCtrl@aju_sim_pendidikan');
Route::get('/admin/pemohon/simpanan-pendidikan/tambah', 'Admin\PengajuanCtrl@aju_sim_pendidikan_tambah');

Route::post('/admin/pemohon/simpanan-pendidikan/tambah/act', 'Admin\PengajuanCtrl@aju_sim_pendidikan_act');

/* 
--------------------------------------
	end pengajuan simpanan dan anggota
--------------------------------------
*/

/*
---------------------------------------
	Bagian Transaksi simpanan & pinjaman
---------------------------------------
*/

Route::get('/admin/transaksi/simpanan','Admin\TransaksiCtrl@transaksi_simpanan');
Route::get('/admin/transaksi/pinjaman','Admin\TransaksiCtrl@transaksi_pinjaman');

//----- simpanan umum
Route::get('/admin/transaksi/simpanan-umum','Admin\TransaksiCtrl@transaksi_simpanan_umum');
Route::get('/admin/transaksi/simpanan-umum/detail/{id}', 'Admin\TransaksiCtrl@tr_umum_detail');


//---- simpanan berjangka
Route::get('/admin/transaksi/simpanan-berjangka','Admin\TransaksiCtrl@transaksi_deposit');
Route::get('/admin/transaksi/simpanan-deposit/detail/{id}', 'Admin\TransaksiCtrl@tr_deposit_detail');


//---- simpanan umroh
Route::get('/admin/transaksi/simpanan-umroh','Admin\TransaksiCtrl@transaksi_umroh');
Route::get('/admin/transaksi/simpanan-umroh/detail/{id}', 'Admin\TransaksiCtrl@tr_umroh_detail');

//---- simpanan pendidikan
Route::get('/admin/transaksi/simpanan-pendidikan','Admin\TransaksiCtrl@transaksi_pendidikan');
Route::get('/admin/transaksi/simpanan-pendidikan/detail/{id}', 'Admin\TransaksiCtrl@tr_pendidikan_detail');

/*
----------------------------
	bagian pembayaran
---------------------------
*/
Route::get('/admin/pembayaran/pinjaman','Admin\PembayaranCtrl@bayar_pinjaman');
Route::get('/admin/pembayaran/pinjaman/detail/{id}','Admin\PembayaranCtrl@detail_bayar_pinjaman');
Route::post('/admin/pembayaran/pinjaman/bayar','Admin\PembayaranCtrl@bayar_pinjaman_act');
Route::get('/admin/pembayaran/pinjaman/transaksi/hapus/{id}','Admin\PembayaranCtrl@hapus_tr_pinjaman');


//-- bagian transfer approve pinjaman
Route::post('/admin/pinjaman/detail/transfer/act', 'Admin\PembayaranCtrl@transfer_pinjam_act');
Route::get('/admin/pinjaman/detail/transfer/hapus/{id}', 'Admin\PembayaranCtrl@transfer_pinjam_hapus');

/*
--------------------------------
pembayaran simpanan dan transfer
---------------------------------
*/
Route::get('/admin/pembayaran/simpanan','Admin\PembayaranCtrl@laman_bayar_simpanan');


// ---Bayar Simpanan umum 
Route::get('/admin/pembayaran/simpanan-umum','Admin\PembayaranCtrl@bayar_sim_umum');
Route::get('/admin/pembayaran/simpanan-umum/detail/{id}','Admin\PembayaranCtrl@bayar_sim_umum_detail');
Route::post('/admin/pembayaran/simpanan-umum/tambah','Admin\PembayaranCtrl@bayar_sim_umum_tambah');

//--tutup rekening simpanan umum
Route::post('/admin/pembayaran/simpanan-umum/tutup-rekening','Admin\PembayaranCtrl@sim_umum_tutup');

//-+ bayar simpanan umum di transfer
Route::post('/admin/pembayaran/simpanan-umum/transfer/act','Admin\PembayaranCtrl@transfer_sim_umum_act');
Route::get('/admin/pembayaran/simpanan-umum/transfer/hapus/{id}','Admin\PembayaranCtrl@transfer_sim_umum_hapus');



// ---Bayar Simpanan deposit
Route::get('/admin/pembayaran/simpanan-deposit','Admin\PembayaranCtrl@bayar_sim_deposit');
Route::get('/admin/pembayaran/simpanan-deposit/detail/{id}','Admin\PembayaranCtrl@bayar_sim_deposit_detail');
Route::post('/admin/pembayaran/simpanan-deposit/tambah','Admin\PembayaranCtrl@bayar_sim_deposit_tambah');
//--tutup rekening simpanan pendidikan
Route::post('/admin/pembayaran/simpanan-deposit/tutup-rekening','Admin\PembayaranCtrl@sim_deposit_tutup');
//-+ bayar simpanan deposit di transfer
Route::post('/admin/pembayaran/simpanan-deposit/transfer/act','Admin\PembayaranCtrl@transfer_sim_deposit_act');
Route::get('/admin/pembayaran/simpanan-deposit/transfer/hapus/{id}','Admin\PembayaranCtrl@transfer_sim_deposit_hapus');


// ---Bayar Simpanan umroh
Route::get('/admin/pembayaran/simpanan-umroh','Admin\PembayaranCtrl@bayar_sim_umroh');
Route::get('/admin/pembayaran/simpanan-umroh/detail/{id}','Admin\PembayaranCtrl@bayar_sim_umroh_detail');
Route::post('/admin/pembayaran/simpanan-umroh/tambah','Admin\PembayaranCtrl@bayar_sim_umroh_tambah');

//--tutup rekening simpanan umroh
Route::post('/admin/pembayaran/simpanan-umroh/tutup-rekening','Admin\PembayaranCtrl@sim_umroh_tutup');
//-+ bayar simpanan umroh di transfer
Route::post('/admin/pembayaran/simpanan-umroh/transfer/act','Admin\PembayaranCtrl@transfer_sim_umroh_act');
Route::get('/admin/pembayaran/simpanan-umroh/transfer/hapus/{id}','Admin\PembayaranCtrl@transfer_sim_umroh_hapus');


// ---Bayar Simpanan pendidikan
Route::get('/admin/pembayaran/simpanan-pendidikan','Admin\PembayaranCtrl@bayar_sim_pendidikan');
Route::get('/admin/pembayaran/simpanan-pendidikan/detail/{id}','Admin\PembayaranCtrl@bayar_sim_pendidikan_detail');
Route::post('/admin/pembayaran/simpanan-pendidikan/tambah','Admin\PembayaranCtrl@bayar_sim_pendidikan_tambah');

//--tutup rekening simpanan pendidikan
Route::post('/admin/pembayaran/simpanan-pendidikan/tutup-rekening','Admin\PembayaranCtrl@sim_pendidikan_tutup');
//-+ bayar simpanan pendidikan di transfer
Route::post('/admin/pembayaran/simpanan-pendidikan/transfer/act','Admin\PembayaranCtrl@transfer_sim_pendidikan_act');
Route::get('/admin/pembayaran/simpanan-pendidikan/transfer/hapus/{id}','Admin\PembayaranCtrl@transfer_sim_pendidikan_hapus');


/*
------------------------------------
	Bagian Data Buktii Bayar Transfer
------------------------------------
*/

Route::get('/admin/bukti-bayar/','Admin\BuktiBayarAdm');


/*
-------------------------------------
	bagian Penarikan dana si anggota
-------------------------------------
*/

Route::get('/admin/data/penarikan/dana','Admin\PenarikanCtrl');
// penarikan umum
Route::post('/admin/penarikan/simpanan-umum/act','Admin\PenarikanCtrl@penarikan_umum_act');
Route::get('/admin/penarikan/simpanan-umum/hapus/{id}','Admin\PenarikanCtrl@penarikan_umum_delete');

// penarikan deposit
Route::post('/admin/penarikan/simpanan-deposit/act','Admin\PenarikanCtrl@penarikan_deposit_act');
Route::get('/admin/penarikan/simpanan-deposit/hapus/{id}','Admin\PenarikanCtrl@penarikan_deposit_delete');

// penarikan umroh
Route::post('/admin/penarikan/simpanan-umroh/act','Admin\PenarikanCtrl@penarikan_umroh_act');
Route::get('/admin/penarikan/simpanan-umroh/hapus/{id}','Admin\PenarikanCtrl@penarikan_umroh_delete');

// penarikan pendidikan
Route::post('/admin/penarikan/simpanan-pendidikan/act','Admin\PenarikanCtrl@penarikan_pendidikan_act');
Route::get('/admin/penarikan/simpanan-pendidikan/hapus/{id}','Admin\PenarikanCtrl@penarikan_pendidikan_delete');





/*
--------------------------- 
	Bagian Pengaturan Sistem
---------------------------
*/
Route::get('/admin/pengaturan/syarat', 'Admin\PengaturanCtrl@syarat');
Route::post('/admin/pengaturan/syarat/update', 'Admin\PengaturanCtrl@syarat_update');


Route::get('/admin/pengaturan/syarat', 'Admin\PengaturanCtrl@syarat');
Route::post('/admin/pengaturan/syarat/update', 'Admin\PengaturanCtrl@syarat_update');

Route::get('/admin/pengaturan/rekening', 'Admin\PengaturanCtrl@rekening');
Route::post('/admin/pengaturan/rekening/update', 'Admin\PengaturanCtrl@rekening_update');



/*
--------------------------- 
	Bagian laporan
---------------------------
*/	
//-- laporan shu
Route::get('/admin/laporan/shu','Admin\LaporanCtrl@laporan_shu');
Route::post('/admin/laporan/shu/tambah','Admin\LaporanCtrl@laporan_shu_act');
Route::post('/admin/laporan/shu/update','Admin\LaporanCtrl@laporan_shu_update');

Route::get('/admin/laporan/shu/hapus/{id}','Admin\LaporanCtrl@laporan_shu_hapus');

//-- cetak laporan shu
Route::get('/admin/laporan/shu/cetak/all', 'Admin\LaporanCtrl@cetak_shu_all');
Route::post('/admin/laporan/shu/cetak/filter', 'Admin\LaporanCtrl@cetak_shu_filter');

/*
--------------------------- 
	Bagian Keuangan
---------------------------
*/	

Route::get('/admin/laman/akuntan','Admin\Akuntan@laman_akuntan');

Route::post('/admin/akuntan/kas/tambah','Admin\Akuntan@kas_tambah');
Route::post('/admin/akuntan/kas/update','Admin\Akuntan@kas_update');
Route::get('/admin/akuntan/kas/hapus/{id}','Admin\Akuntan@kas_delete');




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
Route::post('/operator/aju/simpanan-umroh/act/{id}', 'Operator\AnggotaSimpanan@aju_umroh_act');
Route::get('/operator/detail/aju/simpanan-umroh/hapus/{id}', 'Operator\AnggotaSimpanan@aju_umroh_hapus');

Route::post('/operator/detail/aju/simpanan-umroh/pesan/act','Operator\AnggotaSimpanan@pesan_sim_umroh');


//--simpanan pendidikan aju dari sisi anggota
Route::get('/operator/detail/aju/simpanan-pendidikan/{id}', 'Operator\AnggotaSimpanan@aju_sim_pendidikan');
Route::post('/operator/aju/simpanan-pendidikan/act/{id}', 'Operator\AnggotaSimpanan@aju_pendidikan_act');
Route::get('/operator/detail/aju/simpanan-pendidikan/hapus/{id}', 'Operator\AnggotaSimpanan@aju_pendidikan_hapus');

Route::post('/operator/detail/aju/simpanan-pendidikan/pesan/act','Operator\AnggotaSimpanan@pesan_sim_pendidikan');


// verifikasi lanjutan gabung anggota
Route::get('/operator/verifikasi/anggota','Operator\AnggotaGabung@verifikasi_lanjut');
Route::get('/operator/verifikasi/anggota/detail/{id}','Operator\AnggotaGabung@verifikasi_lanjut_detail');
Route::post('/operator/verifikasi/anggota/act','Operator\AnggotaGabung@verifikasi_lanjut_act');

Route::get('/operator/verifikasi/anggota/hapus/{id}','Operator\AnggotaGabung@verifikasi_lanjut_hapus');


// pesan


// laporan operator
Route::get('/operator/laporan/shu','Operator\OPLaporanCtrl@laporan_shu');
Route::get('/operator/laporan/shu/cetak/all','Operator\OPLaporanCtrl@cetak_shu_all');

Route::post('/operator/laporan/shu/cetak/filter','Operator\OPLaporanCtrl@cetak_shu_all');




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

//--ajukan simpanan umroh
Route::get('/anggota/ajukan/simpanan-umroh','Anggota\Ang_SimpananCtrl@aju_simpanan_umroh');
Route::post('/anggota/ajukan/simpanan-umroh/act','Anggota\Ang_SimpananCtrl@aju_umroh_act');

//--ajukan simpanan pendidikan
Route::get('/anggota/ajukan/simpanan-pendidikan','Anggota\Ang_SimpananCtrl@aju_simpanan_pendidikan');
Route::post('/anggota/ajukan/simpanan-pendidikan/act','Anggota\Ang_SimpananCtrl@aju_pendidikan_act');

/*
---------------------------
 	bagian transaksi simpanan
----------------------------
*/
Route::get('/anggota/riwayat/transaksi/','Anggota\Ang_Transaksi@histori_simpanan');


//--transaksi simpanan umum
Route::get('/anggota/simpanan-umum/transaksi/{id}','Anggota\Ang_Transaksi@trs_sim_umum_detail');

//--transaksi simpanan deposit
Route::get('/anggota/simpanan-deposit/transaksi/{id}','Anggota\Ang_Transaksi@trs_sim_deposit_detail');

//--transaksi simpanan umroh
Route::get('/anggota/simpanan-umroh/transaksi/{id}','Anggota\Ang_Transaksi@trs_sim_umroh_detail');

//--transaksi simpanan pendidikan
Route::get('/anggota/simpanan-pendidikan/transaksi/{id}','Anggota\Ang_Transaksi@trs_sim_pendidikan_detail');


// transfer simpanan umum
Route::get('/anggota/simpanan-umum/transfer/{id}' , 'Anggota\BuktiBayarCtrl@transfer_sim_umum');
Route::post('/anggota/simpanan-umum/transfer/act/{id}' , 'Anggota\BuktiBayarCtrl@transfer_sim_umum_act');

// transfer simpanan deposit
Route::get('/anggota/simpanan-deposit/transfer/{id}' , 'Anggota\BuktiBayarCtrl@transfer_sim_deposit');

// transfer simpanan umroh
Route::get('/anggota/simpanan-umroh/transfer/{id}' , 'Anggota\BuktiBayarCtrl@transfer_sim_umroh');
Route::post('/anggota/simpanan-umroh/transfer/act/{id}' , 'Anggota\BuktiBayarCtrl@transfer_sim_umroh_act');

// transfer simpanan pendidikan
Route::get('/anggota/simpanan-pendidikan/transfer/{id}' , 'Anggota\BuktiBayarCtrl@transfer_sim_pendidikan');
Route::post('/anggota/simpanan-pendidikan/transfer/act/{id}' , 'Anggota\BuktiBayarCtrl@transfer_sim_pendidikan_act');


/* 
-----------------------------
bagian bayar uang pendaftaran
-----------------------------
*/

Route::get('/anggota/verifikasi/bayar', 'Anggota\GabungCtrl@upload_bukti_daftar');
Route::post('/anggota/verifikasi/bayar/act', 'Anggota\GabungCtrl@upload_bukti_daftar_act');
Route::get('/anggota/verifikasi/bayar/hapus/{id}', 'Anggota\GabungCtrl@upload_bukti_daftar_hapus');

// bagian bayar upload bukti pembayaran

/* 
--------------------------
|	bayar dengan transfer
---------------------------
*/

//---transfer pinjaman
Route::get('/anggota/pinjaman/bayar/transfer/detail/{id}','Anggota\BuktiBayarCtrl@transfer_pinjaman_detail');
Route::post('/anggota/pinjaman/bayar/transfer/act/{id}','Anggota\BuktiBayarCtrl@transfer_pinjaman_act');


/* 
--------------------------
|	Minta Tarik Dana
---------------------------
*/

// tarik simpanan umum
Route::get('/anggota/simpanan-umum/tarik/{id}','Anggota\TarikDana@tarik_dana_umum');
Route::post('/anggota/simpanan-umum/tarik/act','Anggota\TarikDana@tarik_dana_umum_act');
Route::get('/anggota/simpanan-umum/tarik/delete/{id}','Anggota\TarikDana@tarik_dana_umum_delete');

// tarik simpanan berjangka
Route::get('/anggota/simpanan-deposit/tarik/{id}','Anggota\TarikDana@tarik_dana_deposit');
Route::post('/anggota/simpanan-deposit/tarik/act','Anggota\TarikDana@tarik_dana_deposit_act');
Route::get('/anggota/simpanan-deposit/tarik/delete/{id}','Anggota\TarikDana@tarik_dana_deposit_delete');

// tarik simpanan umroh
Route::get('/anggota/simpanan-umroh/tarik/{id}','Anggota\TarikDana@tarik_dana_umroh');
Route::post('/anggota/simpanan-umroh/tarik/act','Anggota\TarikDana@tarik_dana_umroh_act');
Route::get('/anggota/simpanan-umroh/tarik/delete/{id}','Anggota\TarikDana@tarik_dana_umroh_delete');

// tarik simpanan pendidikan

Route::get('/anggota/simpanan-pendidikan/tarik/{id}','Anggota\TarikDana@tarik_dana_pendidikan');
Route::post('/anggota/simpanan-pendidikan/tarik/act','Anggota\TarikDana@tarik_dana_pendidikan_act');
Route::get('/anggota/simpanan-pendidikan/tarik/delete/{id}','Anggota\TarikDana@tarik_dana_pendidikan_delete');





/*
----------------------------------
|	Cetak RIwayat Transaksi
-----------------------------------
*/

// cetak transaksi umum
Route::post('/cetak/transaksi/simpanan/umum/filter/{id}','CetakCtrl@trs_filter_umum');

// cetak transaksi deposit
Route::post('/cetak/transaksi/simpanan/deposit/filter/{id}','CetakCtrl@trs_filter_deposit');

// cetak transaksi umroh
Route::post('/cetak/transaksi/simpanan/umroh/filter/{id}','CetakCtrl@trs_filter_umroh');

// cetak transaksi pendidikan
Route::post('/cetak/transaksi/simpanan/pendidikan/filter/{id}','CetakCtrl@trs_filter_pendidikan');

// cetak transaksi pinjaman
Route::post('/cetak/transaksi/simpanan/pinjaman/filter/{id}','CetakCtrl@trs_filter_pinjaman');

