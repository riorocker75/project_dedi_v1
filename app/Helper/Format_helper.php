<?php

function format_tanggal($tanggal){
    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}


function status_bayar_pinjaman($status){
    switch($status){
        case 0:
            echo "<label class='badge badge-primary'>Tahap Ajukan</label>";
        break;
        case 1:
            echo "<label class='badge badge-warning'>Masa Angsuran</label>";
        break;
        case 2:
            echo"<label class='badge badge-success'>Lunas</label>";
        break;
        default:
        echo "none ";
        break;
    }
}

function cek_status_anggota($status){
    switch($status){
        case 0:
        echo "<label class='badge badge-warning'>Sedang Tahap Review</label>";
        break;
        case 1:
        echo "<label class='badge badge-success'>Telah Aktif</label>";
        break;
        case 2:
        echo "<label class='badge badge-default'>Akun Ditolak</label>";
        break;
        default:
        echo "none ";
        break;
    }
}