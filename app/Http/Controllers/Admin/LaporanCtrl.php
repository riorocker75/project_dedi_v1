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
use App\Model\Anggota;
use App\Model\Operator;
use App\Model\Laporan;
use App\Model\Kas;


use App\Model\Notif;

class LaporanCtrl extends Controller
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

    function __invoke(){}

/*
------------------------------
bagian laporan shu
------------------------------
*/
    function laporan_shu(){
        $data = Laporan::where('jenis', "SHU")->orderBy('tgl','DESC')->get();
        return view('admin.laporan.v_data_laporan',[
            'data' =>$data
        ]);
    }

    function laporan_shu_act(Request $request){
        $kode_lp="LPSHU-".rand(1000,9999);

        $op= Kas::where('id',$request->kas)->first();
        $stat =$request->jenis;
       
        DB::table('tbl_laporan')->insert([
            'nominal' => $request->nominal,
            'kode_laporan'=> $kode_lp,
            'kas_id' => $request->kas,
            'jenis' => "SHU",
            'tgl' => $request->tgl,
            'ket' =>$request->ket,
            'status' => $request->jenis 
        ]);

        if($stat == "1"){
            $tambah_saldo = $op->saldo +$request->nominal;
            DB::table('tbl_kas')->where('id',$request->kas)->update([
                'saldo' => $tambah_saldo
            ]);
        }elseif($stat == "2"){
            $kurang_saldo = $op->saldo - $request->nominal;
            DB::table('tbl_kas')->where('id',$request->kas)->update([
                'saldo' => $kurang_saldo
            ]);
        }
        return redirect()->back()->with('alert-success','Data telah ditambahkan');
    }

    function laporan_shu_hapus($id){

        $lp = Laporan::where('id', $id)->first();
        $kas= Kas::where('id', $lp->kas_id)->first();
        if($lp->status == "1"){
            $saldo_kurang= $kas->saldo - $lp->nominal;
            DB::table('tbl_kas')->where('id', $lp->kas_id)->update([
                'saldo' => $saldo_kurang
            ]);

        }elseif($lp->status == "2"){
            $saldo_tambah= $kas->saldo + $lp->nominal;
            DB::table('tbl_kas')->where('id', $lp->kas_id)->update([
                'saldo' => $saldo_tambah
            ]);      
        }

        DB::table('tbl_laporan')->where('id', $id)->delete();
        return redirect()->back()->with('alert-danger','Data telah dihapus');
    }

    function cetak_shu_all(){
        $tahun =date('Y');
        $cek_data=DB::table('tbl_laporan')->whereYear('tgl', '=',  $tahun)->get();
        if(count($cek_data) < 1){
            return redirect('/admin/laporan/shu');
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
            return redirect('/admin/laporan/shu');
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


/*
------------------------------
end laporan Shu
------------------------------
*/



}
