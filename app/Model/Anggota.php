<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
     protected $table= "tbl_anggota";
     public $timestamps = false;
        protected $fillable =[
        'anggota_kode',
        'anggota_nik',
        'anggota_nama',
        'anggota_kelamin',
        'anggota_tanggal_lahir',
        'anggota_tempat_lahir',
        'anggota_alamat_ktp',
        'anggota_alamat_sekarang',
        'anggota_kontak',
        'anggota_pekerjaan'

    ];
}
