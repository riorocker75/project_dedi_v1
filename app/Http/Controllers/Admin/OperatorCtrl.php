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
use App\Model\Operator;

use App\Model\Notif;

class OperatorCtrl extends Controller
{
    //
	public function __construct()
	{
		$this->middleware(function ($request, $next) {
			if(!Session::get('login-adm')){
				return redirect('login/user')->with('alert-danger','Dilarang Masuk Terlarang');
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
		$this->validate($request, [
            'nama' => 'required|min:4',
            'username' => 'required|min:4|unique:tbl_operator,operator_username',
            'password' => 'required|min:4'
        ]);
		$kode_op ="OP-". rand(1000,9999);
		DB::table('tbl_operator')->insert([
			'operator_kode' =>$kode_op,
			'operator_nomor_pegawai' =>$request->nomor_pegawai,
			'operator_nama' =>$request->nama,
			'operator_kelamin' =>$request->kelamin,
			'operator_tempat_lahir' =>$request->tempat_lahir,
			'operator_tanggal_lahir' =>$request->tanggal_lahir,
			'operator_alamat' =>$request->alamat,
			'operator_kontak' =>$request->kontak,
			'operator_username' =>$request->username,
			'operator_password' => bcrypt($request->password),
			'jabatan' =>$request->jabatan,
		]);
		
		
		// DB::table('tbl_user')->insert([
		// 	'nama' => $request->nama,
		// 	'username' => $request->username, 
		// 	'password' =>  bcrypt($request->password),
		// 	'kode_user' => $kode_op,
		// 	'level' => 2,
		// 	'status' => 1
		// ]);


		return redirect('dashboard/admin/operator')->with('alert-success','Data telah ditambahkan');
	}

	public function operator_hapus($id){
		$kode= Operator::where('operator_id', $id)->first();
		DB::table('tbl_operator')->where('operator_id',$id)->delete();
		DB::table('tbl_user')->where('kode_user',$kode->operator_kode)->delete();
		return redirect('dashboard/admin/operator');
	}

	public function operator_edit($id){
		$operator = DB::table('tbl_operator')->where('operator_id',$id)->get();
		return view('admin/v_operator_edit', compact('operator'));
	}

	public function operator_update(Request $request, $id){
		$op = Operator::where('operator_id',$id)->first();
		$this->validate($request, [
            'nama' => 'required|min:4',
            'username' => 'required|max:16|unique:tbl_operator,operator_username,'.$op->operator_username.',operator_username'
           
        ]);
		DB::table('tbl_operator')->where('operator_id',$id)->update([
			'operator_nomor_pegawai' =>$request->nomor_pegawai,
			'operator_nama' =>$request->nama,
			'operator_kelamin' =>$request->kelamin,
			'operator_tempat_lahir' =>$request->tempat_lahir,
			'operator_tanggal_lahir' =>$request->tanggal_lahir,
			'operator_alamat' =>$request->alamat,
			'operator_kontak' =>$request->kontak,
			'operator_username' =>$request->username,
			'jabatan' =>$request->jabatan
		]);

		DB::table('tbl_user')->where('kode_user', $op->operator_kode)->update([
			'nama' =>$request->nama,
			'username' =>$request->username
		]);	
		
		if(!empty($request->password)){
			$this->validate($request, [
				'password' => 'min:4'
			   
			]);
			DB::table('tbl_operator')->where('operator_id', $id)->update([
				'operator_password' => bcrypt($request->password)
			]);

			DB::table('tbl_user')->where('kode_user', $op->operator_kode)->update([
				'password' => bcrypt($request->password)
			]);
		}
		
		return redirect('dashboard/admin/operator')->with('alert-success','Data telah diperbaharui');
	}

	

}
