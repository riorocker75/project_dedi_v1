<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Str;
use Response;
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
use App\Model\Simpanan\SimpananUmroh;
use App\Model\Simpanan\SimpananPendidikan;

use App\Model\SimpananTransaksi;
use App\Model\PinjamanTransaksi;

use App\Model\Pekerjaan;


use App\Model\Notif;

use App\Model\User;

class AjaxCtrl extends Controller
{
   
    
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



    function cek_umroh(Request $request){

        $nominal =$request->umroh;
        $review=OpsiSimpananLain::where('id',$nominal)->first();
        $nilai_simpan=number_format($review->nominal_deposit);
           
            $jangka=$review->jangka_simpanan;
           $angsuran=number_format($review->angsuran_simpanan);
            $total_simpan=number_format($review->total_simpanan);


        echo "
                <div class='form-group'>
                    <label>Lama Setoran Simpanan</label>
                    <input type='text' class='form-control' value='$jangka tahun' disabled>
                </div>

                <div class='form-group'>
                    <label>Periode</label>
                    <input type='text' class='form-control' value='Rp.$angsuran/bulan' disabled>
                </div> 

                <div class='form-group'>
                    <label>Total Simpanan $jangka tahun </label>
                    <input type='text' class='form-control' value='Rp. $total_simpan' disabled>
                </div> 
            
        ";

        echo "
                <script>
                $(document).ready(function () {
                    $('#tampil_umroh').css('display','block');
                });
                </script>
            ";

    }

    function cek_pendidikan(Request $request){

        $nominal =$request->pendidikan;
        $review=OpsiSimpananLain::where('id',$nominal)->first();
        $nilai_simpan=number_format($review->nominal_deposit);
           
        $jangka=$review->jangka_simpanan;
        $bunga=$review->bunga;
        $angsuran=number_format($review->angsuran_simpanan);
        $total_simpan=number_format($review->total_simpanan);


        echo "
                <div class='form-group'>
                    <label>Lama Setoran Simpanan</label>
                    <input type='text' class='form-control' value='$jangka tahun' disabled>
                </div>

                <div class='form-group'>
                    <label>Periode</label>
                    <input type='text' class='form-control' value='Rp.$angsuran/bulan' disabled>
                </div> 

                <div class='form-group'>
                    <label>Nisbah pertahun </label>
                    <input type='text' class='form-control' value='$bunga %' disabled>
                </div> 

                <div class='form-group'>
                    <label>Total Simpanan $jangka tahun + nisbah $bunga % pertahun</label>
                    <input type='text' class='form-control' value='Rp. $total_simpan' disabled>
                </div> 
            
        ";

        echo "
                <script>
                $(document).ready(function () {
                    $('#tampil_pendidikan').css('display','block');
                });
                </script>
            ";

    }

    // pengecekan data anggota
    function cek_anggota(Request $request){

        $id =$request->anggota;
        $rv=Anggota::where('anggota_id',$id)->first();
        $tgl_lahir=format_tanggal(date('Y-m-d', strtotime($rv->anggota_tanggal_lahir))); 
        
        $pk = Pekerjaan::where('id',$rv->anggota_pekerjaan)->first();
        echo "
                <div class='form-group'>
                    <label>Nama</label>
                    <input type='text' class='form-control' value='$rv->anggota_nama' disabled>
                </div>

                <div class='form-group'>
                    <label>NIK</label>
                    <input type='text' class='form-control' value='$rv->anggota_nik' disabled>
                </div> 

                <div class='form-group'>
                    <label>Tempat & Tanggal Lahir </label>
                    <input type='text' class='form-control' value='$rv->anggota_tempat_lahir , $tgl_lahir ' disabled>
                </div> 

                <div class='form-group'>
                    <label>Alamat KTP</label>
                    <input type='text' class='form-control' value='$rv->anggota_alamat_ktp ' disabled>
                </div> 

                <div class='form-group'>
                    <label>Kontak</label>
                    <input type='text' class='form-control' value='$rv->anggota_kontak ' disabled>
                 </div> 

                 <div class='form-group'>
                    <label>Pekerjaan</label>
                    <input type='text' class='form-control' value='$pk->pekerjaan' disabled>
                </div> 

 
            
        ";

        echo "
                <script>
                $(document).ready(function () {
                    $('#form_anggota').css('display','block');
                });
                </script>
            ";

    }


    // end pengecekan data anggota


    function viewfile_pdf($id){
        $file='upload/syarat/'.$id.'.pdf';
        header('Content-Type: application/pdf');
        return response()->file(
            public_path($file)
        );
     
       
    }

    function viewfile_bukti_pdf($id){
        $file='upload/bukti_bayar/'.$id.'.pdf';
        header('Content-Type: application/pdf');
        return response()->file(
            public_path($file)
        );
    }


}
