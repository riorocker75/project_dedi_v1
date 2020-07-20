<?php

namespace App\Model\Simpanan;

use Illuminate\Database\Eloquent\Model;

class SimpananBerjangka extends Model
{
   protected $table ="tbl_simpanan_berjangka";
   public $timestamps = false;
        protected $fillable =[
            'opsi_deposit_id',
            'anggota_id',
            'rekening_deposit',
            'nilai_deposit',
            'jangka_deposit',
            'tgl_deposit',
            'status'

        ];
}
