<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Model\User;
use App\Model\Admin;
use App\Model\Pinjaman;
use App\Model\Cat_Pinjaman;
use App\Model\Cat_Simpanan;
use App\Model\Tabungan;
use App\Model\Simpanan;

use App\Model\Anggota;

use App\Model\PinjamanTransaksi;

use App\Model\SimpananTransaksi;

use App\Model\Simpanan\OpsiSimpananLain;
use App\Model\Simpanan\SimpananUmroh;
use App\Model\Simpanan\SimpananPendidikan;

use App\Model\Simpanan\SimpananBerjangka;
use App\Model\Simpanan\OpsiSimpananBerjangka;

use App\Model\BuktiBayar;
use App\Model\Syarat;



use App\Model\Notif;



class TransaksiCtrl extends Controller
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

    function transaksi_simpanan(){
        
        return view('admin.transaksi.data_transaksi_simpanan');
    }

    function transaksi_simpanan_umum(){
        $data=DB::table('tbl_simpanan_transaksi')
        ->select(DB::raw('no_rekening, MAX(id) as id'))
        ->where('kode_simpanan','SSK')
        ->groupBy('no_rekening')
        ->orderby('no_rekening', 'desc')
        ->get();
        // $data= SimpananTransaksi::where('kode_simpanan','SSK')->orderBy('tgl_transaksi','desc')->get();
        return view('admin.transaksi.dt_simpanan_umum',[
            'data' =>$data
        ]);
    }

    function tr_umum_detail($id){
        $data= SimpananTransaksi::where('kode_transaksi',$id)->get();
        
        return view('admin.transaksi.detail_trs_umum',[
            'data' => $data
        ]);
    }

    // transaksi simmpanan berjangka
    function transaksi_deposit(){

        $data=DB::table('tbl_simpanan_transaksi')
        ->select(DB::raw('no_rekening, MAX(id) as id'))
        ->where('kode_simpanan','SBK')
        ->groupBy('no_rekening')
        ->orderby('no_rekening', 'desc')
        ->get();

        return view('admin.transaksi.dt_simpanan_berjangka',[
            'data' =>$data
        ]);
    }

    function tr_deposit_detail($id){
        $data= SimpananTransaksi::where('kode_transaksi',$id)->get();
        return view('admin.transaksi.detail_trs_deposit',[
            'data' => $data
        ]);
    }

    // transaksi simmpanan umroh

    function transaksi_umroh(){

        $data=DB::table('tbl_simpanan_transaksi')
        ->select(DB::raw('no_rekening, MAX(id) as id'))
        ->where('kode_simpanan','SUH')
        ->groupBy('no_rekening')
        ->orderby('no_rekening', 'desc')
        ->get();

        return view('admin.transaksi.dt_simpanan_umroh',[
            'data' =>$data
        ]);
    }


    function tr_umroh_detail($id){
        $data= SimpananTransaksi::where('kode_transaksi',$id)->get();
        return view('admin.transaksi.detail_trs_umroh',[
            'data' => $data
        ]);
    }

    // transaksi simmpanan pendidikan

    function transaksi_pendidikan(){
        $data=DB::table('tbl_simpanan_transaksi')
        ->select(DB::raw('no_rekening, MAX(id) as id'))
        ->where('kode_simpanan','SPN')
        ->groupBy('no_rekening')
        ->orderby('no_rekening', 'desc')
        ->get();
        return view('admin.transaksi.dt_simpanan_pendidikan',[
            'data' =>$data
        ]);
    }

    function tr_pendidikan_detail($id){
        $data= SimpananTransaksi::where('kode_transaksi',$id)->get();
        return view('admin.transaksi.detail_trs_pendidikan',[
            'data' => $data
        ]);
    }

/*
------------------------------------
|   transaksi pinjaman start
-----------------------------------
*/

    function transaksi_pinjaman(){

        $data=DB::table('tbl_pinjaman_transaksi')
        ->select(DB::raw('pinjaman_kode, MAX(id) as id'))
        ->groupBy('pinjaman_kode')
        ->orderby('pinjaman_kode', 'desc')
        ->get();
        return view('admin.transaksi.data_transaksi_pinjaman',[
            'data' =>$data
        ]);
    }

   
/*
------------------------------------
|  end transaksi pinjaman 
-----------------------------------
*/




}
