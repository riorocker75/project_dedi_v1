<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;
use App\Model\User;
use App\Model\Admin;
use App\Model\Pinjaman;
use App\Model\Cat_Pinjaman;
use App\Model\Cat_Simpanan;
use App\Model\Tabungan;
use App\Model\Simpanan;

use App\Model\Anggota;
use App\Model\Anggota_Gaji;

use App\Model\Operator;
use App\Model\Notif;

use App\Model\SimpananTransaksi;

use App\Model\Simpanan\SimpananBerjangka;
use App\Model\Simpanan\OpsiSimpananBerjangka;

use App\Model\Simpanan\SimpananUmroh;
use App\Model\Simpanan\SimpananPendidikan;
use App\Model\Simpanan\OpsiSimpananLain;

use App\Model\BuktiBayar;
use App\Model\Syarat;
class PengajuanCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(!Session::get('login-adm')){
                return redirect('login/user')->with('alert-danger','Dilarang Masuk Terlarang');
            }
            return $next($request);
        });
        
    }

    // data pengajuan anggota
    function anggota_gabung(){
        $data=Anggota::where('status',1)->orderBy('anggota_id','DESC')->get();
        return view('admin.v_data_gabung_anggota',[
            'data_mohon' =>$data
        ]);
    }

    function detail_gabung($id){
        $data=Anggota::where('anggota_id',$id)->get();
        return view('admin.v_data_gabung_detail',[
            'anggota' =>$data
        ]);
    }

    // data pengajuan mohon pinjam
    function data_peminjam(){
        $data_aju= Pinjaman::where('pinjaman_status','1')->get();
        return view('admin.v_data_peminjam',[
            'data_aju' => $data_aju
        ]);
    }

    function data_peminjam_detail($id){
        $data=Pinjaman::where('id', $id)->get();
        $pribadi =Pinjaman::where('id',$id)->first();
        $anggota= Anggota::where('anggota_id', $pribadi->anggota_id)->get();
         return view('admin.v_data_peminjam_detail',[
             'data' =>$data,
             'pribadi' => $anggota
         ]);
    }

/*
==========================
    pengajuan simpanan
==========================    
*/

function mohon_simpanan(){
    return view('admin.simpanan.data_aju_simpanan');
}

/*
================================
|   Pengajuan simpanan deposit
================================
*/ 
function aju_sim_deposit($id){
    $data=SimpananBerjangka::where('rekening_deposit',$id)->get();
    return view('admin.simpanan.pengajuan.ad_aju_simpanan_deposit',[
        'data' =>$data
    ]);
}


function aju_sim_deposit_tambah(){
    $data=Anggota::orderBy('anggota_id','desc')->get();
    return view('admin.simpanan.pengajuan.ad_tambah_aju_deposit',[
        'data' =>$data
    ]);
}

function aju_sim_deposit_act(Request $request){
    $no_rek='86'.rand(1000,9999);
    $date=date('Y-m-d H:i:s');
    $request->validate([
        'nama' => 'required',
        'nominal' => 'required'
    ]);
     $ops= OpsiSimpananBerjangka::where('id', $request->nominal)->first();   

    SimpananBerjangka::create([
        'opsi_deposit_id' => $request->nominal,
        'anggota_id' => $request->nama,
        'rekening_deposit' => $no_rek,
        'nilai_deposit' => $ops->nominal_deposit,
        'jangka_deposit' => $ops->periode_deposit,
        'status' => 1,
        'tgl_deposit' =>$date
    ]);

    Anggota::where('anggota_id', $request->nama)->update([
        'status_deposit' => 1
    ]);

    $kode_trs="TRBK-" .rand(1000,9999);
        //   transaksi pertama
        SimpananTransaksi::create([
                'anggota_id' =>$request->nama,
                'no_rekening' => $no_rek,  
                'operator_id' =>Session::get('adm_kode'),
                'kode_simpanan' => "SBK",
                'kode_transaksi' => $kode_trs,
                'nominal_transaksi' => $ops->nominal_deposit,
                'tgl_transaksi' => date('Y-m-d'),
                'jenis_transaksi' => "Simpanan Berjangka",
                'ket_transaksi' => "Pembayaran Simpanan Berjangka Pertama",
                'status' => 1
        ]);

        return redirect('/admin/pemohon/simpanan')->with('alert-success','Data telah ditambahkan');


}

/*
================================
|   Pengajuan simpanan umroh
================================
*/ 
function aju_sim_umroh($id){
    $data=SimpananUmroh::where('no_rekening',$id)->get();
    return view('admin.simpanan.pengajuan.ad_aju_simpanan_umroh',[
        'data' =>$data
    ]);
}


function aju_sim_umroh_tambah(){
    $data=Anggota::orderBy('anggota_id','desc')->get();
    return view('admin.simpanan.pengajuan.ad_tambah_aju_umroh',[
        'data' =>$data
    ]);
}

function aju_sim_umroh_act(Request $request){
    $no_rek='85'.rand(1000,9999);

    $date=date('Y-m-d');
    $request->validate([
        'nama' => 'required',
        'nominal' => 'required'
    ]);

    $nilai_simpan=OpsiSimpananLain::where('id', $request->nominal)->first();
    DB::table('tbl_simpanan_umroh')->insert([
       'anggota_id' => $request->nama,
       'no_rekening' => $no_rek,
       'opsi_simpanan_lain_id' =>$request->nominal,
       'jangka_umroh' => $nilai_simpan->jangka_simpanan,
       'angsuran_umroh' => $nilai_simpan->angsuran_simpanan,
       'total' => $nilai_simpan->total_simpanan,
       'total_angsur' =>$ops->angsuran_simpanan,
       'tgl_mulai' => $date,
       'status_aju' =>1,
       'status' =>1
    ]);

    Anggota::where('anggota_id', $request->nama)->update([
        'status_umroh' => 1
    ]);

    $sisa_bayar =$ops->total_simpanan - $ops->angsuran_simpanan;
    $kode_trs="TRUH-" .rand(1000,9999);
    //   transaksi pertama
    DB::table('tbl_simpanan_transaksi')->insert([
            'anggota_id' =>$request->nama,
            'no_rekening' => $no_rek,  
            'operator_id' =>Session::get('adm_kode'),
            'kode_simpanan' => "SUH",
            'kode_transaksi' => $kode_trs,
            'sisa_angsuran' =>$sisa_bayar,
            'nominal_transaksi' => $ops->angsuran_simpanan,
            'tgl_transaksi' => date('Y-m-d'),
            'jenis_transaksi' => "Simpanan Umroh",
            'ket_transaksi' => "Pembayaran Angsuran Simpanan Umroh Pertama",
            'status' => 1
    ]);

    return redirect('/admin/pemohon/simpanan')->with('alert-success','Data telah ditambahkan');
    
}

/*
================================
|   Pengajuan simpanan pendidikan
================================
*/ 
function aju_sim_pendidikan($id){
    $data=SimpananPendidikan::where('no_rekening',$id)->get();
    return view('admin.simpanan.pengajuan.ad_aju_simpanan_pendidikan',[
        'data' =>$data
    ]);
}

function aju_sim_pendidikan_tambah(){
    $data=Anggota::orderBy('anggota_id','desc')->get();
    return view('admin.simpanan.pengajuan.ad_tambah_aju_pendidikan',[
        'data' =>$data
    ]);
}

function aju_sim_pendidikan_act(Request $request){
    $no_rek='84'.rand(1000,9999);
    $date=date('Y-m-d');
    $request->validate([
        'nama' => 'required',
        'nominal' => 'required'
    ]);

    $ops= OpsiSimpananLain::where('id', $request->nominal)->first();   

    DB::table('tbl_simpanan_pendidikan')->insert([
       'anggota_id' => $request->nama,
        'no_rekening' => $no_rek,
        'opsi_simpanan_lain_id' =>$request->nominal,
       'angsuran_pend' => $ops->angsuran_simpanan,
       'jangka_pend' => $ops->jangka_simpanan,
       'total' => $ops->total_simpanan,
       'total_angsur' =>$ops->angsuran_simpanan,
       'status_aju' => 1,
       'status' => 1,
       'tgl_mulai' =>$date

   ]);    
    Anggota::where('anggota_id', $request->nama)->update([
       'status_pendidikan' => 1
   ]);


   $thn=$ops->jangka_simpanan * 12;
   $murni_angsur= $ops->angsuran_simpanan * $thn;    
   $sisa_bayar =$murni_angsur - $ops->angsuran_simpanan;
   $kode_trs="TRPN-" .rand(1000,9999);
   //   transaksi pertama
   DB::table('tbl_simpanan_transaksi')->insert([
           'anggota_id' =>$request->nama,
           'no_rekening' => $no_rek,  
           'operator_id' =>Session::get('adm_kode'),
           'kode_simpanan' => "SPN",
           'kode_transaksi' => $kode_trs,
           'sisa_angsuran' =>$sisa_bayar,
           'nominal_transaksi' => $ops->angsuran_simpanan,
           'tgl_transaksi' => date('Y-m-d'),
           'jenis_transaksi' => "Simpanan Pendidikan",
           'ket_transaksi' => "Pembayaran Angsuran Simpanan Pendidikan Pertama",
           'status' => 1
   ]);



}
// end pengajuan simpanan

}
