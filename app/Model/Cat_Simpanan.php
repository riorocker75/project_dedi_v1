<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cat_Simpanan extends Model
{
     protected $table= "tbl_kategori_simpanan";
    public $timestamps = false;
     protected $fillable =[
     	'kategori_jenis',
     	'kategori_biaya_simpanan'
     	
      ];
}
