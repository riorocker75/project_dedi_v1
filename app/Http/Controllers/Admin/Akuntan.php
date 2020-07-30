<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Model\User;
use App\Model\Admin;
use App\Model\Anggota;
use App\Model\Operator;
use App\Model\Laporan;
use App\Model\Kas;


use App\Model\Notif;
class Akuntan extends Controller
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

    function laman_akuntan(){
        $data_kas = Kas::orderBy('id','asc')->get();
        return view('admin.keuangan.v_detail_akuntan',[
            'data_kas' =>$data_kas
        ]);

    }

    function kas_tambah(Request $request){
        $request->validate([
            'nama' => 'required',
            'saldo' => 'required'
        ]);
        DB::table('tbl_kas')->insert([
            'nama' => $request->nama,
            'saldo' => $request->saldo,
            'status' => 1
        ]);
        return redirect()->back()->with('alert-success','Data telah disimpan');

    }

    function kas_update(Request $request){
        $request->validate([
            'nama' => 'required',
            'saldo' => 'required'
        ]);
        DB::table('tbl_kas')->where('id',$request->id_kas)->update([
            'nama' => $request->nama,
            'saldo' => $request->saldo,
            'status' => $request->status,
        ]);
        return redirect()->back()->with('alert-success','Data telah diupdate');

    }

    function kas_delete($id){
        Kas::where('id',$id)->delete();
        return redirect()->back()->with('alert-danger','Data telah dihapus');

    }



}
