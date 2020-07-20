<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Anggota_Gaji extends Model
{
    protected $table = "tbl_gaji";
    public $timestamps = false;
        protected $fillable =[
        'anggota_id',
        'jumlah_gaji'
    ];
}
