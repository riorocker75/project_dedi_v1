<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table= "tbl_laporan";
    public $timestamps = false;
       protected $fillable =[
        'pendapatan_kotor',
        'pendapatan_bersih',
        'kode_laporan',
        'tgl',
        'ket',
        'status' 

   ];
}
