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
use App\Model\User;
use App\Model\Anggota;
use App\Model\Operator;
use App\Model\Pinjaman;

use App\Model\Simpanan;
use App\Model\Simpanan\OpsiSimpanan;


use App\Model\Simpanan\OpsiSimpananLain;
use App\Model\Simpanan\SimpananUmroh;
use App\Model\Simpanan\SimpananPendidikan;

use App\Model\Simpanan\OpsiSimpananBerjangka;
use App\Model\Simpanan\SimpananBerjangka;


use App\Model\Simpanan\TransaksiSimpananLain;
use App\Model\PinjamanTransaksi;
use App\Model\SimpananTransaksi;
use App\Model\Notif;
use App\Model\BuktiBayar;
use App\Model\Syarat;
class BuktiBayarAdm extends Controller
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

        $data =BuktiBayar::where('status',0)->orderBy('tgl_upload','DESC')->get();
        return view('admin.v_bukti_bayar',[
           'data' => $data
        ]);
      

    }





}
