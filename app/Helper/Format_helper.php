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

function cek_status_simpanan($status){
    switch($status){
        case 0:
            echo '<label class="badge badge-danger">Non aktif</label>';
        break;
        case 1:
            echo '<label class="badge badge-success">Aktif</label>';
        break;
        case 3:
            echo '<label class="badge badge-danger">Tutup Rekening</label>';
        break;
        default:
            echo "tidak ada";
         break;
    }
}

function jenis_sukarela($kode){
    switch($kode){
        case 1:
            echo "Simpanan Sukarela";
        break;
        case 2:
            echo"Simpanan Wajib";
        break;
        default:
        echo "Simpanan Lainya";
    break;
    }
}

function status_kas($status){
    switch($status){
        case 1:
            echo "<label class='badge badge-success'>Aktif</label>";
        break;
        case 0: 
            echo "<label class='badge badge-danger'> Non Aktif</label>";
        break;
        default:
    break;
    }
}

function preview_file($nama_file){ /*ini menggunakanan paramerter $nama_file*/
    $url_sh=substr($nama_file,0,-4);
    $url_klik= url('upload/syarat/'.$nama_file);
    // ini link dari route
    $url_pdf=url('review/syarat/'.$url_sh);
    
    $link_image="window.open('".$url_klik."','popup','width=600,height=600,scrollbars=no,resizable=no'); return false;";
    $link_pdf="window.open('".$url_pdf."','popup','width=600,height=600,scrollbars=no,resizable=no'); return false;";

    $file_path = pathinfo(storage_path().'/upload/syarat/'.$nama_file);
    switch(strtolower($file_path['extension'])){
        case"jpg":case"png":case"jpeg":
            echo '
            <a href="" onclick="'.$link_image.'">';
            echo "<img src='$url_klik' style='width:100px; height:100px'><br/>";
            echo "Klik Untuk Lebih Detail";
            echo "</a>";
        break;
        case"pdf":
            echo '
            <a href="" onclick="'.$link_pdf.'">';
            
            echo "<i class='fas fa-file-pdf' style='font-size:100px;color:#D81F28'></i><br/>";
            echo "Klik Untuk Lebih Detail<br>";
            echo "Matikan IDM atau sejenisnya";

            echo "</a>";
        break;	
        default:
        echo "File tidak ditemukan";
        break;	

    }
}

// end preview syarat

// start perview bukti

function preview_bukti($nama_file){ /*ini menggunakanan paramerter $nama_file*/
    $url_sh=substr($nama_file,0,-4);
    $url_klik= url('upload/bukti_bayar/'.$nama_file);
    // ini link dari route
    $url_pdf=url('review/bukti/'.$url_sh);
    
    $link_image="window.open('".$url_klik."','popup','width=600,height=600,scrollbars=no,resizable=no'); return false;";
    $link_pdf="window.open('".$url_pdf."','popup','width=600,height=600,scrollbars=no,resizable=no'); return false;";

    $file_path = pathinfo(storage_path().'/upload/bukti_bayar/'.$nama_file);
    switch(strtolower($file_path['extension'])){
        case"jpg":case"png":case"jpeg":
            echo '
            <a href="" onclick="'.$link_image.'">';
            echo "<img src='$url_klik' style='width:100px; height:100px'><br/>";
            echo "Klik Untuk Lebih Detail";
            echo "</a>";
        break;
        case"pdf":
            echo '
            <a href="" onclick="'.$link_pdf.'">';
            
            echo "<i class='fas fa-file-pdf' style='font-size:100px;color:#D81F28'></i><br/>";
            echo "Klik Untuk Lebih Detail<br>";
            echo "Matikan IDM atau sejenisnya";

            echo "</a>";
        break;	
        default:
        echo "File tidak ditemukan";
        break;	

    }
}
// end perview bukti


function status_transfer($status){
    switch($status){
        case 0:
            echo "<label class='badge badge-warning'>Menunggu persetujuan</label>";
        break;
        case 1:
            echo "<label class='badge badge-success'>Transfer diterima</label>";
        break;
        case 2:
            echo "<label class='badge badge-danger'>Transfer ditolak</label>";
        break;
        default:
        echo"tidak ada";
    break;
    }
}

// pengecekan link bukti bayar di admin
    function link_bukti_bayar($jenis,$rek){
        $url_umum = url('admin/pembayaran/simpanan-umum/detail/'.$rek);
        $url_umroh = url('admin/pembayaran/simpanan-umroh/detail/'.$rek);
        $url_pendidikan = url('/admin/pembayaran/simpanan-pendidikan/detail/'.$rek);
        $url_pinjaman = url('/admin/pembayaran/pinjaman/detail/'.$rek);

        if($jenis == "TRFU"){
            echo "
            <a href='$url_umum' style='padding:0 7px'> 
                <i class='fa fa-eye'></i>
            </a>
            ";
        }elseif($jenis == "TRFH"){
            echo "
            <a href='$url_umroh' style='padding:0 7px'> 
                <i class='fa fa-eye'></i>
            </a>
            ";
        }elseif($jenis == "TRFD"){
            echo "
            <a href='$url_pendidikan' style='padding:0 7px'> 
                <i class='fa fa-eye'></i>
             </a>   
            ";
        }elseif($jenis == "TRFP"){
            echo "
            <a href='$url_pinjaman' style='padding:0 7px'> 
                <i class='fa fa-eye'></i>
             </a> 
            ";
        }

    }
