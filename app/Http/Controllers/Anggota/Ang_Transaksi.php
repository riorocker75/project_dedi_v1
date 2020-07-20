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
use App\Model\SimpananTransaksi;

use App\Model\Simpanan\SimpananBerjangka;
use App\Model\Simpanan\SimpananUmroh;
use App\Model\Simpanan\SimpananPendidikan;




use App\Model\Anggota;
use App\Model\Anggota_Gaji;

use App\Model\Operator;
class Ang_Transaksi extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(!Session::get('login-ang')){
                return redirect('login/anggota')->with('alert-danger','Dilarang Masuk Terlarang');
            }
            return $next($request);
        });
        
    }

    public function __invoke(){

    }

    function histori_simpanan(){
        // disini ambil session id nya buat nampilin wher dari simpanan`
        $data_umum = SimpananTransaksi::where('kode_simpanan','SSK')->orderBy('tgl_transaksi')->get();
        $data_deposit = SimpananTransaksi::where('kode_simpanan','SBK')->orderBy('tgl_transaksi')->get();
        $data_umroh = SimpananTransaksi::where('kode_simpanan','SUH')->orderBy('tgl_transaksi')->get();
        $data_pendidikan = SimpananTransaksi::where('kode_simpanan','SPN')->orderBy('tgl_transaksi')->get();

        return view('anggota.transaksi.ang_transaksi_simpanan',[
            'data_umum' =>$data_umum,
            'data_deposit' =>$data_deposit,
            'data_umroh' =>$data_umroh,
            'data_pendidikan' =>$data_pendidikan
        ]);
    }
/*
=================================
|  Transaksi Simpanan umum
=================================
*/
    function trs_sim_umum(){

    }

/*
=================================
|  Transaksi Simpanan deposit
=================================
*/    


/*
=================================
|  Transaksi Simpanan umroh
=================================
*/


/*
=================================
|  Transaksi Simpanan pendidikan
=================================
*/


}
