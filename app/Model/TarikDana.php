<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TarikDana extends Model
{
    protected $table= "tbl_tarik_dana";
    public $timestamps = false;
       protected $fillable =[
      'kode_user',
      'kode_transaksi',
      'nominal',
      'jenis',
      'no_rekening',
      'tgl_aju',
      'status'

   ];
}
