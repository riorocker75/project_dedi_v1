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

use App\Model\Anggota;
use App\Model\Anggota_Gaji;

use App\Model\Operator;

use App\Model\Simpanan\OpsiSimpananBerjangka;
use App\Model\Simpanan\OpsiSimpananLain;

use App\Model\Notif;

use App\Model\User;
use App\Model\BuktiBayar;
use App\Model\Syarat;
use File;

class GabungCtrl extends Controller
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


    // upload syarat daftar

    function upload_bukti_daftar(){
        return view('anggota.verifikasi_akun');
    }

    function upload_bukti_daftar_act(Request $request){
        $this->validate($request, [
			'syarat' => 'required|file|mimes:pdf,jpeg,png,jpg|max:2048',
			'bukti_bayar' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
		
        ]);
         
        $kode_s= "SRT-".rand(1000,9999);
        $kode_by= "PDT-".rand(1000,9999);
        $syarat = $request->file('syarat');
        $bukti_bayar =$request->file('bukti_bayar');

        // $nf_syarat = rand(1000,9999)."_".$syarat->getClientOriginalName();
        // $nf_bukti_bayar = rand(10000,9999)."_".$bukti_bayar->getClientOriginalName();

        $nf_syarat = rand(1000,9999)."_".rand(10000,9999).".".$syarat->getClientOriginalExtension();
        $nf_bukti_bayar = rand(10000,9999)."_".rand(1000,9999).".".$bukti_bayar->getClientOriginalExtension();
        $tujuan_upload = 'upload/syarat';
       


        $syarat->move($tujuan_upload,$nf_syarat);
        $bukti_bayar->move($tujuan_upload,$nf_bukti_bayar);
         
        DB::table('tbl_syarat')->insert([
            'anggota_id' => Session::get('ang_id'),
            'kode_syarat' => $kode_s,
            'isi' =>  $nf_syarat,
            'bukti' =>$nf_bukti_bayar,
            'tgl_upload' => date('Y-m-d'),
            'ket_syarat' => "Untuk Melengkapi Syarat Gabung Anggota",
            'status' => 0
        ]);


        return redirect()->back()->with('alert-success','Data Telah Terkirim, Tunggu Verifikasi !!');

    }

    function upload_bukti_daftar_hapus($id){
        $syarat=Syarat::where('id',$id)->first();
        File::delete('upload/syarat/'.$syarat->isi);
        File::delete('upload/syarat/'.$syarat->bukti);

        Syarat::where('id',$id)->delete();
        return redirect()->back()->with('alert-danger','Data Telah Terhapus');
    }


    function tes(){
        return view('tester');
    }

}
