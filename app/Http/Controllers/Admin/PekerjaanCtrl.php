<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;

use App\Model\Admin;
use App\Model\Operator;
use App\Model\Anggota;
use App\Model\Pekerjaan;

use App\Model\User;
use App\Model\Notif;

class PekerjaanCtrl extends Controller
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

    function __invoke(){
        $data= Pekerjaan::all();
        return view('admin.data_pekerjaan', [
            'data_kerja' =>$data
        ]);
    }


    function tambah_act(Request $request){
        $request->validate([
            'kerja' => 'required'
        ]);

        Pekerjaan::create([
            'pekerjaan' => $request->kerja
        ]);

        return redirect('/admin/pekerjaan')->with('alert-success','Pekerjaan berhasil ditambahkan');

    }

    function tambah_delete($id){
        Pekerjaan::where('id', $id)->delete();
        return redirect('/admin/pekerjaan')->with('alert-success','Pekerjaan berhasil dihapus');

    }
}
