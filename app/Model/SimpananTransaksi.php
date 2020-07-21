<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SimpananTransaksi extends Model
{
    protected $table="tbl_simpanan_transaksi";
    public $timestamps = false;
    protected $fillable =[
        'anggota_id',
        'no_rekening',
        'operator_id',
        'tgl_transaksi',
        'jenis_transaksi',
        'kode_simpanan',
        'kode_transaksi',
        'nominal_transaksi',
        'ket_transaksi',
        'status'
      
    ];
}
