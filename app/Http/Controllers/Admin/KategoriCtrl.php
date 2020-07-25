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
use App\Model\Cat_Pinjaman;
use App\Model\Cat_Simpanan;

use App\Model\Notif;

class KategoriCtrl extends Controller
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


	public function kategori_simpanan(){
		$kategori = DB::table('tbl_kategori_simpanan')->get();
		return view('admin/v_kategori_simpanan',['kategori' => $kategori]);
	}


	public function kategori_simpanan_act(Request $request){
		DB::table('tbl_kategori_simpanan')->insert([
			'kategori_jenis' =>$request->jenis,
			'kategori_biaya_simpanan' =>$request->besar		
		]);
		return redirect('dashboard/admin/kategori_simpanan');
	}

	public function kategori_simpanan_hapus($id){
		DB::table('tbl_kategori_simpanan')->where('kategori_id',$id)->delete();
		return redirect('dashboard/admin/kategori_simpanan');
	}

	public function kategori_simpanan_update(Request $request){
		DB::table('tbl_kategori_simpanan')->where('kategori_id',$request->id)->update([
			'kategori_jenis' => $request->jenis,
			'kategori_biaya_simpanan' => $request->besar
		]);
		return redirect('dashboard/admin/kategori_simpanan');
	}

	public function kategori_pinjaman(){
		$kategori = DB::table('tbl_kategori_pinjaman')->get();
		return view('admin/v_kategori_pinjaman',['kategori' => $kategori]);
	}

	public function kategori_pinjaman_act(Request $request){
		DB::table('tbl_kategori_pinjaman')->insert([
			'kategori_jenis' =>$request->jenis,
			'kategori_besar_pinjaman' =>$request->besar,	
			'kategori_lama_pinjaman' =>$request->lama,
			'kategori_besar_bunga' =>$request->bunga,
			'kategori_angsuran' =>$request->angsuran,
			'biaya_wajib' =>$request->wajib,
			'persen_potong' =>$request->persen_wajib,
			'uang_potong' =>$request->uang_potong,
			'persen_sosial' => $request->persen_sosial,
			'persen_asuransi' => $request->persen_asuransi

		]);
		return redirect('dashboard/admin/kategori_pinjaman');
	}

	public function kategori_pinjaman_hapus($id){
		DB::table('tbl_kategori_pinjaman')->where('kategori_id',$id)->delete();
		return redirect('dashboard/admin/kategori_pinjaman');
	}	

	public function kategori_pinjaman_update(Request $request){
		DB::table('tbl_kategori_pinjaman')->where('kategori_id',$request->id)->update([
			'kategori_jenis' =>$request->jenis,
			'kategori_besar_pinjaman' =>$request->besar,	
			'kategori_lama_pinjaman' =>$request->lama,
			'kategori_besar_bunga' =>$request->bunga,
			'kategori_angsuran' =>$request->angsuran,
			'biaya_wajib' =>$request->wajib,
			'persen_potong' =>$request->persen_wajib,
			'uang_potong' =>$request->uang_potong,
			'persen_sosial' => $request->persen_sosial,
			'persen_asuransi' => $request->persen_asuransi

		]);
		return redirect('dashboard/admin/kategori_pinjaman');
	}
}
