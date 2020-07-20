<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;



class Admin extends Model
{
    protected $table= "tbl_admin";
    public $timestamps = false;
    protected $fillable =[
        'admin_kode',
        'admin_nama',
        'admin_kelamin',
        'admin_tanggal_lahir',
        'admin_tempat_lahir',
        'admin_alamat',
        'admin_kontak',
        'admin_foto'
       
    ];
}
