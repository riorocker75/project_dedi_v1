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

use App\Model\Anggota;
use App\Model\Operator;
use App\Model\Notif;

use App\Model\User;

use App\Model\BuktiBayar;
use App\Model\Syarat;


class Ang_PinjamanCtrl extends Controller
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


    function __invoke(){

    }

    function simulasi_bayar($id){
        $data=Pinjaman::where('id',$id)->get();
        $pribadi =Pinjaman::where('id',$id)->first();
        $anggota= Anggota::where('anggota_id', $pribadi->anggota_id)->get();
        return view('anggota.detail_pinjaman',[
            'simulasi' => $data,
            'pribadi' => $anggota
        ]);
    }

}
