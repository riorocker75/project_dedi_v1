<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table= "tbl_laporan";
    public $timestamps = false;
       protected $fillable =[
        'nominal',
        'kode_laporan',
        'tgl',
        'ket',
        'status' 

   ];
}
