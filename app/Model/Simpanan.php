<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
     protected $table= "tbl_simpanan";
    public $timestamps = false;
    protected $fillable =[
        'anggota_id',
        'no_rekening',
        'simpanan_opsi_id',
        'jlh_pokok',
        'jlh_wajib',
        'total_simpanan',
        'tgl_buka_rek',
        'status'
    ];
}
