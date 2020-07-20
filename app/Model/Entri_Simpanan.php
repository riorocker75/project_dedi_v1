<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Entri_Simpanan extends Model
{
     protected $table= "tbl_entri_simpanan";
   	 public $timestamps = false;
     protected $fillable =[
     	'simpanan_id',
     	'operator_id',
     	'entri_tanggal_simpanan'
     ];
}
