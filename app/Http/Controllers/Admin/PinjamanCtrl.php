<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Str;


use Illuminate\Support\Facades\Hash;

use App\Model\User;
use App\Model\Admin;
use App\Model\Pinjaman;
use App\Model\Cat_Pinjaman;
use App\Model\Cat_Simpanan;
use App\Model\Tabungan;
use App\Model\Simpanan;

use App\Model\Anggota;
use App\Model\Operator;
use App\Model\Notif;
use App\Model\BuktiBayar;
use App\Model\Syarat;


class PinjamanCtrl extends Controller
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


    function permohonan_pinjam(){
        $data_mohon=Pinjaman::where('pinjaman_status','1')->get() ;
        return view('admin.permohonan_pinjam',[
            'mohon' => $data_mohon
        ]);
    }

    function cek_mohon($id){
        $data=Pinjaman::where('id',$id)->get();
        $pribadi =Pinjaman::where('id',$id)->first();
        $anggota= Anggota::where('anggota_id', $pribadi->anggota_id)->get();
        return view('admin.cek_mohon_pinjam',[
            'data' =>$data,
            'pribadi' => $anggota
        ]);
    }

    function review_pinjaman_act(Request $request, $id){

        $request->validate([
            'ket' => 'required|min:10'
        ]);
        switch ($request->input('action')) {
            case 'terima':
                Pinjaman::where('id',$id)->update([
                    'pinjaman_ket' =>$request->ket,
                    'pinjaman_status' => 3
                ]);
            return redirect('/admin/permohonan-pinjam')->with('alert-success','Pinjaman di setujui');

                break;
            case 'tolak':
                Pinjaman::where('id',$id)->update([
                    'pinjaman_ket' =>$request->ket,
                    'pinjaman_status' => 4
                ]);
            return redirect('/admin/permohonan-pinjam')->with('alert-warning','Penolakan Di infokan ke Anggota');

                break;
             default:
             echo "terlarang";
            break;   


        }

    }
    


}
