<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PinjamanTransaksi extends Model
{
   protected $table="tbl_pinjaman_transaksi";
   public $timestamps = false;
   protected $fillable =[
       'pinjaman_kode',
       'anggota_id',
       'tgl_transaksi',
       'nominal_bayar',
       'kembalian_bayar',
       'sisa_bayar',
       'ket_bayar'
   ];
}
