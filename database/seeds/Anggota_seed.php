<?php

use Illuminate\Database\Seeder;
use App\Model\Anggota;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Anggota_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('tbl_anggota')->delete();
        Anggota::create([
            'anggota_id' => 1,
            'anggota_kode' => "AG-827",
            'anggota_username' => "anggota",
            'anggota_password' => bcrypt("anggota"),
            'anggota_nik' => 9900292828,
            'anggota_nama'=>"Dedi",
            'anggota_kelamin'=>"laki-laki",
            'anggota_agama'=>"Islam",
            'anggota_tempat_lahir'=>"Hagu Barat Laut",
            'anggota_tanggal_lahir' => "1986-06-30",
            'anggota_alamat_ktp' => "Hagu Barat Laut",
            'anggota_alamat_sekarang' => "Hagu Barat Laut",
            'anggota_kontak' => "082272242022",
            'anggota_pekerjaan' => "1",
            'anggota_gaji' => "50000000",
            'tgl_gabung' =>"2020-06-20",
            'status_pokok' =>1,
            'status_pinjaman' =>1,
            'status_simpanan' =>1,
            'status_deposit' =>0,
            'status_umroh' =>0,
            'status_pendidikan' =>0,
            'status' => 1,
            'foto' => "" 

        ]);
        Anggota::create([
            'anggota_id' => 3,
            'anggota_kode' => "AG-341",
            'anggota_username' => "sumail",
            'anggota_password' => bcrypt("sumail"),
            'anggota_nik' => 9900292567,
            'anggota_nama'=>"Sumail",
            'anggota_kelamin'=>"laki-laki",
            'anggota_agama'=>"Islam",
            'anggota_tempat_lahir'=>"Hagu Barat Laut",
            'anggota_tanggal_lahir' => "1996-06-30",
            'anggota_alamat_ktp' => "Hagu Barat Laut",
            'anggota_alamat_sekarang' => "Hagu Barat Laut",
            'anggota_kontak' => "082272242022",
            'anggota_pekerjaan' => "1",
            'anggota_gaji' => "7000000",
            'tgl_gabung' =>"2020-06-20",
            'status_pokok' =>0,
            'status_pinjaman' =>0,
            'status_simpanan' =>1,
            'status_deposit' =>0,
            'status_umroh' =>0,
            'status_pendidikan' =>0,
            'status' => 1,
            'foto' => "" 
        ]);

        Anggota::create([
            'anggota_id' => 4,
            'anggota_kode' => "AG-365",
            'anggota_username' => "lumion",
            'anggota_password' => bcrypt("lumion"),
            'anggota_nik' => 9900292567,
            'anggota_nama'=>"lumion",
            'anggota_kelamin'=>"laki-laki",
            'anggota_agama'=>"Islam",
            'anggota_tempat_lahir'=>"Hagu Barat Laut",
            'anggota_tanggal_lahir' => "1992-06-30",
            'anggota_alamat_ktp' => "Hagu Barat Laut",
            'anggota_alamat_sekarang' => "Hagu Barat Laut",
            'anggota_kontak' => "082272342022",
            'anggota_pekerjaan' => "1",
            'anggota_gaji' => "4000000",
            'tgl_gabung' =>"2020-06-20",
            'status_pokok' =>1,
            'status_pinjaman' =>0,
            'status_simpanan' =>0,
            'status_deposit' =>0,
            'status_umroh' =>0,
            'status_pendidikan' =>0,

            'status' =>0,
            'foto' => "" 
        ]);

    }
    
}
