<?php

namespace App\Model\Simpanan;

use Illuminate\Database\Eloquent\Model;

class OpsiSimpanan extends Model
{
    protected $table ="tbl_opsi_simpanan";
    public $timestamps =false;
    protected $fillable=[
        'simpanan_pokok',
        'simpanan_wajib',
    ];
}
