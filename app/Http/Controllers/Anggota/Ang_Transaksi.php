<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;

use App\Model\Admin;
use App\Model\Pinjaman;
use App\Model\Cat_Pinjaman;
use App\Model\Cat_Simpanan;
use App\Model\Tabungan;

use App\Model\Simpanan;
use App\Model\SimpananTransaksi;

use App\Model\Simpanan\SimpananBerjangka;
use App\Model\Simpanan\OpsiSimpananBerjangka;

use App\Model\Simpanan\OpsiSimpananLain;
use App\Model\Simpanan\SimpananUmroh;
use App\Model\Simpanan\SimpananPendidikan;

use App\Model\Notif;


use App\Model\Anggota;
use App\Model\Anggota_Gaji;

use App\Model\User;
use App\Model\Operator;
use App\Model\BuktiBayar;
use App\Model\Syarat;
class Ang_Transaksi extends Controller
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

    public function __invoke(){

    }

    function histori_simpanan(){
        
        return view('anggota.transaksi.ang_transaksi_simpanan');
    }
/*
=================================
|  Transaksi Simpanan umum
=================================
*/
    function trs_sim_umum_detail($id){
        $data = SimpananTransaksi::where('no_rekening',$id)->orderBy('tgl_transaksi','desc')->get();
        $data_sim =Simpanan::where('no_rekening',$id)->get();
        return view('anggota.transaksi.dt_transaksi_umum_detail',[
            'data' =>$data,
            'data_sim' =>$data_sim
        ]);
    }

    


/*
=================================
|  Transaksi Simpanan deposit
=================================
*/    
function trs_sim_deposit_detail($id){
    $data = SimpananTransaksi::where('no_rekening',$id)->orderBy('tgl_transaksi','desc')->get();
    $data_sim =SimpananBerjangka::where('rekening_deposit',$id)->get();
    return view('anggota.transaksi.dt_transaksi_deposit_detail',[
        'data' =>$data,
        'data_sim' =>$data_sim
    ]);
}

/*
=================================
|  Transaksi Simpanan umroh
=================================
*/
function trs_sim_umroh_detail($id){
    $data = SimpananTransaksi::where('no_rekening',$id)->orderBy('tgl_transaksi','desc')->get();
        $data_sim =SimpananUmroh::where('no_rekening',$id)->get();
        return view('anggota.transaksi.dt_transaksi_umroh_detail',[
            'data' =>$data,
            'data_sim' =>$data_sim
        ]);
  
}

/*
=================================
|  Transaksi Simpanan pendidikan
=================================
*/

function trs_sim_pendidikan_detail($id){
    $data = SimpananTransaksi::where('no_rekening',$id)->orderBy('tgl_transaksi','desc')->get();
    $data_sim =SimpananPendidikan::where('no_rekening',$id)->get();
    return view('anggota.transaksi.dt_transaksi_pendidikan_detail',[
        'data' =>$data,
        'data_sim' =>$data_sim
    ]);

}




}
