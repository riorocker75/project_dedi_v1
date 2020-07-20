<?php

namespace App\Model\Simpanan;

use Illuminate\Database\Eloquent\Model;

class SimpananUmroh extends Model
{
    protected $table ="tbl_simpanan_umroh";
    public $timestamps = false;
         protected $fillable =[
             'anggota_id',
             'no_rekening',
             'opsi_simpanan_lain_id',
             'jangka_umroh',
             'angsuran_umroh',
             'total',
             'tgl_mulai',
             'status_aju',
             'status'
         ];
}
