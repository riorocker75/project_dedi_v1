<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;

use App\Model\Admin;
use App\Model\Cat_Pinjaman;
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


class TarikDana extends Controller
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
----------------------------
|   Penarikan dana umum
-----------------------------
*/

function tarik_dana_umum($id){
    $data =Simpanan::where('no_rekening',$id)->get();
    return view('anggota.penarikan.v_tarik_umum',[
        'data' => $data
    ]);
}

function tarik_dana_umum_act(Request $request){
   $request->validate([
       'nominal' =>'required',
       'info' => 'required'
   ]);
    $kode_tr="TDUM-".rand(1000,9999);
   DB::table('tbl_tarik_dana')->insert([
        'kode_user' => Session::get('ang_id'),
        'kode_transaksi' => $kode_tr,
        'no_rekening' => $request->no_rek,
        'nominal' => $request->nominal,
        'jenis' => "TDUM",
        'tgl_aju' => date('Y-m-d H:i:s'),
        'ket' => "Penarikan Dana Simpanan",
        'info' =>$request->info,
        'status' => 0
   ]);

    return redirect()->back()->with('alert-success','Penarikan berhasil, Harap Tunggu Verifikasi !!');

}

function tarik_dana_umum_delete($id){
  
    DB::table('tbl_tarik_dana')->where('id',$id)->delete();
    return redirect()->back()->with('alert-danger','Data telah dihapus');

}

/*
----------------------------
|   Penarikan dana deposit
-----------------------------
*/

function tarik_dana_deposit($id){
    $data =SimpananBerjangka::where('rekening_deposit',$id)->get();
    return view('anggota.penarikan.v_tarik_deposit',[
        'data' => $data

    ]);
}

function tarik_dana_deposit_act(Request $request){
    $request->validate([
        'nominal' =>'required',
        'info' => 'required'
    ]);
     $kode_tr="TDBK-".rand(1000,9999);
    DB::table('tbl_tarik_dana')->insert([
         'kode_user' => Session::get('ang_id'),
         'kode_transaksi' => $kode_tr,
         'no_rekening' => $request->no_rek,
         'nominal' => $request->nominal,
         'jenis' => "TDBK",
         'tgl_aju' => date('Y-m-d H:i:s'),
         'ket' => "Penarikan Dana Simpanan Berjangka",
         'info' =>$request->info,
         'status' => 0
    ]);
 
     return redirect()->back()->with('alert-success','Penarikan berhasil, Harap Tunggu Verifikasi !!');
}

function tarik_dana_deposit_delete($id){
    DB::table('tbl_tarik_dana')->where('id',$id)->delete();
    return redirect()->back()->with('alert-danger','Data telah dihapus');
}

/*
----------------------------
|   Penarikan dana umroh
-----------------------------
*/
function tarik_dana_umroh($id){
    $data =SimpananUmroh::where('no_rekening',$id)->get();
    return view('anggota.penarikan.v_tarik_umroh',[
        'data' => $data
    ]);
}


function tarik_dana_umroh_act(Request $request){
    $request->validate([
        'nominal' =>'required',
        'info' => 'required'
    ]);
     $kode_tr="TDUH-".rand(1000,9999);
    DB::table('tbl_tarik_dana')->insert([
         'kode_user' => Session::get('ang_id'),
         'kode_transaksi' => $kode_tr,
         'no_rekening' => $request->no_rek,
         'nominal' => $request->nominal,
         'jenis' => "TDUH",
         'tgl_aju' => date('Y-m-d H:i:s'),
         'ket' => "Penarikan Dana Simpanan Umroh",
         'info' =>$request->info,
         'status' => 0
    ]);
 
     return redirect()->back()->with('alert-success','Penarikan berhasil, Harap Tunggu Verifikasi !!');
}

function tarik_dana_umroh_delete($id){
    DB::table('tbl_tarik_dana')->where('id',$id)->delete();
    return redirect()->back()->with('alert-danger','Data telah dihapus');
}

/*
----------------------------
|   Penarikan dana pendidikan
-----------------------------
*/

function tarik_dana_pendidikan($id){
    $data =SimpananPendidikan::where('no_rekening',$id)->get();
    return view('anggota.penarikan.v_tarik_pendidikan',[
        'data' => $data
    ]);
   
}


function tarik_dana_pendidikan_act(Request $request){
    $request->validate([
        'nominal' =>'required',
        'info' => 'required'
    ]);
     $kode_tr="TDPN-".rand(1000,9999);
    DB::table('tbl_tarik_dana')->insert([
         'kode_user' => Session::get('ang_id'),
         'kode_transaksi' => $kode_tr,
         'no_rekening' => $request->no_rek,
         'nominal' => $request->nominal,
         'jenis' => "TDPN",
         'tgl_aju' => date('Y-m-d H:i:s'),
         'ket' => "Penarikan Dana Simpanan Pendidikan",
         'info' =>$request->info,
         'status' => 0
    ]);
 
     return redirect()->back()->with('alert-success','Penarikan berhasil, Harap Tunggu Verifikasi !!');
}

function tarik_dana_pendidikan_delete($id){
    DB::table('tbl_tarik_dana')->where('id',$id)->delete();
    return redirect()->back()->with('alert-danger','Data telah dihapus');
}







}
