<?php

namespace App\Model\Simpanan;

use Illuminate\Database\Eloquent\Model;

class TransaksiSimpananLain extends Model
{
    protected $table= "tbl_simpanan_lain_transaksi";
    public $timestamps =false;
    protected $fillable=[
        'kode_transaksi',
        'no_rekening',
        'anggota_id',
        'nominal_transaksi',
        'tgl_transaksi',
        'sisa_angsuran',

    ];
}
