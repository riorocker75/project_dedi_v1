<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table="tbl_pinjaman";
    public $timestamps = false;
    protected $fillable =[
        'anggota_id',
        'pinjaman_kode',
        'pinjaman_aju',
        'pinjaman_tgl',
        'pinjaman_nama',
        'pinjaman_jumlah',
        'pinjaman_skema_angsuran',
        'pinjaman_bunga',
        'pinjaman_angsuran_lama',
        'ket_usaha',
        'alamat_usaha',
        'kategori_id',
        'pinjaman_status',
        'status_bayar'
    ];

    
}
