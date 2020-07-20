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
use App\Model\User;

class OperatorLogin extends Controller
{

    // ok disini operator login logicnya sudah pindah ke AdminLogin
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
        $data = User::where('username',$username)->first();
        // $data = User::where([
        //     ['username', '=', $username],
        //     ['level', '=', '2'],
        // ])->first();
        if($data){
                if($data->level == 2){
                        Session::flush();
                        
                        if(Hash::check($password,$data->password)){
                            Session::put('op_id', $data->id);
                            Session::put('op_nama', $data->nama);
                            Session::put('op_username', $data->username);
                            Session::put('op_kode', $data->kode_user);
                            Session::put('level', 2);
                            Session::put('login-op',TRUE);
                            return redirect('/dashboard/operator')->with('alert-success','Selamat Datang Kembali');
                        }else{
                            return redirect('/login/admin')->with('alert-danger','Password atau Email, Salah !');
                        }
                
                    // end cek data ada atau tidak
                }else{
                    return redirect('/login/admin')->with('alert-danger','Tidak meliki akses kesini');
                }
                    // end cek level
        }else{
            return redirect('/login/admin')->with('alert-danger','Password atau Email, Salah !');
        }

    }

  public function logout(){
        Session::flush();
        return redirect('/login/admin')->with('alert-success','Logout berhasil');
    }

}
