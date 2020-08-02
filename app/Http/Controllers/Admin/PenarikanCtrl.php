<?php

namespace App\Http\Controllers\Admin;

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
use App\Model\TarikDana;



class PenarikanCtrl extends Controller
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

    function __invoke(){
        $data=TarikDana::where('status', 0)->orderBy('tgl_aju','desc')->get();
        return view('admin.penarikan.v_data_penarikan',[
            'data' => $data
        ]);
    }
/*
--------------------------------
|   Penarikan simpanan umum
----------------------------------
*/

    function penarikan_umum($id){

    }

/*
--------------------------------
|   Penarikan simpanan deposit
----------------------------------
*/



/*
--------------------------------
|   Penarikan simpanan umroh
----------------------------------
*/



/*
--------------------------------
|   Penarikan simpanan pendidikan
----------------------------------
*/





}
