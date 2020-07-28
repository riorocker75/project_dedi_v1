<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    protected $table= "tbl_laporan";
    public $timestamps = false;
       protected $fillable =[
      'pendapatan'

   ];
}
