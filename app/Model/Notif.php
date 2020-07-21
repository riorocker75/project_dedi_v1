<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notif extends Model
{
    protected $table= "tbl_notif";
    public $timestamps = false;
    protected $fillable =[
        'kode_user',
        'pesan',
        'ket',
        'tgl',
        'level',
        'status_baca',
        'status'
    ];
}
