<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Model\Admin;
use App\Model\User;
use App\Model\Anggota;
use App\Model\Operator;
use App\Model\Pinjaman;
use App\Model\Cat_Pinjaman;
use App\Model\Simpanan;

class AnggotaGabung extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(!Session::get('login-op')){
                return redirect('login/admin')->with('alert-danger','Dilarang Masuk Terlarang');
            }
            return $next($request);
        });
        
    }

    
   function __invoke(){
       $data=Anggota::where('status',0)->orderBy('anggota_id','DESC')->get();
        return view('operator.data_gabung_anggota',[
            'data_mohon' =>$data
        ]);
   }

   function detail_pemohon($id){
    $data=Anggota::where('anggota_id',$id)->get();
    return view('operator.data_gabung_detail',[
        'anggota' =>$data
    ]);
   }

   function gabung_act(Request $request,$id){
       $request->validate([
           'status_pinjam' => 'required'
       ]);

       switch ($request->input('action')) {
        case 'terima':
            Anggota::where('anggota_id',$id)->update([
                'status_pinjaman' =>$request->status_pinjam,
                'status_simpanan' => 0,
                'status_deposit' => 0,
                'status_umroh' => 0,
                'status_pendidikan' => 0,
                'tgl_gabung' => date('Y-m-d'),
                'status' => 1
            ]);
        return redirect('/operator/mohon-gabung/')->with('alert-success','Anggota telah disetujui');

            break;
        case 'tolak':
            Anggota::where('anggota_id',$id)->update([
                'status_pinjaman' =>$request->status_pinjam,
                'status_simpanan' => 0,
                'status_deposit' => 0,
                'status_umroh' => 0,
                'status_pendidikan' => 0,
                'status' => 2
            ]);
        return redirect('/operator/mohon-gabung/')->with('alert-warning','Penolakan berhasil');

            break;
         default:
         echo "terlarang";
        break;   


    }
    // end switch
   }




}
