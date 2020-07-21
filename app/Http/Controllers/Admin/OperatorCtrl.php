<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Model\Admin;
use App\Model\User;
use App\Model\operator;

use App\Model\Notif;

class OperatorCtrl extends Controller
{
    //
	public function __construct()
	{
		$this->middleware(function ($request, $next) {
			if(!Session::get('login-adm')){
				return redirect('login/admin')->with('alert-danger','Dilarang Masuk Terlarang');
			}
			return $next($request);
		});

	}


	public function operator(){
		$operator = DB::table('tbl_operator')->get();
		return view('admin/v_operator',['operator' => $operator]);
	}

	public function operator_tambah(){
		return view('admin/v_operator_tambah');
	}

	public function operator_act(Request $request){
		DB::table('tbl_operator')->insert([
			'operator_kode' =>$request->kode_pagawai,
			'operator_nomor_pegawai' =>$request->nomor_pegawai,
			'operator_nama' =>$request->nama,
			'operator_kelamin' =>$request->kelamin,
			'operator_tempat_lahir' =>$request->tempat_lahir,
			'operator_tanggal_lahir' =>$request->tanggal_lahir,
			'operator_alamat' =>$request->alamat,
			'operator_kontak' =>$request->kontak,
			'operator_username' =>$request->username,
			'operator_password' =>Hash::make($request->password)
		]);


		return redirect('dashboard/admin/operator');
	}

	public function operator_hapus($id){
		DB::table('tbl_operator')->where('operator_id',$id)->delete();
		return redirect('dashboard/admin/operator');
	}

	public function operator_edit($id){
		$operator = DB::table('tbl_operator')->where('operator_id',$id)->get();
		return view('admin/v_operator_edit', compact('operator'));
	}

	public function operator_update(Request $request, $id){
		DB::table('tbl_operator')->where('operator_id',$id)-update([
			'operator_kode'=>$request->kode_pagawai,
			'operator_nomor_pegawai'=>$request->nomor_pegawai,
			'operator_nama'=>$request->nama

		]);
		return redirect('dashboard/admin/operator');
	}

	// public function operator_update(Request $request){

		// DB::table('operator')->where('operator_id',$request->id)->update([
		// 	'operator_kode' => $request->kode_pagawai,
		// 	'operator_nomor_pegawai' => $request->nomor_pegawai,
		// 	'operator_kelamin' => $request->kelamin,
		// 	'operator_tempat_lahir' => $request->tempat_lahir,
		// 	'operator_tanggal_lahir' => $request->tanggal_lahir,
		// 	'operator_alamat' => $request->alamat,
		// 	'operator_kontak' => $request->kontak,
		// 	'operator_username' => $request->username
		// ]);
		  // if(!empty($request->password)) {
		  // 	DB::table('tbl_operator')->where('operator_id',$request->id)->update([
		  // 		'operator_kode' => $request->kode_pagawai,
		  // 		'operator_nomor_pegawai' => $request->nomor_pegawai,
		  // 		'operator_kelamin' => $request->kelamin,
		  // 		'operator_tempat_lahir' => $request->tempat_lahir,
		  // 		'operator_tanggal_lahir' => $request->tanggal_lahir,
		  // 		'operator_alamat' => $request->alamat,
		  // 		'operator_kontak' => $request->kontak,
		  // 		'operator_username' => $request->username
		  // 	]);

		  // }else{
		  // 	DB::table('tbl_operator')->where('operator_id',$request->id)->update([
		  // 		'operator_kode' => $request->kode_pagawai,
		  // 		'operator_nomor_pegawai' => $request->nomor_pegawai,
		  // 		'operator_kelamin' => $request->kelamin,
		  // 		'operator_tempat_lahir' => $request->tempat_lahir,
		  // 		'operator_tanggal_lahir' => $request->tanggal_lahir,
		  // 		'operator_alamat' => $request->alamat,
		  // 		'operator_kontak' => $request->kontak,
		  // 		'operator_username' => $request->username,
		  // 		'operator_password' => Hash::make($request->password)
		  // 	]);
		  // }
		  // return redirect('dashboard/admin/operator');	
	// }

}
