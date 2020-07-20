<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Model\Admin;
use App\Model\Anggota;
use App\Model\Operator;

use App\Model\User;
class AdminLogin extends Controller
{
     function __invoke(){
        if(!Session::get('login-adm')){
            return view('login/index_admin');
        }else{
            return redirect('/dashboard/admin');
        }
    }

    function loginCheck(Request $request){
    	$username = $request->username;
        $password = $request->password;
        $data = Admin::where('admin_username',$username)->first();
            if($data){
                 Session::flush();
                
                if(Hash::check($password,$data->admin_password)){
                    Session::put('adm_id', $data->admin_id);

                    Session::put('adm_nama', $data->admin_nama);
                    Session::put('adm_username', $data->admin_username);
                    Session::put('adm_kontak', $data->admin_kontak);
                    Session::put('level', 1);
                    Session::put('login-adm',TRUE);
                    return redirect('/dashboard/admin')->with('alert-success','Selamat Datang Kembali');
                }else{
                    return redirect('/login/admin')->with('alert-danger','Password atau Email, Salah !');
                }
            }else{
                return redirect('/login/admin')->with('alert-danger','Password atau Email, Salah !');
            }
    }

  public function logout(){
        Session::flush();
        return redirect('/login/admin')->with('alert-success','Logout berhasil');
    }
}
