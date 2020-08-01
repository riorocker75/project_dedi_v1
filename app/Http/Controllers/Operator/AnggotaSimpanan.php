<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Model\Admin;
use App\Model\User;
use App\Model\Anggota;
use App\Model\Operator;
use App\Model\Pinjaman;
use App\Model\Cat_Pinjaman;

use App\Model\Notif;

use App\Model\Simpanan;
use App\Model\Simpanan\OpsiSimpanan;

use App\Model\Simpanan\SimpananBerjangka;
use App\Model\Simpanan\OpsiSimpananBerjangka;

use App\Model\Simpanan\OpsiSimpananLain;
use App\Model\Simpanan\SimpananUmroh;
use App\Model\Simpanan\SimpananPendidikan;

use App\Model\SimpananTransaksi;

use App\Model\BuktiBayar;
use App\Model\Syarat;
class AnggotaSimpanan extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(!Session::get('login-op')){
                return redirect('login/user')->with('alert-danger','Dilarang Masuk Terlarang');
            }
            return $next($request);
        });
        
    }

    function __invoke(){
        // $data=Anggota::where();
        return view('operator.data_aju_simpanan');
    }

    function tambah_mohon(){
        $data=Anggota::where('status',1)->get();
        return view('operator.data_simpanan_mohon',[
            'anggota' => $data
        ]);
    }

/*
==============================
|   Pengajuan simpanan umum
==============================
*/    
    function aju_sim_umum($id){
        $data=Simpanan::where('no_rekening',$id)->get();
        return view('operator.simpanan.op_aju_simpanan_umum',[
            'data' =>$data
        ]);
    }

    function aju_umum_act(Request $request,$id){
     
            $request->validate([
                'sukarela' => 'required'
            ]);
            $sp = Simpanan::where('no_rekening',$id)->first();
            $date=date('Y-m-d');

            Anggota::where('anggota_id',$request->ang_id)->update([
                'status_simpanan' =>1
            ]);
            Simpanan::where('no_rekening',$id)->update([
                 'status' => 1,
                 'tgl_buka_rek' =>$date,
                 'total_simpanan' =>$request->sukarela   
            ]);
             
            $total_simpan=$request->sukarela - $sp->jlh_wajib;

            $kode_trs="TRSU-" .rand(1000,9999);
            $kode_trs_2="TRSU-" .rand(100,999);
            $kode_trs_3="TRSU-" .rand(10000,99999);
            //   transaksi pertama
            SimpananTransaksi::create([
                    'anggota_id' =>$request->ang_id,
                    'no_rekening' => $id,  
                    'operator_id' =>Session::get('op_kode'),
                    'kode_simpanan' => "SSK",
                    'kode_transaksi' => $kode_trs,
                    'nominal_transaksi' => $total_simpan,
                    'tgl_transaksi' => date('Y-m-d'),
                    'jenis_transaksi' => "Simpanan Sukarela",
                    'ket_transaksi' => "Pembayaran Simpanan Sukarela Pertama",
                    'status' => 1
            ]); 

            // simpanan pokok pertama
            SimpananTransaksi::create([
                'anggota_id' =>$request->ang_id,
                'no_rekening' => $id,  
                'operator_id' =>Session::get('op_kode'),
                'kode_simpanan' => "SSK",
                'kode_transaksi' => $kode_trs_2,
                'nominal_transaksi' => $sp->jlh_pokok,
                'tgl_transaksi' => date('Y-m-d'),
                'jenis_transaksi' => "Simpanan Pokok",
                'ket_transaksi' => "Pembayaran Simpanan Pokok Pertama",
                'status' => 1
        ]); 
          
        // simpanan wajib pertama
        SimpananTransaksi::create([
            'anggota_id' =>$request->ang_id,
            'no_rekening' => $id,  
            'operator_id' =>Session::get('op_kode'),
            'kode_simpanan' => "SSK",
            'kode_transaksi' => $kode_trs_3,
            'nominal_transaksi' => $sp->jlh_wajib,
            'tgl_transaksi' => date('Y-m-d'),
            'jenis_transaksi' => "Simpanan Pokok",
            'ket_transaksi' => "Pembayaran Simpanan Wajib Pertama",
            'status' => 1
    ]);
            return redirect('/operator/data-simpanan')->with('alert-success','Simpanan Berhasil Di setujui');
    }


    function aju_umum_hapus($id){
        Simpanan::where('no_rekening',$id)->delete();
        return redirect('/operator/data-simpanan')->with('alert-danger','Data Telah dihapus');
    }


  
    function pesan_sim_umum(Request $request){
        $date=date('Y-m-d');
        Notif::create([
            'kode_user' => $request->ang_kode,
            'pesan' => $request->pesan,
            'ket' => "Permohonan Buka Simpanan Sukarela",
            'tgl' => $date,
            'level' => 3,
            'status_baca' =>0,
            'status' =>0
        ]);
        return redirect()->back()->with('alert-success','Pesan telah disampaikan');
    }

/*
================================
|   Pengajuan simpanan deposit
================================
*/ 
    function aju_sim_deposit($id){
        $data=SimpananBerjangka::where('rekening_deposit',$id)->get();
        return view('operator.simpanan.op_aju_simpanan_deposit',[
            'data' =>$data
        ]);
    }
    function aju_deposit_act(Request $request,$id){
        $date=date('Y-m-d H:i:s');
        
        $request->validate([
            'nominal' => 'required'
        ]);
         $ops= OpsiSimpananBerjangka::where('id', $request->nominal)->first();   

        SimpananBerjangka::where('rekening_deposit',$id)->update([
            'opsi_deposit_id' => $request->nominal,
            'nilai_deposit' => $ops->nominal_deposit,
            'jangka_deposit' => $ops->periode_deposit,
            'status' => 1,
            'tgl_deposit' =>$date

        ]);

        Anggota::where('anggota_id', $request->ang_id)->update([
            'status_deposit' => 1
        ]);

        $kode_trs="TRBK-" .rand(1000,9999);
        //   transaksi pertama
        SimpananTransaksi::create([
                'anggota_id' =>$request->ang_id,
                'no_rekening' => $id,  
                'operator_id' =>Session::get('op_kode'),
                'kode_simpanan' => "SBK",
                'kode_transaksi' => $kode_trs,
                'nominal_transaksi' => $ops->nominal_deposit,
                'tgl_transaksi' => date('Y-m-d'),
                'jenis_transaksi' => "Simpanan Berjangka",
                'ket_transaksi' => "Pembayaran Simpanan Berjangka Pertama",
                'metode' => 1,
                'sisa_angsuran' =>$ops->nominal_deposit,
                'status' => 1
        ]);

        return redirect('/operator/data-simpanan')->with('alert-success','Data telah diupdate');

    }

    function aju_deposit_hapus($id){
        SimpananBerjangka::where('rekening_deposit',$id)->delete();
        return redirect('/operator/data-simpanan')->with('alert-danger','Data Telah dihapus');
        
    }

    function pesan_sim_deposit(Request $request){
        $date=date('Y-m-d');
        Notif::create([
            'kode_user' => $request->ang_kode,
            'pesan' => $request->pesan,
            'ket' => "Permohonan Buka Simpanan Berjangka",
            'tgl' =>$date,
            'level' => 3,
            'status_baca' =>0,
            'status' =>0
        ]);
        return redirect()->back()->with('alert-success','Pesan telah disampaikan');
    }


/*
==================================
|   Pengajuan simpanan umroh
==================================
*/     

    function aju_sim_umroh($id){
        $data=SimpananUmroh::where('no_rekening',$id)->get();
        return view('operator.simpanan.op_aju_simpanan_umroh',[
            'data' =>$data
        ]);
     

    }

    function aju_umroh_act(Request $request,$id){
        $date=date('Y-m-d');
        
        $request->validate([
            'nominal' => 'required'
        ]);
         $ops= OpsiSimpananLain::where('id', $request->nominal)->first();   

        DB::table('tbl_simpanan_umroh')->where('no_rekening',$id)->update([
            'opsi_simpanan_lain_id' => $request->nominal,
            'angsuran_umroh' => $ops->angsuran_simpanan,
            'jangka_umroh' => $ops->jangka_simpanan,
            'total' => $ops->total_simpanan,
            'total_angsur' => $ops->angsuran_simpanan,
            'status_aju' => 1,
            'status' => 1,
            'tgl_mulai' =>$date

        ]);

        Anggota::where('anggota_id', $request->ang_id)->update([
            'status_umroh' => 1
        ]);

        $sisa_bayar =$ops->total_simpanan - $ops->angsuran_simpanan;
        $kode_trs="TRUH-" .rand(1000,9999);
        //   transaksi pertama
        DB::table('tbl_simpanan_transaksi')->insert([
                'anggota_id' =>$request->ang_id,
                'no_rekening' => $id,  
                'operator_id' =>Session::get('op_kode'),
                'kode_simpanan' => "SUH",
                'kode_transaksi' => $kode_trs,
                'sisa_angsuran' =>$sisa_bayar,
                'nominal_transaksi' => $ops->angsuran_simpanan,
                'tgl_transaksi' => date('Y-m-d'),
                'jenis_transaksi' => "Simpanan Umroh",
                'ket_transaksi' => "Pembayaran Angsuran Simpanan Umroh Pertama",
                'metode' => 1,

                'status' => 1
        ]);

        return redirect('/operator/data-simpanan')->with('alert-success','Data telah diupdate');    


    }


    function aju_umroh_hapus($id){
        SimpananUmroh::where('no_rekening',$id)->delete();
        return redirect('/operator/data-simpanan')->with('alert-danger','Data Telah dihapus');
        
    }
    function pesan_sim_umroh(Request $request){
        $date=date('Y-m-d');
        Notif::create([
            'kode_user' => $request->ang_kode,
            'pesan' => $request->pesan,
            'ket' => "Permohonan Buka Simpanan Umroh",
            'tgl' => $date,
            'level' => 3,
            'status_baca' =>0,
            'status' =>0
        ]);
        return redirect()->back()->with('alert-success','Pesan telah disampaikan');
    }

/*
==================================
|   Pengajuan simpanan pendidikan
==================================
*/      
    function aju_sim_pendidikan($id){
        $data=SimpananPendidikan::where('no_rekening',$id)->get();
        return view('operator.simpanan.op_aju_simpanan_pendidikan',[
            'data' =>$data
        ]);
    }
    function aju_pendidikan_act(Request $request,$id){
        $date=date('Y-m-d');
        
        $request->validate([
            'nominal' => 'required'
        ]);
         $ops= OpsiSimpananLain::where('id', $request->nominal)->first();   

         DB::table('tbl_simpanan_pendidikan')->where('no_rekening',$id)->update([
            'opsi_simpanan_lain_id' => $request->nominal,
            'angsuran_pend' => $ops->angsuran_simpanan,
            'jangka_pend' => $ops->jangka_simpanan,
            'total' => $ops->total_simpanan,
            'total_angsur' => $ops->angsuran_simpanan,
            'status_aju' => 1,
            'status' => 1,
            'tgl_mulai' =>$date

        ]);    
         Anggota::where('anggota_id', $request->ang_id)->update([
            'status_pendidikan' => 1
        ]);
        $thn=$ops->jangka_simpanan * 12;
        $murni_angsur= $ops->angsuran_simpanan * $thn;    
        $sisa_bayar =$murni_angsur - $ops->angsuran_simpanan;
        $kode_trs="TRPN-" .rand(1000,9999);
        //   transaksi pertama
        DB::table('tbl_simpanan_transaksi')->insert([
                'anggota_id' =>$request->ang_id,
                'no_rekening' => $id,  
                'operator_id' =>Session::get('op_kode'),
                'kode_simpanan' => "SPN",
                'kode_transaksi' => $kode_trs,
                'sisa_angsuran' =>$sisa_bayar,
                'nominal_transaksi' => $ops->angsuran_simpanan,
                'tgl_transaksi' => date('Y-m-d'),
                'jenis_transaksi' => "Simpanan Pendidikan",
                'ket_transaksi' => "Pembayaran Angsuran Simpanan Pendidikan Pertama",
                'metode' => 1,

                'status' => 1
        ]);

        return redirect('/operator/data-simpanan')->with('alert-success','Data telah diupdate');



    }

    function aju_pendidikan_hapus($id){
        SimpananPendidikan::where('no_rekening',$id)->delete();
        return redirect('/operator/data-simpanan')->with('alert-danger','Data Telah dihapus');
    }
    function pesan_sim_pendidikan(Request $request){
        $date=date('Y-m-d');
        Notif::create([
            'kode_user' => $request->ang_kode,
            'pesan' => $request->pesan,
            'ket' => "Permohonan Buka Simpanan Pendidikan",
            'tgl' => $date,
            'level' => 3,
            'status_baca' =>0,
            'status' =>0
        ]);
        return redirect()->back()->with('alert-success','Pesan telah disampaikan');
    }
   

}
