<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table ="tbl_option";
   public $timestamps = false;
   protected $fillable =[
       'option_name'
      
   ];
}
