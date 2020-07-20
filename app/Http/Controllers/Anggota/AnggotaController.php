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



use App\Model\User;
class AnggotaController extends Controller
{
   public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(!Session::get('login-ang')){
                return redirect('login/anggota')->with('alert-danger','Dilarang Masuk Terlarang');
            }
            return $next($request);
        });
        
    }

    function __invoke(){
        // return view('anggota.anggota');
        $id=Session::get('ang_id');
        $data=Anggota::where('anggota_id' ,$id)->get();
        return view('anggota.data_pribadi', ['pribadi' => $data]);
    }

    // perubahan data pribadi
    function data_pribadi($id){
        $data=Anggota::where('anggota_id' ,$id)->get();
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

        Anggota::where('anggota_id',$id)->update([
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








    function cek_angsuran(Request $request){
        $nominal = $request->nominal;
        $angsur =$request->angsur;
        $jas=Cat_Pinjaman::where('kategori_id',$angsur)->first();
        $bunga=$jas->kategori_besar_bunga/100;
        
        $cicilan=$nominal/$jas->kategori_lama_pinjaman;
        $per_bunga=($nominal*$bunga) /$jas->kategori_lama_pinjaman;

        $total_cicil=$cicilan+$per_bunga;

        if($nominal > $jas->kategori_besar_pinjaman){
            echo "Anda melewati limit, harap isi sesuai limit";
        }else{
            $hx=round($total_cicil,2);
            return "Rp.&nbsp;".number_format($hx)."/bulan";
        }
    }

    function cek_angsuran_fix(Request $request){
        $angsur =$request->angsur;
        $id_ag=Session::get('ang_id');
        $ag= Anggota::where('anggota_id',$id_ag)->first();
        $jas=Cat_Pinjaman::where('kategori_id',$angsur)->first();

        $bunga=$jas->kategori_besar_bunga/100;
        $pj_pokok=number_format($jas->kategori_besar_pinjaman);

        $jangka=$jas->kategori_lama_pinjaman;
        $angsur_minggu= number_format($jas->kategori_angsuran);
       
        $total_kembali=$jas->kategori_angsuran*$jas->kategori_lama_pinjaman;
        $num_tk=number_format($total_kembali);

        $total_angsur=$total_kembali - $jas->kategori_besar_pinjaman;
        $num_ang=number_format($total_angsur);

        $bulan_total=$jas->kategori_lama_pinjaman / 4.345;
        $total_bunga= round($bulan_total * $jas->kategori_besar_bunga);

        
        if($jas->kategori_besar_pinjaman > $ag->anggota_gaji){
            echo "Anda melewati limit, harap pilih sesuai dengan maks gaji";
            echo "
                <script>
                $(document).ready(function () {
                    $('#ajukan').css('display','none');
                });
                </script>
            ";
        }else{
            echo "
            <div class='form-group'>
                <label>Pinjaman Pokok</label>
                <input type='text' class='form-control' value='$pj_pokok' disabled>
            </div>

            <div class='form-group'>
                <label>Jangka Waktu</label>
                <input type='text' class='form-control' value='$jangka minggu' disabled>
            </div>

            <div class='form-group'>
                <label>Nisbah Koperasi</label>
                <input type='text' class='form-control' value='setara $jas->kategori_besar_bunga% perbulan atau $total_bunga% selama $jas->kategori_lama_pinjaman minggu' disabled>
            </div>

            <div class='form-group'>
                <label>Angsuran per Minggu</label>
                <input type='text' class='form-control' value='$angsur_minggu' disabled>
            </div>

            <div class='form-group'>
                <label>Total Angsuran</label>
                <input type='text' class='form-control' value='$num_ang' disabled>
             </div>
            <div class='form-group'>
                <label>Total Pengembalian</label>
                <input type='text' class='form-control' value='$num_tk' disabled>
            </div>
            ";

            echo "
                <script>
                $(document).ready(function () {
                    $('#ajukan').css('display','block');
                });
                </script>
            ";
        }
    }

    function cek_deposit(Request $request){

        $nominal =$request->deposit;
        $review=OpsiSimpananBerjangka::where('id',$nominal)->first();
            $nilai_depo=number_format($review->nominal_deposit);
            $bunga_depo=$review->bunga_deposit;
            
            $nisbah_depo=number_format($review->nisbah_bulan);
            $lama_depo=number_format($review->periode_deposit);


        echo "
                <div class='form-group'>
                    <label>Nilai Simpanan</label>
                    <input type='text' class='form-control' value='Rp.$nilai_depo' disabled>
                </div>

                <div class='form-group'>
                    <label>Periode</label>
                    <input type='text' class='form-control' value='$lama_depo bulan' disabled>
                </div> 

                <div class='form-group'>
                    <label>Bunga perbulan</label>
                    <input type='text' class='form-control' value='$bunga_depo %' disabled>
                </div> 
                <div class='form-group'>
                    <label>Bagi Hasil Perbulan</label>
                    <input type='text' class='form-control' value='Rp.$nisbah_depo' disabled>
                </div> 
        ";

        echo "
                <script>
                $(document).ready(function () {
                    $('#tampil_deposit').css('display','block');
                });
                </script>
            ";

    }


}
