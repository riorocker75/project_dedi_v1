<?php

namespace App\Model\Simpanan;

use Illuminate\Database\Eloquent\Model;

class OpsiSimpananBerjangka extends Model
{
    protected $table ="tbl_opsi_simpanan_berjangka";
    public $timestamps =false;
    protected $fillable=[
        'nominal_deposit',
        'bunga_deposit',
        'nisbah_bulan',
        'periode_deposit',
    ];
}
