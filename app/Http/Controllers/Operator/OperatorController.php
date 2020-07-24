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
use App\Model\Cat_Pinjaman;
use App\Model\Simpanan;
use App\Model\Notif;

use App\Model\BuktiBayar;
use App\Model\Syarat;
use App\Model\Option;
class OperatorController extends Controller
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

  	 function __invoke(){
    	return view('operator.operator');
    }

    // data pribadi
    function data_pribadi($id){
        $data=Operator::where('operator_id' ,$id)->get();
        return view('operator.data_pribadi', ['pribadi' => $data]);
    }

  
    function data_pribadi_update(Request $request,$id){
        $request->validate([
            'nama' => 'required|max:30',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'kontak' => 'required',
            'username' => 'required|unique:tbl_operator,operator_username,'.$id.',operator_id'
  
        ]);

        if($request->password != ""){
            Operator::where('operator_id', $id)->update([
                'operator_password' => bcrypt($request->password)
            ]);
        }
        Operator::where('operator_id',$id)->update([
            'operator_username' => $request->username,
            'operator_nama' => $request->nama,
            'operator_tanggal_lahir' => $request->tanggal_lahir,
            'operator_tempat_lahir' => $request->tempat_lahir,
            'operator_kontak' =>$request->kontak
        ]);
      
        return redirect('operator/data-pribadi/'.$id.'')->with('alert-success','Data telah diperbaharui');
    }
    
    function data_peminjam(){
        $data_aju= Pinjaman::where('pinjaman_status','0')->get();
        return view('operator.data_peminjam',[
            'data_aju' => $data_aju
        ]);
    }

    function review_peminjam($id){
       $data=Pinjaman::where('id', $id)->get();
       $pribadi =Pinjaman::where('id',$id)->first();
       $anggota= Anggota::where('anggota_id', $pribadi->anggota_id)->get();
        return view('operator.review_pinjaman',[
            'data' =>$data,
            'pribadi' => $anggota
        ]);
    }

    function review_pinjaman_act(Request $request, $id){
        $date=date('Y-m-d');
        $request->validate([
            'ket' => 'required|min:10'
        ]);
        switch ($request->input('action')) {
            case 'terima':
                Pinjaman::where('id',$id)->update([
                    'pinjaman_tgl' => $date,
                    'pinjaman_ket' =>$request->ket,
                    'pinjaman_status' => 1,
                    'status_bayar' => 1
                ]);
            return redirect('/operator/data-pinjaman')->with('alert-success','Pinjaman berhasil disetujui');

                break;
            case 'tolak':
                Pinjaman::where('id',$id)->update([
                    'pinjaman_ket' =>$request->ket,
                    'pinjaman_status' => 2
                ]);
            return redirect('/operator/data-pinjaman')->with('alert-warning','Penolakan Di infokan ke Anggota');

                break;
             default:
             echo "terlarang";
            break;   


        }

    }







}
