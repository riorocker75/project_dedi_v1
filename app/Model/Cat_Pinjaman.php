<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cat_Pinjaman extends Model
{
     protected $table= "tbl_kategori_pinjaman";
     public $timestamps = false;
     protected $fillable =[
     	'kategori_jenis',
     	'kategori_besar_pinjaman',
     	'kategori_lama_pinjaman',
     	'kategori_besar_bunga'
      ];
}
