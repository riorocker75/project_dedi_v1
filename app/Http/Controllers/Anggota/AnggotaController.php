<?php

namespace App\Http\Controllers\Anggota;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;

use App\Model\Admin;
use App\Model\Pinjaman;
use App\Model\Cat_Pinjaman;
use App\Model\Cat_Simpanan;
use App\Model\Tabungan;
use App\Model\Simpanan;

use App\Model\Anggota;
use App\Model\Anggota_Gaji;

use App\Model\Operator;

use App\Model\Simpanan\OpsiSimpananBerjangka;
use App\Model\Simpanan\OpsiSimpananLain;

use App\Model\Notif;

use App\Model\User;
use App\Model\BuktiBayar;
use App\Model\Syarat;
class AnggotaController extends Controller
{
   public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(!Session::get('login-ang')){
                return redirect('login/user')->with('alert-danger','Dilarang Masuk Terlarang');
            }
            return $next($request);
        });
        
    }

    function __invoke(){
        return view('anggota.anggota');
        // $id=Session::get('ang_kode');
        // $data=Anggota::where('anggota_kode' ,$id)->get();
        // return view('anggota.data_pribadi', ['pribadi' => $data]);
    }

    // perubahan data pribadi
    function data_pribadi($id){
        $data=Anggota::where('anggota_kode' ,$id)->get();
        return view('anggota.data_pribadi', ['pribadi' => $data]);
    }

  
    function data_pribadi_update(Request $request,$id){
        $nik=Session::get('ang_nik');
        $request->validate([
            'nik' => 'required|max:16|unique:tbl_anggota,anggota_nik,'.$nik.',anggota_nik',
            'nama' => 'required|max:30',
            'tempat_lahir' => 'required',
            'kontak' => 'required',
            'pekerjaan' => 'required',
            'alamat_sekarang' => 'required',
            'alamat_ktp' => 'required',
            'gaji' => 'required'

        ]);

        Anggota::where('anggota_kode',$id)->update([
            'anggota_nik' => $request->nik,
            'anggota_nama' => $request->nama,
            'anggota_tanggal_lahir' => $request->tanggal_lahir,
            'anggota_tempat_lahir' => $request->tempat_lahir,
            'anggota_alamat_ktp' => $request->alamat_ktp,
            'anggota_alamat_sekarang' => $request->alamat_sekarang,
            'anggota_kontak' =>$request->kontak,
            'anggota_pekerjaan' =>$request->pekerjaan,
            'anggota_gaji' =>$request->gaji
        ]);
         
        User::where('kode_user',$id)->update([
			'nama' => $request->nama,
			// 'username' =>$username,
			'status' => 1
		   ]);
        return redirect('anggota/data-pribadi/'.$id.'')->with('alert-success','Data telah diperbaharui');
    }

    // mulai pinjam
    function data_pinjam($id){
        $data= Pinjaman::where('anggota_id', $id)->get();

        return view('anggota.data_pinjam',[
            'data_pinjam'=> $data
        ]);
    }

    function aju_pinjam(){
        $data_catpj=Cat_Pinjaman::all();
        
        return view('anggota.aju_pinjam' ,[
            'cat_pinjam' => $data_catpj,
           
        ]);
    }

    function aju_pinjam_act(Request $request){
        $request->validate([
            'ket_usaha' => 'required|min:10',
            'alamat_usaha' => 'required|min:10',
            'lama_angsur' => 'required'
        ]);
        $id= Session::get('ang_id');
        $angsur =$request->lama_angsur;
        $rand="PNJ-".rand('1000','9999');
        $jas=Cat_Pinjaman::where('kategori_id',$angsur)->first();
        
        $nominal =$jas->kategori_besar_pinjaman;
        // hitung logika skema

        $date=date('Y-m-d');
        // $this->validate($request,[
          
        //     'lama_angsur' => 'required'
        // ]);
        Pinjaman::create([
            'anggota_id' => Session::get('ang_id'),
            'kategori_id' => $angsur,
            'pinjaman_kode' =>$rand,
            'pinjaman_aju'=> $date,
            'pinjaman_tgl'=> $date,
            'pinjaman_jumlah'=> $nominal,
            'pinjaman_skema_angsuran' => $jas->kategori_angsuran,
            'pinjaman_bunga' => $jas->kategori_besar_bunga,
            'pinjaman_angsuran_lama' => $jas->kategori_lama_pinjaman,
            'ket_usaha' => $request->ket_usaha,
            'alamat_usaha' => $request->alamat_usaha,
            'pinjaman_status' => 0,
            'status_bayar' => 0
        ]);
        return redirect('anggota/data-pinjaman/'.$id.'')->with('alert-success','Pinjaman sudah dikirim, Mohon menuggu verifikasi !!');

    }

    function view_pinjaman($id){
        $data = Pinjaman::where('id',$id)->get();
        return view('anggota.view_pinjaman',[
            'data' =>$data
        ]);
    }


    




}
