<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Syarat extends Model
{
    protected $table = "tbl_syarat";
    public $timestamps = false;
        protected $fillable =[
        'anggota_id',
        'tgl_upload',
        'isi',
        'status'
    ];
}
