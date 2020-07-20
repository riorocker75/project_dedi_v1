<?php

namespace App\Http\Controllers\Auth;

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


class OperatorLogin extends Controller
{
     function __invoke(){
        if(!Session::get('login-op')){
            return view('login/index_operator');
        }else{
            return redirect('/dashboard/operator');
        }
    }

    function loginCheck(Request $request){
    	$username = $request->username;
        $password = $request->password;
        $data = Operator::where('operator_username',$username)->first();
            if($data){
                 Session::flush();
                
                if(Hash::check($password,$data->operator_password)){
                    Session::put('op_id', $data->operator_id);
                    Session::put('op_nama', $data->operator_nama);
                    Session::put('op_username', $data->operator_username);
                    Session::put('op_nomor_pegawai', $data->operator_nomor_pegawai);
                    Session::put('level', 2);

                    Session::put('op_kontak', $data->operator_kontak);
                    Session::put('login-op',TRUE);
                    return redirect('/dashboard/operator')->with('alert-success','Selamat Datang Kembali');
                }else{
                    return redirect('/login/operator')->with('alert-danger','Password atau Email, Salah !');
                }
            }else{
                return redirect('/login/operator')->with('alert-danger','Password atau Email, Salah !');
            }
    }

  public function logout(){
        Session::flush();
        return redirect('/login/operator')->with('alert-success','Logout berhasil');
    }

}
