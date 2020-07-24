<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BuktiBayar extends Model
{
    protected $table = "tbl_bukti_bayar";
    public $timestamps = false;
        protected $fillable =[
        'anggota_id',
        'tgl_upload',
        'isi',
        'status'
    ];
}
