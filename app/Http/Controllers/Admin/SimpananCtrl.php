<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Model\Admin;
use App\Model\User;
use App\Model\Simpanan;
use App\Model\Simpanan\OpsiSimpanan;
use App\Model\Simpanan\OpsiSimpananLain;

use App\Model\Simpanan\SimpananBerjangka;
use App\Model\Simpanan\OpsiSimpananBerjangka;

use App\Model\BuktiBayar;
use App\Model\Syarat;

use App\Model\Notif;



class SimpananCtrl extends Controller
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

    public function __invoke(){
    	return view('admin.simpanan.v_atur_simpanan');

    }


/*
=================================
| bagian pengaturan simpanan umum
==================================
*/
    function atur_umum(){
    	return view('admin.simpanan.opsi_simpanan_umum');
    }

    function atur_umum_update(Request $request){
    	$request->validate([
    		'pokok' => 'required',
    		'wajib' => 'required',
    		'sukarela' => 'required'
    	]);

    	OpsiSimpanan::where('id', 1)->update([
    		'simpanan_pokok' => $request->pokok,
    		'simpanan_wajib' => $request->wajib,
    		'biaya_buku' => $request->buku,
    		'biaya_admin' => $request->admin,
    		'sukarela_min' => $request->sukarela,
    		'bunga' => $request->bunga
    	]);

    	return redirect('/admin/pengaturan/simpanan-umum')->with('alert-success','Data telah diperbaharui');

    }

// end pengaturan simpanan umum

/*
=================================
| bagian pengaturan simpanan deposit
==================================
*/

 function atur_deposit(){
    $data= OpsiSimpananBerjangka::orderBy('id','desc')->get();

    	return view('admin.simpanan.opsi_simpanan_deposit',[
            'data' =>$data
        ]);
    }

    function atur_deposit_act(Request $request){
        $request->validate([
            'nominal' => 'required',
            'periode' =>'required',
            'bunga' =>'required'
        ]);
        $bunga = $request->bunga / 100;

        $nominal_bunga =$request->nominal * $bunga ;
        $nisbah =round($nominal_bunga / $request->periode); 

        OpsiSimpananBerjangka::create([
            'nominal_deposit' => $request->nominal,
            'periode_deposit' =>$request->periode,
            'bunga_deposit' => $request->bunga,
            'nisbah_bulan' =>$nisbah
        ]);

            return redirect('/admin/pengaturan/simpanan-deposit')->with('alert-success','Data telah disimpan');
    }

    function atur_deposit_edit($id){
        $data= OpsiSimpananBerjangka::orderBy('id','desc')->get();
        $data_awal= OpsiSimpananBerjangka::where('id',$id)->get();
    	return view('admin.simpanan.opsi_simpanan_deposit_edit',[
            'data' =>$data,
            'data_awal' =>$data_awal
        ]);
    }

    function atur_deposit_update(Request $request,$id){
        $request->validate([
            'nominal' => 'required',
            'periode' =>'required',
            'bunga' =>'required'
        ]);
        $bunga = $request->bunga / 100;

        $nominal_bunga =$request->nominal * $bunga ;
        $nisbah =round($nominal_bunga / $request->periode); 

        OpsiSimpananBerjangka::where('id',$id)->update([
            'nominal_deposit' => $request->nominal,
            'periode_deposit' =>$request->periode,
            'bunga_deposit' => $request->bunga,
            'nisbah_bulan' =>$nisbah
        ]);

            return redirect()->back()->with('alert-success','Data telah disimpan');
    }

    function atur_deposit_hapus($id){
        OpsiSimpananBerjangka::where('id',$id)->delete();
        return redirect('/admin/pengaturan/simpanan-deposit')->with('alert-danger','Data telah dihapus');

    }


// end pengaturan simpanan deposit


/*
=================================
| bagian pengaturan simpanan umroh
==================================
*/
 function atur_umroh(){
    $data= OpsiSimpananLain::where('kode_simpanan','SUH')->orderBy('id','asc')->get();

    return view('admin.simpanan.opsi_simpanan_umroh',[
        'data' =>$data
    ]);
        
    }
    function atur_umroh_act(Request $request){
        $request->validate([
            'jenis' => 'required',
            'nominal' =>'required',
            'periode' => 'required'
        ]);
        $thn=$request->periode * 12;
        $total = $request->nominal * $thn;
        OpsiSimpananLain::create([
            'jenis_simpanan' =>$request->jenis,
            'kode_simpanan' => "SUH",
            'jangka_simpanan' => $request->periode,
            'angsuran_simpanan' => $request->nominal,
            'total_simpanan' =>$total
        ]);
        return redirect()->back()->with('alert-success','Data telah ditambah');

    }

    function atur_umroh_edit($id){
        $data= OpsiSimpananLain::where('kode_simpanan','SUH')->orderBy('id','asc')->get();
        $data_awal= OpsiSimpananLain::where('id',$id)->get();
    	return view('admin.simpanan.opsi_simpanan_umroh_edit',[
            'data' =>$data,
            'data_awal' =>$data_awal
        ]);
    }

    function atur_umroh_update(Request $request,$id){
        $request->validate([
            'jenis' => 'required',
            'nominal' =>'required',
            'periode' => 'required'
        ]);
        $thn=$request->periode * 12;
        $total = $request->nominal * $thn;
        OpsiSimpananLain::where('id',$id)->update([
            'jenis_simpanan' =>$request->jenis,
            'kode_simpanan' => "SUH",
            'jangka_simpanan' => $request->periode,
            'angsuran_simpanan' => $request->nominal,
            'total_simpanan' =>$total         
        ]);
        return redirect()->back()->with('alert-success','Data telah diupdate');

    }

    function atur_umroh_hapus($id){
        OpsiSimpananLain::where('id',$id)->delete();
        return redirect('/admin/pengaturan/simpanan-umroh')->with('alert-danger','Data telah dihapus');

    }


// end pengaturan simpanan umroh


/*
=================================
| bagian pengaturan simpanan pendidikan
==================================
*/
function atur_pendidikan(){
    $data= OpsiSimpananLain::where('kode_simpanan','SPN')->orderBy('id','asc')->get();

    return view('admin.simpanan.opsi_simpanan_pendidikan',[
        'data' =>$data
    ]);
  
    
}
function atur_pendidikan_act(Request $request){
    $request->validate([
        'jenis' => 'required',
        'nominal' =>'required',
        'periode' => 'required',
        'bunga' =>'required'
    ]);

    $thn=$request->periode * 12;
    $bunga =$request->bunga / 100;   
    $b_tahun= $request->nominal *12;
    $hsl_b_tahun= $b_tahun * $bunga;

    $tot_bunga_tahun =$b_tahun +  $hsl_b_tahun;
    $total_simpanan =$tot_bunga_tahun * $request->periode;    

    DB::table('tbl_opsi_simpanan_lain')->insert([
        'jenis_simpanan' =>$request->jenis,
        'kode_simpanan' => "SPN",
        'jangka_simpanan' => $request->periode,
        'angsuran_simpanan' => $request->nominal,
        'bunga' => $request->bunga,
        'total_simpanan' => $total_simpanan
    ]);
    return redirect()->back()->with('alert-success','Data telah ditambah');


}

function atur_pendidikan_edit($id){
    $data= OpsiSimpananLain::where('kode_simpanan','SPN')->orderBy('id','asc')->get();
    $data_awal= OpsiSimpananLain::where('id',$id)->get();
    return view('admin.simpanan.opsi_simpanan_pendidikan_edit',[
        'data' =>$data,
        'data_awal' =>$data_awal
    ]);
}

function atur_pendidikan_update(Request $request, $id){
    $request->validate([
        'jenis' => 'required',
        'nominal' =>'required',
        'periode' => 'required',
        'bunga' =>'required'
    ]);

    $thn=$request->periode * 12;
    $bunga =$request->bunga / 100;   
    $b_tahun= $request->nominal *12;
    $hsl_b_tahun= $b_tahun * $bunga;

    $tot_bunga_tahun =$b_tahun +  $hsl_b_tahun;
    $total_simpanan =$tot_bunga_tahun * $request->periode;    

    DB::table('tbl_opsi_simpanan_lain')->where('id',$id)->update([
        'jenis_simpanan' =>$request->jenis,
        'kode_simpanan' => "SPN",
        'jangka_simpanan' => $request->periode,
        'angsuran_simpanan' => $request->nominal,
        'bunga' => $request->bunga,
        'total_simpanan' => $total_simpanan
    ]);
    return redirect()->back()->with('alert-success','Data telah ditambah');

}

function atur_pendidikan_hapus($id){
    OpsiSimpananLain::where('id',$id)->delete();
    return redirect('/admin/pengaturan/simpanan-pendidikan')->with('alert-danger','Data telah dihapus');
}
 // end pengaturan simpanan pendidikan









}
