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
use App\Model\Notif;
use App\Model\BuktiBayar;
use App\Model\Syarat;
class AdminLogin extends Controller
{
     function __invoke(){
        if(!Session::get('login-adm')){
            return view('login/index_user');
        }else{
            return redirect('/dashboard/admin');
        }
    }

    function loginCheck(Request $request){
    	$username = $request->username;
        $password = $request->password;
        $data = User::where('username',$username)->first();

        if($data){
            if($data->level == 1){
                    Session::flush();
                    
                    if(Hash::check($password,$data->password)){
                        Session::put('adm_id', $data->id);
                        Session::put('adm_nama', $data->nama);
                        Session::put('adm_username', $data->username);
                        Session::put('adm_kode', $data->kode_user);
                        Session::put('level', 1);
                        Session::put('login-adm',TRUE);
                        return redirect('/dashboard/admin')->with('alert-success','Selamat Datang Kembali Admin');
                    }else{
                        return redirect('/login/user')->with('alert-danger','Password atau Email, Salah !');
                    }
            

                // end cek data admin di buat
            }elseif($data->level == 2){
           
                 Session::flush();
                
                if(Hash::check($password,$data->password)){
                    Session::put('op_id', $data->id);
                    Session::put('op_nama', $data->nama);
                    Session::put('op_username', $data->username);
                    Session::put('op_kode', $data->kode_user);
                    Session::put('level', 2);
                    Session::put('login-op',TRUE);
                    return redirect('/dashboard/operator')->with('alert-success','Selamat Datang Kembali Pengurus');
                }else{
                    return redirect('/login/user')->with('alert-danger','Password atau Email, Salah !');
                }
         
            // end cek data ada atau tidak
            }elseif($data->level == 3){
                Session::flush();
                $data_ang=Anggota::where('anggota_username', $username)->first();

                    if($data_ang->status == "1"){
                        if(Hash::check($password,$data->password)){
                        Session::put('ang_id', $data_ang->anggota_id);
                        Session::put('ang_nama', $data_ang->anggota_nama);
                        Session::put('ang_username', $data_ang->anggota_username);
                        Session::put('ang_kontak', $data_ang->anggota_kontak);
                        Session::put('ang_nik', $data_ang->anggota_nik);
                        Session::put('ang_status', $data_ang->status);
                        Session::put('ang_kode', $data_ang->anggota_kode);

                        Session::put('level', 3);
                        Session::put('login-ang',TRUE);
                            return redirect('/dashboard/anggota')->with('alert-success','Selamat Datang Kembali Anggota');
                        }else{
                            return redirect('/login/user')->with('alert-danger','Password atau Email, Salah !');
                        }   

                    }elseif($data_ang->status == "2"){
                        return redirect('/login/user')->with('alert-danger','Akun Keanggotaan Kamu ditolak mohon ajukan ulang dengan data yang sesuai persyaratan!');
                    }else{
                         return redirect('/login/user')->with('alert-danger','Akun Keanggotaan Kamu belum di verifikasi mohon bersabar!');
                    } 

             // end cek level anggota
            }elseif($data->level == 4){
                Session::flush();
                
                if(Hash::check($password,$data->password)){
                    Session::put('mg_id', $data->id);
                    Session::put('mg_nama', $data->nama);
                    Session::put('mg_username', $data->username);
                    Session::put('mg_kode', $data->kode_user);
                    Session::put('level', 4);
                    Session::put('login-adm',TRUE);
                    return redirect('/dashboard/admin')->with('alert-success','Selamat Datang Kembali Manager');
                }else{
                    return redirect('/login/user')->with('alert-danger','Password atau Email, Salah !');
                }

            // end cek data manager di buat
        }else{
                return redirect('/login/user')->with('alert-danger','Tidak meliki akses kesini');
            }
                // end cek level 
    }else{
        return redirect('/login/user')->with('alert-danger','Password atau Email, Salah !');
    }
    // cek kebenaran input


    }

  public function logout(){
        Session::flush();
        return redirect('/login/user')->with('alert-success','Logout berhasil');
    }
}
