<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblBuktiBayar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tbl_bukti_bayar')){ 
           Schema::create('tbl_bukti_bayar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('anggota_id');
            $table->text('kode_transaksi')->nullable();
            $table->text('no_rekening')->nullable();
            $table->text('nominal')->nullable();

            $table->text('jenis_upload')->nullable();

            $table->date('tgl_upload');
            $table->date('tgl_diterima')->nullable();

            $table->text('isi');
            $table->text('ket_upload')->nullable();
            $table->text('status')->comment('0=masih di up, 1=telah disetujui, 2=ditolak karena buriq');
           });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('tbl_bukti_bayar');
    }
}
