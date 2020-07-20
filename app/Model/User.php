<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
      protected $table= "tbl_user";
    public $timestamps = false;
    protected $fillable =[
      'nama',
      'username',
      'password',
      'level',
      'kode_user',
      'status'
    ];
}
