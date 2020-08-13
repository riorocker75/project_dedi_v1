<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    protected $table= "tbl_operator";
    protected $primaryKey= "operator_id";
    public $timestamps = false;
    protected $fillable =[
        'operator_kode',
        'operator_nomor_pegawai',
        'operator_nama',
        'operator_kelamin',
        'operator_tanggal_lahir',
        'operator_tempat_lahir',
        'operator_alamat',
        'operator_kontak',
        'jabatan'
    ];
}
