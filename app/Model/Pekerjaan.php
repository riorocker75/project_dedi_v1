<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
   protected $table ="tbl_pekerjaan";
   public $timestamps = false;
   protected $fillable =[
       'pekerjaan'
   ];
}
