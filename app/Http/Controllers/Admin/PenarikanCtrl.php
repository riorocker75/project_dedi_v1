<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Hash;

use App\Model\Admin;
use App\Model\Cat_Pinjaman;
use App\Model\Tabungan;

use App\Model\Anggota;
use App\Model\Anggota_Gaji;

use App\Model\Operator;


use App\Model\Simpanan;
use App\Model\Simpanan\OpsiSimpanan;
use App\Model\SimpananTransaksi;

use App\Model\Pinjaman;
use App\Model\PinjamanTransaksi;

use App\Model\Simpanan\SimpananBerjangka;
use App\Model\Simpanan\OpsiSimpananBerjangka;

use App\Model\Simpanan\OpsiSimpananLain;
use App\Model\Simpanan\SimpananUmroh;
use App\Model\Simpanan\SimpananPendidikan;


use App\Model\Notif;

use App\Model\User;
use App\Model\BuktiBayar;
use App\Model\Syarat;
use App\Model\TarikDana;



class PenarikanCtrl extends Controller
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
        $data=TarikDana::where('status', 0)->orderBy('tgl_aju','desc')->get();
        return view('admin.penarikan.v_data_penarikan',[
            'data' => $data
        ]);
    }
/*
--------------------------------
|   Penarikan simpanan umum
----------------------------------
*/

    function penarikan_umum_act(Request $request){
        $nominal=$request->nominal;
        $nominal_format=number_format($request->nominal);

        switch ($request->input('action')) {
            case 'terima':
              DB::table('tbl_tarik_dana')->where('id',$request->tarik_id)->update([
                  'tgl_cair' => date('Y-m-d H:i:s'),
                  'status' => 1
              ]);
              DB::table('tbl_notif')->insert([
                'kode_user' =>$request->ang_kode,
                'pesan' => "Penarikan Berhasil",
                'ket' => "Pernarikan Dana Rp. $nominal_format Berhasil",
                'tgl' => date('Y-m-d H:i:s'),
                'kode_transaksi' => $request->trs_kode,
                'level' => 3,
                'status_baca' => 0,
                'status' => 1
              ]);
            return redirect()->back()->with('alert-success','Penarikan Berhasil');
                break;
            case 'tolak':
                DB::table('tbl_tarik_dana')->where('id',$request->tarik_id)->update([
                    'ket' => "Tertolak ".$request->ket,
                    'status' => 2
                ]);

                DB::table('tbl_notif')->insert([
                    'kode_user' =>$request->ang_kode,
                    'pesan' => "Penarikan Ditolak",
                    'ket' => "Pernarikan Dana Rp. $nominal_format Ditolak",
                    'tgl' => date('Y-m-d H:i:s'),
                    'kode_transaksi' => $request->trs_kode,
                    'level' => 3,
                    'status_baca' => 0,
                    'status' => 1
                  ]);
            return redirect()->back()->with('alert-warning','Penarikan Ditolak');
        
                break;
             default:
             echo "terlarang";
            break;   
            }    
    }
    function penarikan_umum_delete($id){
        DB::table('tbl_tarik_dana')->where('id',$id)->delete();
        return redirect()->back()->with('alert-danger','data telah dihapus');
    }

/*
--------------------------------
|   Penarikan simpanan deposit
----------------------------------
*/

    function penarikan_deposit_act(Request $request){
        $nominal=$request->nominal;
        $nominal_format=number_format($request->nominal);

        switch ($request->input('action')) {
            case 'terima':
              DB::table('tbl_tarik_dana')->where('id',$request->tarik_id)->update([
                  'tgl_cair' => date('Y-m-d H:i:s'),
                  'status' => 1
              ]);
              DB::table('tbl_notif')->insert([
                'kode_user' =>$request->ang_kode,
                'pesan' => "Penarikan Berhasil",
                'ket' => "Pernarikan Dana Rp. $nominal_format Berhasil",
                'tgl' => date('Y-m-d H:i:s'),
                'kode_transaksi' => $request->trs_kode,
                'level' => 3,
                'status_baca' => 0,
                'status' => 1
              ]);
            return redirect()->back()->with('alert-success','Penarikan Berhasil');
                break;
            case 'tolak':
                DB::table('tbl_tarik_dana')->where('id',$request->tarik_id)->update([
                    'ket' => "Tertolak ".$request->ket,
                    'status' => 2
                ]);

                DB::table('tbl_notif')->insert([
                    'kode_user' =>$request->ang_kode,
                    'pesan' => "Penarikan Ditolak",
                    'ket' => "Pernarikan Dana Rp. $nominal_format Ditolak",
                    'tgl' => date('Y-m-d H:i:s'),
                    'kode_transaksi' => $request->trs_kode,
                    'level' => 3,
                    'status_baca' => 0,
                    'status' => 1
                  ]);
            return redirect()->back()->with('alert-warning','Penarikan Ditolak');
        
                break;
             default:
             echo "terlarang";
            break;   
            } 
    }
    function penarikan_deposit_delete($id){
        DB::table('tbl_tarik_dana')->where('id',$id)->delete();
        return redirect()->back()->with('alert-danger','data telah dihapus');
    }


/*
--------------------------------
|   Penarikan simpanan umroh
----------------------------------
*/
    function penarikan_umroh_act(Request $request){
        $nominal=$request->nominal;
        $nominal_format=number_format($request->nominal);

        switch ($request->input('action')) {
            case 'terima':
              DB::table('tbl_tarik_dana')->where('id',$request->tarik_id)->update([
                  'tgl_cair' => date('Y-m-d H:i:s'),
                  'status' => 1
              ]);
              DB::table('tbl_notif')->insert([
                'kode_user' =>$request->ang_kode,
                'pesan' => "Penarikan Berhasil",
                'ket' => "Pernarikan Dana Rp. $nominal_format Berhasil",
                'tgl' => date('Y-m-d H:i:s'),
                'kode_transaksi' => $request->trs_kode,
                'level' => 3,
                'status_baca' => 0,
                'status' => 1
              ]);
            return redirect()->back()->with('alert-success','Penarikan Berhasil');
                break;
            case 'tolak':
                DB::table('tbl_tarik_dana')->where('id',$request->tarik_id)->update([
                    'ket' => "Tertolak ".$request->ket,
                    'status' => 2
                ]);

                DB::table('tbl_notif')->insert([
                    'kode_user' =>$request->ang_kode,
                    'pesan' => "Penarikan Ditolak",
                    'ket' => "Pernarikan Dana Rp. $nominal_format Ditolak",
                    'tgl' => date('Y-m-d H:i:s'),
                    'kode_transaksi' => $request->trs_kode,
                    'level' => 3,
                    'status_baca' => 0,
                    'status' => 1
                  ]);
            return redirect()->back()->with('alert-warning','Penarikan Ditolak');
        
                break;
             default:
             echo "terlarang";
            break;   
            } 
    }
    function penarikan_umroh_delete($id){
        DB::table('tbl_tarik_dana')->where('id',$id)->delete();
        return redirect()->back()->with('alert-danger','data telah dihapus');
    }



/*
--------------------------------
|   Penarikan simpanan pendidikan
----------------------------------
*/

    function penarikan_pendidikan_act(Request $request){
        $nominal=$request->nominal;
        $nominal_format=number_format($request->nominal);

        switch ($request->input('action')) {
            case 'terima':
              DB::table('tbl_tarik_dana')->where('id',$request->tarik_id)->update([
                  'tgl_cair' => date('Y-m-d H:i:s'),
                  'status' => 1
              ]);
              DB::table('tbl_notif')->insert([
                'kode_user' =>$request->ang_kode,
                'pesan' => "Penarikan Berhasil",
                'ket' => "Pernarikan Dana Rp. $nominal_format Berhasil",
                'tgl' => date('Y-m-d H:i:s'),
                'kode_transaksi' => $request->trs_kode,
                'level' => 3,
                'status_baca' => 0,
                'status' => 1
              ]);
            return redirect()->back()->with('alert-success','Penarikan Berhasil');
                break;
            case 'tolak':
                DB::table('tbl_tarik_dana')->where('id',$request->tarik_id)->update([
                    'ket' => "Tertolak ".$request->ket,
                    'status' => 2
                ]);

                DB::table('tbl_notif')->insert([
                    'kode_user' =>$request->ang_kode,
                    'pesan' => "Penarikan Ditolak",
                    'ket' => "Pernarikan Dana Rp. $nominal_format Ditolak",
                    'tgl' => date('Y-m-d H:i:s'),
                    'kode_transaksi' => $request->trs_kode,
                    'level' => 3,
                    'status_baca' => 0,
                    'status' => 1
                  ]);
            return redirect()->back()->with('alert-warning','Penarikan Ditolak');
        
                break;
             default:
             echo "terlarang";
            break;   
            } 
    }
    function penarikan_pendidikan_delete($id){
        DB::table('tbl_tarik_dana')->where('id',$id)->delete();
        return redirect()->back()->with('alert-danger','data telah dihapus');
    }




}
