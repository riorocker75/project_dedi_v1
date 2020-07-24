<?php

namespace App\Http\Controllers\Operator;

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
use App\Model\Simpanan\TransaksiSimpananLain;
use App\Model\PinjamanTransaksi;
use App\Model\SimpananTransaksi;
use App\Model\Notif;
use App\Model\BuktiBayar;
use App\Model\Syarat;

class PembayaranCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(!Session::get('login-op')){
                return redirect('login/user')->with('alert-danger','Dilarang Masuk Terlarang');
            }
            return $next($request);
        });
        
    }

    function bayar_pinjaman(){
        $data=Pinjaman::where('status_bayar',1)->orderBy('id','DESC')->get();
        return view('operator.pembayaran.data_bayar_pinjaman',[
           'data' => $data
        ]);
    }

    function detail_bayar_pinjaman($id){
        $data=Pinjaman::where('pinjaman_kode', $id)->get();
        $data_bayar=PinjamanTransaksi::where('pinjaman_kode',$id)->orderBy('id','DESC')->get();
        return view('operator.pembayaran.data_bayar_pinjaman_detail',[
            'data_bayar' => $data_bayar,
            'data' => $data
         ]);
    }

    function bayar_pinjaman_act(Request $request){
        $kode=$request->kode;
        $anggota =$request->anggota;
        $date=date('Y-m-d');
        $request->validate([
            'bayar' => 'required',
            'ket_bayar' => 'required',
            'kode' =>'required',
            'kembalian' =>'required'
        ]);
        $nominal_fix=$request->bayar - $request->kembalian;
        $sisa_bayar=$request->angsuran - $nominal_fix;
        
        // jika sudah lunas bayar
        if($sisa_bayar == 0){
            Pinjaman::where('pinjaman_kode', $kode)->update([
                'status_bayar' => 2
            ]);
        }

        PinjamanTransaksi::create([
            'pinjaman_kode' =>$kode,
            'anggota_id' =>$anggota,
            'tgl_transaksi' =>$date,
            'nominal_bayar' =>$request->bayar,
            'kembalian_bayar' =>$request->kembalian,
            'sisa_bayar' =>$sisa_bayar,
            'ket_bayar' => $request->ket_bayar
         ]);

        return redirect('operator/pembayaran/pinjaman/detail/'.$kode.'')->with('alert-success','Pembayaran berhasil');

    }

}
