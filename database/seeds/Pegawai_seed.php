<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class Pegawai_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_operator')->delete();
        DB::table('tbl_operator')->insert([
            'operator_kode' => "OP-443",
            'operator_nomor_pegawai' => "PG-456",
            'operator_nama' => "Dedi Lubis",
            'operator_kelamin' => "Laki - Laki",
            'operator_tempat_lahir' => "Panyabungan",
            'operator_tanggal_lahir' => "1994-05-16",
            'operator_alamat' => "Panyabungan",
            'operator_kontak' => "085622321",
            'operator_username' => "admin",
            'operator_password' => bcrypt("admin"),
            'jabatan' => "2"

        ]);

        DB::table('tbl_operator')->insert([
            'operator_kode' => "OP-473",
            'operator_nomor_pegawai' => "PG-356",
            'operator_nama' => "Muzanni",
            'operator_kelamin' => "Laki - Laki",
            'operator_tempat_lahir' => "Sidempuan",
            'operator_tanggal_lahir' => "1994-05-16",
            'operator_alamat' => "Sidempuan",
            'operator_kontak' => "085622321",
            'operator_username' => "manager",
            'operator_password' => bcrypt("manager"),
            'jabatan' => "1"

        ]);

        DB::table('tbl_operator')->insert([
            'operator_kode' => "OP-723",
            'operator_nomor_pegawai' => "PG-656",
            'operator_nama' => "Atika",
            'operator_kelamin' => "Perempuan",
            'operator_tempat_lahir' => "Panyabungan",
            'operator_tanggal_lahir' => "1994-05-16",
            'operator_alamat' => "Panyabungan",
            'operator_kontak' => "085622321",
            'operator_username' => "pengurus",
            'operator_password' => bcrypt("pengurus"),
            'jabatan' => "3"

        ]);

    }
}
