<?php

namespace App\Http\Controllers\Operator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use App\Model\Admin;
use App\Model\User;
use App\Model\Anggota;
use App\Model\Operator;
use App\Model\Pinjaman;
use App\Model\Cat_Pinjaman;
use App\Model\Simpanan;
use App\Model\SimpananTransaksi;
use App\Model\Simpanan\OpsiSimpanan;

use App\Model\Notif;
use App\Model\BuktiBayar;
use App\Model\Syarat;
class AnggotaGabung extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(!Session::get('login-op')){
                return redirect('login/user')->with('alert-danger','Dilarang Masuk Terlarang');
            }
            return $next($request);
        });
        
    }

    
   function __invoke(){
       $data=Anggota::where('status',0)->orderBy('anggota_id','DESC')->get();
        return view('operator.data_gabung_anggota',[
            'data_mohon' =>$data
        ]);
   }

   function detail_pemohon($id){
    $data=Anggota::where('anggota_id',$id)->get();
    return view('operator.data_gabung_detail',[
        'anggota' =>$data
    ]);
   }

   function gabung_act(Request $request,$id){
       $request->validate([
           'status_pinjam' => 'required'
       ]);

       switch ($request->input('action')) {
        case 'terima':
            Anggota::where('anggota_id',$id)->update([
                'status_pinjaman' =>$request->status_pinjam,
                'status_simpanan' => 0,
                'status_deposit' => 0,
                'status_umroh' => 0,
                'status_pendidikan' => 0,
                'tgl_gabung' => date('Y-m-d'),
                'status' => 1
            ]);
        return redirect('/operator/mohon-gabung/')->with('alert-success','Anggota telah disetujui');

            break;
        case 'tolak':
            Anggota::where('anggota_id',$id)->update([
                'status_pinjaman' =>$request->status_pinjam,
                'status_simpanan' => 0,
                'status_deposit' => 0,
                'status_umroh' => 0,
                'status_pendidikan' => 0,
                'status' => 2
            ]);
        return redirect('/operator/mohon-gabung/')->with('alert-warning','Penolakan berhasil');

            break;
         default:
         echo "terlarang";
        break;   


    }
    // end switch
   }

//    verifikasi lanjutan anggota 
   function verifikasi_lanjut(){
       $data = Syarat::where('status',0)->orderBy('id','ASC')->get();
        return view('operator.verifikasi.dt_verifikasi',[
            'data' =>$data
        ]);
   } 

   function verifikasi_lanjut_detail($id){
    $data = Syarat::where('id',$id)->get();
        return view('operator.verifikasi.dt_verifikasi_detail',[
            'data' =>$data
        ]);
    } 

    function verifikasi_lanjut_act(Request $request){
        $ket=$request->ket;
        $ang_id=$request->ang_id;
        $ang= Anggota::where('anggota_id',$ang_id)->first();
        $ops=OpsiSimpanan::where('id',1)->first();


        $no_rek='88'.rand(10000,99999);
        switch ($request->input('action')) {
            case 'terima':
                Syarat::where('id',$request->syarat_id)->update([
                    'ket_syarat' => "Persyaratan Lengkap",
                    'status' => 1
                ]);
               Anggota::where('anggota_id',$ang_id)->update([
                    'status_pinjaman' => 1,
                    'status_simpanan' => 1,
                    'status_pokok' => 1
               ]);

               Simpanan::create([
                   'no_rekening' => $no_rek,
                   'anggota_id' =>$ang_id,
                   'total_simpanan' => $ops->sukarela_min,
                   'simpanan_opsi_id' => 1,
                   'jlh_pokok' => $ops->simpanan_pokok,
                   'jlh_wajib' => $ops->simpanan_wajib,
                   'tgl_buka_rek' => date('Y-m-d'),
                   'status' => 1
               ]);
                $kode_trs="TRSU-".rand(1000,9999);
                $kode_trs_2="TRSU-".rand(10000,99999);
                $kode_trs_3="TRSU-".rand(100,999);

               DB::table('tbl_simpanan_transaksi')->insert([
                'anggota_id' =>$ang_id,
                'no_rekening' => $no_rek,
                'operator_id' => Session::get('op_kode'),
                'kode_simpanan' => "SSK",
                'kode_transaksi' =>$kode_trs,
                'nominal_transaksi' =>$ops->simpanan_pokok,
                'tgl_transaksi' => date('Y-m-d'),
                'jenis_transaksi' =>"Simpanan Pokok" ,
                'ket_transaksi' => "Pembayaran Simpanan Pokok Perdana",
                'status' => 1
               ]);

               DB::table('tbl_simpanan_transaksi')->insert([
                'anggota_id' =>$ang_id,
                'no_rekening' => $no_rek,
                'operator_id' => Session::get('op_kode'),
                'kode_simpanan' => "SSK",
                'kode_transaksi' =>$kode_trs_2,
                'nominal_transaksi' =>$ops->simpanan_wajib,
                'tgl_transaksi' => date('Y-m-d'),
                'jenis_transaksi' =>"Simpanan Wajib" ,
                'ket_transaksi' => "Pembayaran Simpanan Wajib Perdana",
                'status' => 1
               ]);

               DB::table('tbl_simpanan_transaksi')->insert([
                'anggota_id' =>$ang_id,
                'no_rekening' => $no_rek,
                'operator_id' => Session::get('op_kode'),
                'kode_simpanan' => "SSK",
                'kode_transaksi' =>$kode_trs_3,
                'nominal_transaksi' =>$ops->sukarela_min,
                'tgl_transaksi' => date('Y-m-d'),
                'jenis_transaksi' =>"Simpanan Sukarela" ,
                'ket_transaksi' => "Pembayaran Simpanan Sukarela Perdana",
                'status' => 1
               ]);

            return redirect('/operator/verifikasi/anggota')->with('alert-success','Anggota telah disetujui');
                // Anggota    
                break;
            case 'tolak':
                Syarat::where('id',$request->syarat_id)->update([
                    'ket_syarat' => $request->ket,
                    'status' => 2
                ]);
            return redirect('/operator/verifikasi/anggota')->with('alert-warning','Penolakan berhasil');
    
                break;
             default:
             echo "terlarang";
            break;   
    
    
        }
        // end switch
    } 

    function verifikasi_lanjut_hapus($id){
        $syarat=Syarat::where('id',$id)->first();
        File::delete('upload/syarat/'.$syarat->isi);
        File::delete('upload/syarat/'.$syarat->bukti);


        Syarat::where('id',$id)->delete();
        return redirect()->back()->with('alert-danger','Data Telah Terhapus');
    }



}
