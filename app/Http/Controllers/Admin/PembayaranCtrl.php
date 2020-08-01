<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Model\Admin;
use App\Model\User;
use App\Model\Anggota;
use App\Model\Operator;
use App\Model\Pinjaman;

use App\Model\Simpanan;
use App\Model\Simpanan\OpsiSimpanan;


use App\Model\Simpanan\OpsiSimpananLain;
use App\Model\Simpanan\SimpananUmroh;
use App\Model\Simpanan\SimpananPendidikan;

use App\Model\Simpanan\OpsiSimpananBerjangka;
use App\Model\Simpanan\SimpananBerjangka;


use App\Model\Simpanan\TransaksiSimpananLain;
use App\Model\PinjamanTransaksi;
use App\Model\SimpananTransaksi;
use App\Model\Notif;
use App\Model\BuktiBayar;
use App\Model\Syarat;
class PembayaranCtrl extends Controller
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

    function bayar_pinjaman(){
        $data=Pinjaman::where('status_bayar',1)->orderBy('id','DESC')->get();
        return view('admin.pembayaran.data_bayar_pinjaman',[
           'data' => $data
        ]);
    }

    function detail_bayar_pinjaman($id){
        $data=Pinjaman::where('pinjaman_kode', $id)->get();
        $data_bayar=PinjamanTransaksi::where('pinjaman_kode',$id)->orderBy('id','DESC')->get();
        return view('admin.pembayaran.data_bayar_pinjaman_detail',[
            'data_bayar' => $data_bayar,
            'data' => $data
         ]);
    }

    function bayar_pinjaman_act(Request $request){
        $kode=$request->kode;
        $anggota =$request->anggota;
        $date=date('Y-m-d');
        $request->validate([
            'bayar' => 'required',
            'wajib' => 'required',
            'ket_bayar' => 'required',
            'kode' =>'required',
            'kembalian' =>'required',
            'metode' => 'required'
        ]);
        $nominal_fix=$request->bayar - $request->kembalian;
        $sisa_bayar=$request->angsuran - $nominal_fix;
        
        // jika sudah lunas bayar
        if($sisa_bayar == 0){
            Pinjaman::where('pinjaman_kode', $kode)->update([
                'status_bayar' => 2
            ]);
        }
        DB::table('tbl_pinjaman_transaksi')->insert([
            'pinjaman_kode' =>$kode,
            'anggota_id' =>$anggota,
            'tgl_transaksi' =>$date,
            'nominal_bayar' =>$request->bayar,
            'kembalian_bayar' =>$request->kembalian,
            'sisa_bayar' =>$sisa_bayar,
            'ket_bayar' => $request->ket_bayar,
            'metode' => $request->metode
         ]);
         
         $sim_u = Simpanan::where('anggota_id',$anggota)->first();
         $kode_trs_sim ="TRSU-".rand(1000,9999);
         $wajib_tambah = $sim_u->jlh_wajib + $request->wajib;
         Simpanan::where('anggota_id', $anggota)->update([
            'jlh_wajib' => $wajib_tambah
         ]);
         DB::table('tbl_simpanan_transaksi')->insert([
            'anggota_id' =>$anggota,
            'no_rekening' => $sim_u->no_rekening,
            'operator_id' =>Session::get('adm_kode'),
            'kode_simpanan' => "SSK" ,
            'kode_transaksi' =>$kode_trs_sim,
            'nominal_transaksi' => $request->wajib,
            'tgl_transaksi' => date('Y-m-d'),
            'jenis_transaksi' => "Simpanan Wajib",
            'ket_transaksi' => "Pembayaran Simpanan Wajib dari Angsuran Pembiayaan",
            'metode' =>$request->metode,
            'status' => 1
         ]);

        return redirect('admin/pembayaran/pinjaman/detail/'.$kode.'')->with('alert-success','Pembayaran berhasil');

    }

    function hapus_tr_pinjaman($id){
        // $kode_pinjam=PinjamanTransaksi::where('id',$id)->first();
        PinjamanTransaksi::where('id',$id)->delete();
       return redirect()->back()->with('alert-success','Data telah diperbaharui');

    }

    // bagian transfer pinjaman
    function transfer_pinjam_act(Request $request){
        switch ($request->input('action')) {
            case 'terima':
              DB::table('tbl_bukti_bayar')->where('id',$request->bukti_id)->update([
                  'tgl_diterima' => date('Y-m-d'),
                  'status' => 1
              ]);
            return redirect()->back()->with('alert-success','Transfer diterima');
          
                break;
            case 'tolak':
                DB::table('tbl_bukti_bayar')->where('id',$request->bukti_id)->update([
                    'ket_upload' => "Tertolak ".$request->ket,
                    'status' => 2
                ]);
            return redirect()->back()->with('alert-warning','Transfer Ditolak');
        
                break;
             default:
             echo "terlarang";
            break;   
          }

    }

        // delete transfer sim pinjam
        function transfer_pinjam_hapus($id){
            $bukti_bayar=BuktiBayar::where('id',$id)->first();
            File::delete('upload/bukti_bayar/'.$bukti_bayar->isi);
            BuktiBayar::where('id',$id)->delete();
            return redirect()->back()->with('alert-danger','Data Telah Terhapus');
        }


/*
=====================================
    Akhir dari pembayaran pinjaman
====================================
*/


/*
=====================================
    start pembayaran simpanan
====================================
*/

function laman_bayar_simpanan(){
    return view('admin.pembayaran.laman_utama_bayar_sim');
}

//--- simpanan umum bayar
function bayar_sim_umum(){
    $data= Simpanan::orderBy('id','desc')->get();
    return view('admin.pembayaran.laman_bayar_umum',[
        'data' =>$data
    ]);

}

function bayar_sim_umum_detail($id){
    $data= Simpanan::where('no_rekening',$id)->get();
    return view('admin.pembayaran.laman_detail_umum',[
        'data' =>$data
    ]);
}

function bayar_sim_umum_tambah(Request $request){
    $request->validate([
        'nominal' => 'required',
        'jenis_tr' => 'required',
        'metode' => 'required'
    ]);

    $kode_trs="TRSU-" .rand(1000,9999);
    $kode_trs_2="TRSU-" .rand(100,999);

    $saldo = Simpanan::where('no_rekening', $request->no_rek)->first();  
    $ops=OpsiSimpanan::where('id', 1)->first();

    // ini untuk penambahan saldo    
    if($request->jenis_tr == 1){
        $sukarela= $request->nominal - $ops->simpanan_wajib;
        $total_nabung= $sukarela + $saldo->total_simpanan;

        $jlh_wajib =$ops->simpanan_wajib + $saldo->jlh_wajib;
        DB::table('tbl_simpanan_transaksi')->insert([
            'anggota_id' => $request->ang_id,
            'no_rekening' => $request->no_rek,
            'operator_id' => Session::get('adm_kode'),
            'kode_simpanan' => "SSK",
            'kode_transaksi' =>$kode_trs,
            'nominal_transaksi' =>  $sukarela,
            'tgl_transaksi' => date('Y-m-d H:i:s'),
            'jenis_transaksi' => "Simpanan Sukarela",
            'ket_transaksi' => "Nabung Simpanan Sukarela",
            'metode' => $request->metode,
            'sisa_angsuran' => $total_nabung,
            'status' => 1
        ]);

        DB::table('tbl_simpanan_transaksi')->insert([
            'anggota_id' => $request->ang_id,
            'no_rekening' => $request->no_rek,
            'operator_id' => Session::get('adm_kode'),
            'kode_simpanan' => "SSK",
            'kode_transaksi' =>$kode_trs_2,
            'nominal_transaksi' =>  $ops->simpanan_wajib,
            'tgl_transaksi' => date('Y-m-d H:i:s'),
            'jenis_transaksi' => "Simpanan Wajib",
            'ket_transaksi' => "Nabung Simpanan Wajib",
            'metode' => $request->metode,
            'sisa_angsuran' => $jlh_wajib,
            'status' => 1
        ]);

        Simpanan::where('no_rekening',$request->no_rek)->update([
            'total_simpanan' => $total_nabung,
            'jlh_wajib' =>  $jlh_wajib
        ]);

    }
    // ini untuk penarikan
    if($request->jenis_tr == 2){
        $kurang_saldo= $saldo->total_simpanan - $request->nominal;
        DB::table('tbl_simpanan_transaksi')->insert([
            'anggota_id' => $request->ang_id,
            'no_rekening' => $request->no_rek,
            'operator_id' => Session::get('adm_kode'),
            'kode_simpanan' => "SSK",
            'kode_transaksi' =>$kode_trs,
            'nominal_transaksi' => $request->nominal,
            'tgl_transaksi' => date('Y-m-d H:i:s'),
            'jenis_transaksi' => "Simpanan Sukarela",
            'ket_transaksi' => "Penarikan Simpanan",
            'metode' => $request->metode,
            'sisa_angsuran' => $kurang_saldo,
            'status' => 2
        ]);

        Simpanan::where('no_rekening',$request->no_rek)->update([
            'total_simpanan' => $kurang_saldo
        ]);
        
    }
    return redirect()->back()->with('alert-success','Transaksi berhasil');
}


// tutup rekening simpanan umum 
function sim_umum_tutup(Request $request){
    $kode_trs="TRSU-" .rand(1000,9999);
    $kode_trs_2="TRSU-" .rand(100,999);
    $kode_trs_3="TRSU-" .rand(10000,99999);


    $ops = OpsiSimpanan::where('id', 1)->first();
    $sim = Simpanan::where('no_rekening',$request->rek_tutup)->first();
    DB::table('tbl_simpanan')->where('no_rekening', $request->rek_tutup)->update([
        'total_simpanan' => 0,
        'jlh_pokok' => 0,
        'jlh_wajib' => 0,
        'tgl_tutup_rek' => date('Y-m-d H:i:s'),
        'status' => 0
    ]);

    DB::table('tbl_simpanan_transaksi')->insert([
        'anggota_id' => $request->ang_tutup,
        'no_rekening' => $request->rek_tutup,
        'operator_id' => Session::get('adm_kode'),
        'kode_simpanan' => "SSK",
        'kode_transaksi' =>$kode_trs,
        'nominal_transaksi' => $sim->total_simpanan,
        'tgl_transaksi' => date('Y-m-d H:i:s'),
        'jenis_transaksi' => "Simpanan Sukarela",
        'ket_transaksi' => "Penarikan Simpanan",
        'sisa_angsuran' => 0,
        'status' => 2
    ]);

    DB::table('tbl_simpanan_transaksi')->insert([
        'anggota_id' => $request->ang_tutup,
        'no_rekening' => $request->rek_tutup,
        'operator_id' => Session::get('adm_kode'),
        'kode_simpanan' => "SSK",
        'kode_transaksi' =>$kode_trs_2,
        'nominal_transaksi' => $sim->jlh_wajib,
        'tgl_transaksi' => date('Y-m-d H:i:s'),
        'jenis_transaksi' => "Simpanan Wajib",
        'ket_transaksi' => "Penarikan Simpanan",
        'sisa_angsuran' => 0,
        'status' => 2
    ]);

    DB::table('tbl_simpanan_transaksi')->insert([
        'anggota_id' => $request->ang_tutup,
        'no_rekening' => $request->rek_tutup,
        'operator_id' => Session::get('adm_kode'),
        'kode_simpanan' => "SSK",
        'kode_transaksi' =>$kode_trs_3,
        'nominal_transaksi' => $sim->jlh_pokok,
        'tgl_transaksi' => date('Y-m-d H:i:s'),
        'jenis_transaksi' => "Simpanan Wajib",
        'ket_transaksi' => "Penarikan Simpanan",
        'sisa_angsuran' => 0,
        'status' => 2
    ]);

    return redirect()->back()->with('alert-success','Rekening telah Non Aktif');

}


    // bagian transfer simpanan Umum
    function transfer_sim_umum_act(Request $request){
        switch ($request->input('action')) {
            case 'terima':
              DB::table('tbl_bukti_bayar')->where('id',$request->bukti_id)->update([
                  'tgl_diterima' => date('Y-m-d'),
                  'status' => 1
              ]);
            return redirect()->back()->with('alert-success','Transfer diterima');
                break;
            case 'tolak':
                DB::table('tbl_bukti_bayar')->where('id',$request->bukti_id)->update([
                    'ket_upload' => "Tertolak ".$request->ket,
                    'status' => 2
                ]);
            return redirect()->back()->with('alert-warning','Transfer Ditolak');
        
                break;
             default:
             echo "terlarang";
            break;   
            }

    }

    // delete transfer sim umum
    function transfer_sim_umum_hapus($id){
        $bukti_bayar=BuktiBayar::where('id',$id)->first();
        File::delete('upload/bukti_bayar/'.$bukti_bayar->isi);
        BuktiBayar::where('id',$id)->delete();
        return redirect()->back()->with('alert-danger','Data Telah Terhapus');
    }



//--- simpanan deposit bayar
function bayar_sim_deposit(){
    $data= SimpananBerjangka::orderBy('id','desc')->get();
    return view('admin.pembayaran.laman_bayar_deposit',[
        'data' =>$data
    ]);
}

function bayar_sim_deposit_detail($id){
    $data= SimpananBerjangka::where('rekening_deposit',$id)->get();
    return view('admin.pembayaran.laman_detail_deposit',[
        'data' =>$data
    ]);
}

function bayar_sim_deposit_tambah(Request $request){
    $request->validate([
        'nominal' => 'required',
        'jenis_tr' => 'required',
        'metode' => 'required'
    ]);

    $kode_trs="TRUH-" .rand(1000,9999);
    $kode_trs_2="TRUH-" .rand(100,999);

    $saldo = SimpananBerjangka::where('rekening_deposit', $request->no_rek)->first();  
    $ops=OpsiSimpananBerjangka::where('id', $saldo->opsi_deposit_id)->first();

    // ini untuk penambahan saldo    
    if($request->jenis_tr == 1){
  
        $total_nabung= $request->nominal + $saldo->nilai_deposit;
       
        DB::table('tbl_simpanan_transaksi')->insert([
            'anggota_id' => $request->ang_id,
            'no_rekening' => $request->no_rek,
            'operator_id' => Session::get('adm_kode'),
            'kode_simpanan' => "SBK",
            'kode_transaksi' =>$kode_trs,
            'nominal_transaksi' =>  $request->nominal,
            'tgl_transaksi' => date('Y-m-d H:i:s'),
            'jenis_transaksi' => "Simpanan Berjangka",
            'ket_transaksi' => "Nabung Simpanan Berjangka",
            'metode' => $request->metode,
            'status' => 1
        ]);

        SimpananBerjangka::where('rekening_deposit',$request->no_rek)->update([
            'nilai_deposit' => $total_nabung
        ]);

    }
    
    // ini untuk penarikan
    if($request->jenis_tr == 2){
        $kurang_saldo= $saldo->total_nisbah  - $request->nominal;
        $saldo_tarik = ($saldo->total_nisbah - $request->nominal) +  $saldo->nilai_deposit;
        DB::table('tbl_simpanan_transaksi')->insert([
            'anggota_id' => $request->ang_id,
            'no_rekening' => $request->no_rek,
            'operator_id' => Session::get('adm_kode'),
            'kode_simpanan' => "SBK",
            'kode_transaksi' =>$kode_trs,
           
            'nominal_transaksi' => $request->nominal,
            'tgl_transaksi' => date('Y-m-d H:i:s'),
            'jenis_transaksi' => "Simpanan Berjangka",
            'ket_transaksi' => "Penarikan Simpanan Berjangka",
            'metode' => $request->metode,
            'sisa_angsuran' => $saldo_tarik,
            'status' => 2
        ]);

        SimpananBerjangka::where('rekening_deposit',$request->no_rek)->update([
            'total_nisbah' => $kurang_saldo
        ]);
        
    }
    return redirect()->back()->with('alert-success','Transaksi berhasil');

}

// tutup rekening simpanan deposit
function sim_deposit_tutup(Request $request){
 
    $kode_trs_3="TRBK-" .rand(10000,99999);

    $sim = SimpananBerjangka::where('rekening_deposit',$request->rek_tutup)->first();
    $total_tutup =$sim->nilai_deposit + $sim->total_nisbah;

    DB::table('tbl_simpanan_transaksi')->insert([
        'anggota_id' => $request->ang_tutup,
        'no_rekening' => $request->rek_tutup,
        'operator_id' => Session::get('adm_kode'),
        'kode_simpanan' => "SBK",
        'kode_transaksi' =>$kode_trs_3,
        'nominal_transaksi' => $total_tutup,
        'tgl_transaksi' => date('Y-m-d H:i:s'),
        'jenis_transaksi' => "Simpanan Berjangka",
        'ket_transaksi' => "Tutup Rekening Berjangka",
        'status' => 2
    ]);

    DB::table('tbl_simpanan_berjangka')->where('rekening_deposit', $request->rek_tutup)->update([
        'nilai_deposit' => 0,
        'tgl_tarik' => date('Y-m-d H:i:s'),
        'total_nisbah' => 0,
        'status' => 3
    ]);

    Anggota::where('anggota_id', $request->ang_tutup)->update([
        'status_deposit' => 2
    ]);

    return redirect()->back()->with('alert-success','Rekening telah ditutup');

}



    // bagian transfer simpanan deposit
    function transfer_sim_deposit_act(Request $request){


        switch ($request->input('action')) {
            case 'terima':
              DB::table('tbl_bukti_bayar')->where('id',$request->bukti_id)->update([
                  'tgl_diterima' => date('Y-m-d'),
                  'status' => 1
              ]);
            return redirect()->back()->with('alert-success','Transfer diterima');
          
                break;
            case 'tolak':
                DB::table('tbl_bukti_bayar')->where('id',$request->bukti_id)->update([
                    'ket_upload' => "Tertolak ".$request->ket,
                    'status' => 2
                ]);
            return redirect()->back()->with('alert-warning','Transfer Ditolak');
        
                break;
             default:
             echo "terlarang";
            break;   
        }

    }

       // delete transfer sim deposit
       function transfer_sim_deposit_hapus($id){
        $bukti_bayar=BuktiBayar::where('id',$id)->first();
        File::delete('upload/bukti_bayar/'.$bukti_bayar->isi);
        BuktiBayar::where('id',$id)->delete();
        return redirect()->back()->with('alert-danger','Data Telah Terhapus');
    }




//--- simpanan umroh bayar

function bayar_sim_umroh(){
    $data= SimpananUmroh::orderBy('id','desc')->get();
    return view('admin.pembayaran.laman_bayar_umroh',[
        'data' =>$data
    ]);
}

function bayar_sim_umroh_detail($id){

    $data= SimpananUmroh::where('no_rekening',$id)->get();
    return view('admin.pembayaran.laman_detail_umroh',[
        'data' =>$data
    ]);
}

function bayar_sim_umroh_tambah(Request $request){
    $request->validate([
        'nominal' => 'required',
        'jenis_tr' => 'required',
        'metode' => 'required'
    ]);

    $kode_trs="TRUH-" .rand(1000,9999);
    $kode_trs_2="TRUH-" .rand(100,999);

    $saldo = SimpananUmroh::where('no_rekening', $request->no_rek)->first();  
    $ops=OpsiSimpananLain::where('id', $saldo->opsi_simpanan_lain_id)->first();

    // ini untuk penambahan saldo    
    if($request->jenis_tr == 1){
  
        $total_nabung= $request->nominal + $saldo->total_angsur;
        $sisa_tambah= $request->sisa_angsur - $request->nominal;
       
        DB::table('tbl_simpanan_transaksi')->insert([
            'anggota_id' => $request->ang_id,
            'no_rekening' => $request->no_rek,
            'operator_id' => Session::get('adm_kode'),
            'kode_simpanan' => "SUH",
            'kode_transaksi' =>$kode_trs,
            'sisa_angsuran' => $sisa_tambah,
            'nominal_transaksi' =>  $request->nominal,
            'tgl_transaksi' => date('Y-m-d H:i:s'),
            'jenis_transaksi' => "Simpanan Umroh",
            'ket_transaksi' => "Angsuran Simpanan Umroh",
            'metode' => $request->metode,
            'status' => 1
        ]);

        SimpananUmroh::where('no_rekening',$request->no_rek)->update([
            'total_angsur' => $total_nabung
        ]);

    }    
    // ini untuk penarikan
    if($request->jenis_tr == 2){
        $kurang_saldo= $saldo->total_angsur - $request->nominal;
        $sisa_angsur = $request->sisa_angsur + $request->nominal;
        DB::table('tbl_simpanan_transaksi')->insert([
            'anggota_id' => $request->ang_id,
            'no_rekening' => $request->no_rek,
            'operator_id' => Session::get('adm_kode'),
            'kode_simpanan' => "SUH",
            'kode_transaksi' =>$kode_trs,
            'sisa_angsuran' => $sisa_angsur,
            'nominal_transaksi' => $request->nominal,
            'tgl_transaksi' => date('Y-m-d H:i:s'),
            'jenis_transaksi' => "Simpanan Umroh",
            'ket_transaksi' => "Penarikan Simpanan Umroh",
            'metode' => $request->metode,
            'status' => 2
        ]);

        SimpananUmroh::where('no_rekening',$request->no_rek)->update([
            'total_angsur' => $kurang_saldo
        ]);
        
    }
    return redirect()->back()->with('alert-success','Transaksi berhasil');

}


// tutup rekening simpanan umroh
function sim_umroh_tutup(Request $request){
 
    $kode_trs_3="TRSU-" .rand(10000,99999);

    $sim = SimpananUmroh::where('no_rekening',$request->rek_tutup)->first();

    DB::table('tbl_simpanan_transaksi')->insert([
        'anggota_id' => $request->ang_tutup,
        'no_rekening' => $request->rek_tutup,
        'operator_id' => Session::get('adm_kode'),
        'kode_simpanan' => "SUH",
        'kode_transaksi' =>$kode_trs_3,
        'sisa_angsuran' => 0,
        'nominal_transaksi' => $sim->total_angsur,
        'tgl_transaksi' => date('Y-m-d H:i:s'),
        'jenis_transaksi' => "Simpanan Umroh",
        'ket_transaksi' => "Tutup Rekening Umroh",
        'status' => 2
    ]);

    DB::table('tbl_simpanan_umroh')->where('no_rekening', $request->rek_tutup)->update([
        'total_angsur' => 0,
        'tgl_tutup' => date('Y-m-d H:i:s'),
        'status' => 3
    ]);

    Anggota::where('anggota_id', $request->ang_tutup)->update([
        'status_umroh' => 2
    ]);

    return redirect()->back()->with('alert-success','Rekening telah Ditutup');

}


    // bagian transfer simpanan umroh
    function transfer_sim_umroh_act(Request $request){
        switch ($request->input('action')) {
            case 'terima':
              DB::table('tbl_bukti_bayar')->where('id',$request->bukti_id)->update([
                  'tgl_diterima' => date('Y-m-d'),
                  'status' => 1
              ]);
            return redirect()->back()->with('alert-success','Transfer diterima');
          
                break;
            case 'tolak':
                DB::table('tbl_bukti_bayar')->where('id',$request->bukti_id)->update([
                    'ket_upload' => "Tertolak ".$request->ket,
                    'status' => 2
                ]);
            return redirect()->back()->with('alert-warning','Transfer Ditolak');
        
                break;
             default:
             echo "terlarang";
            break;   
        }

    }


        // delete transfer sim umroh
        function transfer_sim_umroh_hapus($id){
            $bukti_bayar=BuktiBayar::where('id',$id)->first();
            File::delete('upload/bukti_bayar/'.$bukti_bayar->isi);
            BuktiBayar::where('id',$id)->delete();
            return redirect()->back()->with('alert-danger','Data Telah Terhapus');
        }



//--- simpanan pendidikan bayar
function bayar_sim_pendidikan(){
    $data= SimpananPendidikan::orderBy('id','desc')->get();
    return view('admin.pembayaran.laman_bayar_pendidikan',[
        'data' =>$data
    ]);
}

function bayar_sim_pendidikan_detail($id){
    $data= SimpananPendidikan::orderBy('id','desc')->get();
    return view('admin.pembayaran.laman_detail_pendidikan',[
        'data' =>$data
    ]);
}

function bayar_sim_pendidikan_tambah(Request $request){
    $request->validate([
        'nominal' => 'required',
        'jenis_tr' => 'required',
        'metode' => 'required'
    ]);

    $kode_trs="TRPN-" .rand(1000,9999);
    $kode_trs_2="TRPN-" .rand(100,999);
    $saldo = SimpananPendidikan::where('no_rekening', $request->no_rek)->first();  
    $ops=OpsiSimpananLain::where('id', $saldo->opsi_simpanan_lain_id)->first();

   // ini untuk penambahan saldo    
   if($request->jenis_tr == 1){
  
        $total_nabung= $request->nominal + $saldo->total_angsur;
        $sisa_tambah= $request->sisa_angsur - $request->nominal;
    
        DB::table('tbl_simpanan_transaksi')->insert([
            'anggota_id' => $request->ang_id,
            'no_rekening' => $request->no_rek,
            'operator_id' => Session::get('adm_kode'),
            'kode_simpanan' => "SPN",
            'kode_transaksi' =>$kode_trs,
            'sisa_angsuran' => $sisa_tambah,
            'nominal_transaksi' =>  $request->nominal,
            'tgl_transaksi' => date('Y-m-d H:i:s'),
            'jenis_transaksi' => "Simpanan Pendidikan",
            'ket_transaksi' => "Angsuran Simpanan Pendidikan",
            'metode' => $request->metode,

            'status' => 1
        ]);

        SimpananPendidikan::where('no_rekening',$request->no_rek)->update([
            'total_angsur' => $total_nabung
        ]);

    }  
    
    // ini untuk penarikan
    if($request->jenis_tr == 2){
        $kurang_saldo= $saldo->total_angsur - $request->nominal;
        $sisa_angsur = $request->sisa_angsur + $request->nominal;
        DB::table('tbl_simpanan_transaksi')->insert([
            'anggota_id' => $request->ang_id,
            'no_rekening' => $request->no_rek,
            'operator_id' => Session::get('adm_kode'),
            'kode_simpanan' => "SPN",
            'kode_transaksi' =>$kode_trs,
            'sisa_angsuran' => $sisa_angsur,
            'nominal_transaksi' => $request->nominal,
            'tgl_transaksi' => date('Y-m-d H:i:s'),
            'jenis_transaksi' => "Simpanan Pendidikan",
            'ket_transaksi' => "Penarikan Simpanan Pendidikan",
            'metode' => $request->metode,
            'status' => 2
        ]);

        SimpananPendidikan::where('no_rekening',$request->no_rek)->update([
            'total_angsur' => $kurang_saldo
        ]);
        
    }
    return redirect()->back()->with('alert-success','Transaksi berhasil');

}


// tutup rekening simpanan pendidikan
function sim_pendidikan_tutup(Request $request){
 
    $kode_trs_3="TRPN-" .rand(10000,99999);

    $sim = SimpananPendidikan::where('no_rekening',$request->rek_tutup)->first();

    DB::table('tbl_simpanan_transaksi')->insert([
        'anggota_id' => $request->ang_tutup,
        'no_rekening' => $request->rek_tutup,
        'operator_id' => Session::get('adm_kode'),
        'kode_simpanan' => "SPN",
        'kode_transaksi' =>$kode_trs_3,
        'sisa_angsuran' => 0,
        'nominal_transaksi' => $sim->total_angsur,
        'tgl_transaksi' => date('Y-m-d H:i:s'),
        'jenis_transaksi' => "Simpanan Pendidikan",
        'ket_transaksi' => "Tutup Rekening Pendidikan",
        'status' => 2
    ]);

    DB::table('tbl_simpanan_pendidikan')->where('no_rekening', $request->rek_tutup)->update([
        'total_angsur' => 0,
        'tgl_tutup' => date('Y-m-d H:i:s'),
        'status' => 3
    ]);

    Anggota::where('anggota_id', $request->ang_tutup)->update([
        'status_pendidikan' => 2
    ]);

    return redirect()->back()->with('alert-success','Rekening telah Ditutup');

}


    // bagian transfer simpanan pendidikan
    function transfer_sim_pendidikan_act(Request $request){

        switch ($request->input('action')) {
            case 'terima':
              DB::table('tbl_bukti_bayar')->where('id',$request->bukti_id)->update([
                  'tgl_diterima' => date('Y-m-d'),
                  'status' => 1
              ]);
            return redirect()->back()->with('alert-success','Transfer diterima');
          
                break;
            case 'tolak':
                DB::table('tbl_bukti_bayar')->where('id',$request->bukti_id)->update([
                    'ket_upload' => "Tertolak ".$request->ket,
                    'status' => 2
                ]);
            return redirect()->back()->with('alert-warning','Transfer Ditolak');
        
                break;
             default:
             echo "terlarang";
            break;   
        }

    }

     
        // delete transfer sim pendidikan
        function transfer_sim_pendidikan_hapus($id){
            $bukti_bayar=BuktiBayar::where('id',$id)->first();
            File::delete('upload/bukti_bayar/'.$bukti_bayar->isi);
            BuktiBayar::where('id',$id)->delete();
            return redirect()->back()->with('alert-danger','Data Telah Terhapus');
        }







}
