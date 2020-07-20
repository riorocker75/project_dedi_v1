<?php

namespace App\Model\Simpanan;

use Illuminate\Database\Eloquent\Model;

class OpsiSimpananLain extends Model
{
    protected $table="tbl_opsi_simpanan_lain";
    public $timestamps =false;
    protected $fillable=[
        'jenis_simpanan',
        'kode_simpanan',
        'jangka_simpanan',
        'angsuran_simpanan',
        'total_simpanan'
    ];
}
