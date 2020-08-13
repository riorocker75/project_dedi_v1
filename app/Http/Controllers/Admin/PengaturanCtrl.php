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
use App\Model\Anggota;
use App\Model\Operator;
use App\Model\User;
use App\Model\Notif;
use App\Model\BuktiBayar;
use App\Model\Syarat;
use App\Model\Option;
class PengaturanCtrl extends Controller
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

    /*
--------------------------- 
	Bagian Pengaturan web
---------------------------
*/
    function web(){
        return view('admin.pengaturan.v_atur_web');
    }

    function web_update(Request $request){
        DB::table('tbl_option')->where('option_name', 'web_name')->update([
            'option_value' => $request->web
        ]);
        return redirect()->back()->with('alert-success','Web Telah Di Update');
    }
/*
--------------------------- 
	Bagian Pengaturan Syarat
---------------------------
*/

    function syarat(){
        return view('admin.pengaturan.v_atur_syarat');
    }

    function syarat_update(Request $request){
        DB::table('tbl_option')->where('option_name', 'syarat')->update([
            'option_value' => $request->syarat
        ]);
        return redirect()->back()->with('alert-success','Syarat Telah Di Update');
    }


/*
--------------------------- 
	Bagian Pengaturan Rekening
---------------------------
*/

function rekening(){
    return view('admin.pengaturan.v_atur_rekening');
}

function rekening_update(Request $request){
    DB::table('tbl_option')->where('option_name', 'rekening')->update([
        'option_value' => $request->rekening
    ]);
    return redirect()->back()->with('alert-success','Nomor Rekening Telah Di Update');
}


    // end

    // pengaturan hak akses
    function akses(){
        return view('admin.pengaturan.v_akses');
    }

    function akses_tambah(Request $request){
        
     $request->validate([
        'pegawai' => 'required',
        'akses' => 'required'
     ]); 

     $cek=Operator::where('operator_kode',$request->pegawai)->first();
      
    DB::table('tbl_user')->insert([
        'nama' => $cek->operator_nama,
        'username' => $cek->operator_username,
        'password' => $cek->operator_password,
        'kode_user' => $cek->operator_kode,
        'level' => $request->akses,
        'status' => 1
    ]); 
    return redirect('/admin/pengaturan/akses')->with('alert-success','Data telah ditambahkan');
    }

    function akses_edit($id){
        $data=User::where('id',$id)->get();
        return view('admin.pengaturan.v_akses_edit',[
            'data' => $data
        ]);
    }

    function akses_update(Request $request,$id){
        $request->validate([
            'akses' => 'required'
        ]);
        
        DB::table('tbl_user')->where('id',$id)->update([
            'level' => $request->akses
        ]);
        
        return redirect('/admin/pengaturan/akses')->with('alert-success','Data telah diperbaharui');

    }

    function akses_hapus($id){
        DB::table('tbl_user')->where('id',$id)->delete();
        return redirect('/admin/pengaturan/akses')->with('alert-success','Data telah dihapus');

    }
    // end pengaturan hak akses


}
