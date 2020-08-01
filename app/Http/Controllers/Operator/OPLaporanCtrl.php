<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Model\User;
use App\Model\Admin;
use App\Model\Anggota;
use App\Model\Operator;
use App\Model\Laporan;
use App\Model\Kas;


use App\Model\Notif;

class OPLaporanCtrl extends Controller
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


    function laporan_shu(){
        $data = Laporan::where('jenis', "SHU")->orderBy('tgl','DESC')->get();
        return view('operator.laporan.op_laporan_shu',[
            'data' =>$data
        ]);
    }

    function cetak_shu_all(){
        $tahun =date('Y');
        $cek_data=DB::table('tbl_laporan')->whereYear('tgl', '=',  $tahun)->get();
        if(count($cek_data) < 1){
            return redirect('/operator/laporan/shu');
        }
        $data_masuk =DB::table('tbl_laporan')
                    ->where(['status'=> 1,'jenis'=> "SHU"])
                    ->whereYear('tgl', '=',  $tahun)
                    ->get();
        $data_keluar =DB::table('tbl_laporan')
                    ->where(['status'=> 2,'jenis'=> "SHU"])
                    ->whereYear('tgl', '=',  $tahun)
                    ->get();            
        return view('admin.laporan.v_cetak_shu',[
           'data_masuk' => $data_masuk,
           'data_keluar' => $data_keluar,
        ]);
    }

    function cetak_shu_filter(Request $request){
        $dari =$request->dari;
        $sampai =$request->sampai;
        $data_filter=DB::table('tbl_laporan')
                    ->where('jenis' , "SHU")
                    ->whereBetween('tgl', [$dari, $sampai])
                    ->get();
        $fdari=format_tanggal(date('Y-m-d',strtotime($dari)));
        $fsampai=format_tanggal(date('Y-m-d',strtotime($sampai)));
        if(count($data_filter) < 1){
            return redirect('/operator/laporan/shu');

        }
        $data_masuk =DB::table('tbl_laporan')
                    ->where(['status'=> 1,'jenis'=> "SHU"])
                    ->whereBetween('tgl', [$dari, $sampai])
                    ->get();
        $data_keluar =DB::table('tbl_laporan')
                    ->where(['status'=> 2,'jenis'=> "SHU"])
                    ->whereBetween('tgl', [$dari, $sampai])
                    ->get();    
        $total_masuk=DB::table('tbl_laporan')
                    ->where(['status'=> 1,'jenis'=> "SHU"])
                    ->whereBetween('tgl', [$dari, $sampai])
                    ->sum('nominal');  
        $total_keluar=DB::table('tbl_laporan')
                    ->where(['status'=> 2,'jenis'=> "SHU"])
                    ->whereBetween('tgl', [$dari, $sampai])
                    ->sum('nominal');  
        $laba_kotor =$total_masuk -$total_keluar ;                   
        return view('admin.laporan.v_cetak_shu_filter',[
           'data_masuk' => $data_masuk,
           'data_keluar' => $data_keluar,
           'total_masuk' =>$total_masuk,
           'total_keluar' =>$total_keluar,
           'dari' => $fdari,
           'sampai' => $fsampai,
           'laba_kotor' =>$laba_kotor

        ]);
    }
}
