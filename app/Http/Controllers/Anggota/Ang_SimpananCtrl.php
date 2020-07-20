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
use App\Model\Simpanan\OpsiSimpanan;

use App\Model\SimpananLain;
use App\Model\Simpanan\OpsiSimpananLain;

use App\Model\Simpanan\SimpananBerjangka;
use App\Model\Simpanan\OpsiSimpananBerjangka;


use App\Model\Anggota;
use App\Model\Anggota_Gaji;

use App\Model\Operator;

class Ang_SimpananCtrl extends Controller
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

    function __invoke(){
        return view('anggota.simpanan.aju_simpanan');
    }

/*
============================
| pengajuan simpanan umum
============================
*/
    function aju_simpanan_umum(){
        return view('anggota.simpanan.aju_simpanan_umum');
    }

    function aju_simpanan_umum_act(Request $request){
        $s_opsi =OpsiSimpanan::where('id',1)->first();

        $no_rek='88'.rand(10000,9999);
        $date=date('Y-m-d');

        $request->validate([
            'sukarela' =>   'required'
        ]);

        $total_simpanan = $request->sukarela - ($s_opsi->simpanan_pokok + $s_opsi->biaya_buku);
        Simpanan::create([
            'no_rekening' =>$no_rek,
            'anggota_id' => Session::get('ang_id'),
            'total_simpanan' => $total_simpanan,
            'simpanan_opsi_id' => 1,
            'jlh_pokok' => $s_opsi->simpanan_pokok,
            'jlh_wajib' => $s_opsi->simpanan_wajib,
            'tgl_buka_rek' => $date,
            'status' => 0
        ]);

        return redirect('/anggota/aju-simpanan')->with('alert-success','Permohonan Di lanjutkan ke Pengurus');

    }

/*
============================
|  pengajuan simpanan Deposit
============================
*/    
    function aju_simpanan_deposit(){
        return view('anggota.simpanan.aju_simpanan_berjangka');
    }

    function aju_deposit_act(Request $request){
        $no_rek='86'.rand(1000,9999);
        $request->validate([
            'nominal' => 'required'
        ]);
        $date=date('Y-m-d');
        $nilai_depo=OpsiSimpananBerjangka::where('id', $request->nominal)->first();
        SimpananBerjangka::create([
           'opsi_deposit_id' =>$request->nominal,
           'anggota_id' => $request->ang_id,
           'rekening_deposit' => $no_rek,
           'nilai_deposit' => $nilai_depo->nominal_deposit,
           'jangka_deposit' => $nilai_depo->periode_deposit,
           'tgl_deposit' => $date,
           'status' =>0
        ]);

        return redirect('/anggota/aju-simpanan')->with('alert-success','Permohonan Di lanjutkan ke Pengurus');

    }

/*
============================
|  pengajuan simpanan Umroh
============================
*/    
    function aju_simpanan_umroh(){
        return view('anggota.simpanan.aju_simpanan_umroh');
    }
/*
============================
|  pengajuan simpanan Pendidikan
============================
*/    
    function aju_simpanan_pendidikan(){
        return view('anggota.simpanan.aju_simpanan_pendidikan');
    }



}
