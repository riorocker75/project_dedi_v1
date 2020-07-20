<?php

namespace App\Model\Simpanan;

use Illuminate\Database\Eloquent\Model;

class SimpananPendidikan extends Model
{
    protected $table ="tbl_simpanan_pendidikan";
    public $timestamps = false;
         protected $fillable =[
             'anggota_id',
             'no_rekening',
             'opsi_simpanan_lain_id',
             'jangka_pend',
             'angsuran_pend',
             'total',
             'tgl_mulai',
             'status_aju',
             'status'
         ];
}
