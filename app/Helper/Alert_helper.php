<?php

    function show_alert(){

        if(Session::has('alert-success')){
            $alert = Session::get('alert-success');
            echo '<div class="snackbar-top snackbar-success">';
            echo '<div>'.$alert.'</div>';
            echo '</div>';
        }elseif(Session::has('alert-warning')){
            $alert = Session::get('alert-warning');
            echo '<div class="snackbar-top snackbar-warning">';
            echo '<div>'.$alert.'</div>';
            echo '</div>';
        }elseif(Session::has('alert-danger')){
            $alert = Session::get('alert-danger');
            echo '<div class="snackbar-top snackbar-danger">';
            echo '<div>'.$alert.'</div>';
            echo '</div>';
        }elseif(Session::has('alert-primary')){
            $alert = Session::get('alert-primary');
            echo '<div class="snackbar-top snackbar-primary">';
            echo '<div>'.$alert.'</div>';
            echo '</div>';
        }

        if(Session::has('full-alert')){
            $alert = Session::get('full-alert');
            echo '<div class="snackbar snackbar-dark">';
            echo '<div>'.$alert.'</div>';
            echo '</div>';
        }
        
    }

// function tes_alert(){
//     return "ini pesan dari alret";
// }

// cek login status

    function status_user($nama){
        switch ($nama) {
            case 1:
               echo "Admin";
                break;
            case 2:
               echo "Pengurus";
                break;
            case 3:
               echo "Anggota";
                break;
            default:
               echo "tidak ada";
                break;
        }
    }

     function status_anggota($status){
        switch ($status) {
            case 0:
               echo "Belum Aktif";
                break;
            case 1:
               echo "Operator Setuju";
                break;
            case 2:
               echo "Operator Menolak";
                break;
            default:
               echo "tidak ada";
                break;
        }
    }

    function layak_pinjam($status){
        switch($status){
            case 0:
                echo "Tahap Review";
            break;
            case 1:
                echo "Layak Pembiayaan";
            break;
            case 2:
                echo "Tidak Layak Pembiayaan";
            break;
            default:
            echo "Tidak ada status";
            break;
        }
    }

    function status_pinjaman($status){
        switch($status){
            case 0:
                echo "Menunggu Persetujuan";
                 break;
             case 1:
                echo "Operator Telah Setuju";
                 break;
             case 2:
                echo "Operator Menolak";
                 break;
             default:
                echo "tidak ada";
                 break;
        }
    }

   