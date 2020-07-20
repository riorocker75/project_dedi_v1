<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Entri_Anggota extends Model
{
     protected $table= "tbl_entri_anggota";
   	 public $timestamps = false;
     protected $fillable =[
     	'anggota_id',
     	'entri_tanggal_daftar',
     	'operator_id'
     ];
}
