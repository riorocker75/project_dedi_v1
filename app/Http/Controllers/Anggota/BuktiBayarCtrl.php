<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use File;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;

use App\Model\Admin;
use App\Model\Cat_Pinjaman;
use App\Model\Cat_Simpanan;
use App\Model\Tabungan;

use App\Model\Anggota;
use App\Model\Anggota_Gaji;

use App\Model\Operator;


use App\Model\Simpanan;
use App\Model\Simpanan\OpsiSimpanan;
use App\Model\SimpananTransaksi;

use App\Model\Pinjaman;
use App\Model\PinjamanTransaksi;

use App\Model\Simpanan\SimpananBerjangka;
use App\Model\Simpanan\OpsiSimpananBerjangka;

use App\Model\Simpanan\OpsiSimpananLain;
use App\Model\Simpanan\SimpananUmroh;
use App\Model\Simpanan\SimpananPendidikan;


use App\Model\Notif;

use App\Model\User;
use App\Model\BuktiBayar;
use App\Model\Syarat;


class BuktiBayarCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(!Session::get('login-ang')){
                return redirect('login/user')->with('alert-danger','Dilarang Masuk Terlarang');
            }
            return $next($request);
        });
        
    }


/* 
-----------------------------
    transfer pinjaman 
-----------------------------
*/
    function transfer_pinjaman_detail($id){
        $data = Pinjaman::where('pinjaman_kode',$id)->get();
        return view('anggota.transfer.tf_detail_pinjaman',[
            'data' => $data
        ]);
    }

    function transfer_pinjaman_act(Request $request,$id){
        $this->validate($request, [
			'bukti' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $kode_by= "TRP-".rand(1000,9999);
        $bukti_bayar =$request->file('bukti');
        $nf_bukti_bayar = rand(10000,9999)."_".rand(1000,9999).".".$bukti_bayar->getClientOriginalExtension();
        $tujuan_upload = 'upload/bukti_bayar';

        $bukti_bayar->move($tujuan_upload,$nf_bukti_bayar);
        

        DB::table('tbl_bukti_bayar')->insert([
            'anggota_id' => Session::get('ang_id'),
            'kode_transaksi' => $kode_by,
            'no_rekening' =>  $id,
            'nominal' => $request->dibayar,
            'isi' =>$nf_bukti_bayar,
            'tgl_upload' => date('Y-m-d'),
            'jenis_upload' => "TRFP",
            'ket_upload' => "Bayar Angsuran Pinjaman",
            'status' => 0
        ]);


        return redirect()->back()->with('alert-success','Data Telah Terkirim, Tunggu Verifikasi !!');


    }

    function transfer_pinjaman_hapus($id){

    }


/* 
-----------------------------
    transfer Simpanan Umum
-----------------------------
*/


/* 
-----------------------------
    transfer Simpanan Umroh
-----------------------------
*/




/* 
--------------------------------
    transfer Simpanan Pendidikam
--------------------------------
*/





}

