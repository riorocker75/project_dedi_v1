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


}
