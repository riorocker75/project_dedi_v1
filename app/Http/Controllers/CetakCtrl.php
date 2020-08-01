<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
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
use App\Model\BuktiBayar;
use App\Model\Syarat;


use App\Model\Simpanan\SimpananPendidikan;
use App\Model\Simpanan\SimpananUmroh;

use App\Model\Simpanan\OpsiSimpananLain;

use App\Model\Simpanan\SimpananBerjangka;
use App\Model\Simpanan\OpsiSimpananBerjangka;
use App\Model\Simpanan\TransaksiSimpananLain;
use App\Model\PinjamanTransaksi;

use App\Model\Simpanan;
use App\Model\SimpananTransaksi;

use App\Model\Simpanan\OpsiSimpanan;

class CetakCtrl extends Controller
{
    
/*
-------------------------------------------
|	Cetak RIwayat Transaksi Simpanan Umum
-------------------------------------------
*/

        function trs_filter_umum(Request $request,$id){
                $dari =$request->dari;
                $sampai =$request->sampai;  

                $fdari=format_tanggal(date('Y-m-d',strtotime($dari)));
                $fsampai=format_tanggal(date('Y-m-d',strtotime($sampai)));

                $cek_data=DB::table('tbl_simpanan_transaksi')
                        ->where('no_rekening',$id)
                        ->whereBetween('tgl_transaksi', [$dari, $sampai])
                        ->orderBy('tgl_transaksi','desc')
                        ->get();

                if(count($cek_data) < 1){
                     return redirect()->back();
                }
                        
                return view('cetak.v_cetak_umum_all',[
                    'data' =>$cek_data,
                    'dari' => $fdari,
                    'sampai' => $fsampai,

                ]);


        }



/*
-----------------------------------------------
|	Cetak RIwayat Transaksi Simpanan Berjangka
-----------------------------------------------
*/
        function trs_filter_deposit(Request $request,$id){
                $dari =$request->dari;
                $sampai =$request->sampai;  

                $fdari=format_tanggal(date('Y-m-d',strtotime($dari)));
                $fsampai=format_tanggal(date('Y-m-d',strtotime($sampai)));

                $cek_data=DB::table('tbl_simpanan_transaksi')
                        ->where('no_rekening',$id)
                        ->whereBetween('tgl_transaksi', [$dari, $sampai])
                        ->orderBy('tgl_transaksi','DESC')
                        ->get();

                if(count($cek_data) < 1){
                     return redirect()->back();
                }
                        
                return view('cetak.v_cetak_deposit_all',[
                    'data' =>$cek_data,
                    'dari' => $fdari,
                    'sampai' => $fsampai,

                ]);

        }

 
 /*
-----------------------------------------------
|	Cetak RIwayat Transaksi Simpanan Umroh
-----------------------------------------------
*/       
        function trs_filter_umroh(Request $request,$id){
                $dari =$request->dari;
                $sampai =$request->sampai;  

                $fdari=format_tanggal(date('Y-m-d',strtotime($dari)));
                $fsampai=format_tanggal(date('Y-m-d',strtotime($sampai)));

                $cek_data=DB::table('tbl_simpanan_transaksi')
                        ->where('no_rekening',$id)
                        ->whereBetween('tgl_transaksi', [$dari, $sampai])
                        ->orderBy('tgl_transaksi','DESC')
                        ->get();

                if(count($cek_data) < 1){
                     return redirect()->back();
                }
                        
                return view('cetak.v_cetak_umroh_all',[
                    'data' =>$cek_data,
                    'dari' => $fdari,
                    'sampai' => $fsampai,
                ]);
        }

/*
-----------------------------------------------
|	Cetak RIwayat Transaksi Simpanan Pendidikan
-----------------------------------------------
*/
        function trs_filter_pendidikan(Request $request,$id){
                $dari =$request->dari;
                $sampai =$request->sampai;  

                $fdari=format_tanggal(date('Y-m-d',strtotime($dari)));
                $fsampai=format_tanggal(date('Y-m-d',strtotime($sampai)));

                $cek_data=DB::table('tbl_simpanan_transaksi')
                        ->where('no_rekening',$id)
                        ->whereBetween('tgl_transaksi', [$dari, $sampai])
                        ->orderBy('tgl_transaksi','DESC')
                        ->get();

                if(count($cek_data) < 1){
                     return redirect()->back();
                }
                        
                return view('cetak.v_cetak_pendidikan_all',[
                    'data' =>$cek_data,
                    'dari' => $fdari,
                    'sampai' => $fsampai,
                ]);
        }



/*
-----------------------------------------------
|	Cetak RIwayat Transaksi Pinjmanan
-----------------------------------------------
*/
function trs_filter_pinjaman(Request $request,$id){
        $dari =$request->dari;
        $sampai =$request->sampai;  

        $fdari=format_tanggal(date('Y-m-d',strtotime($dari)));
        $fsampai=format_tanggal(date('Y-m-d',strtotime($sampai)));

        $cek_data=DB::table('tbl_pinjaman_transaksi')
                ->where('pinjaman_kode',$id)
                ->whereBetween('tgl_transaksi', [$dari, $sampai])
                ->orderBy('tgl_transaksi','DESC')
                ->get();

        if(count($cek_data) < 1){
             return redirect()->back();
        }
                
        return view('cetak.v_cetak_pinjaman_all',[
            'data' =>$cek_data,
            'dari' => $fdari,
            'sampai' => $fsampai,
        ]);
        
}







}
