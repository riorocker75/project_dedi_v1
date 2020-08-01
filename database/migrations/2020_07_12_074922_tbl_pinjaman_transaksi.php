<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblPinjamanTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tbl_pinjaman_transaksi')) {
            Schema::create('tbl_pinjaman_transaksi', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->text('pinjaman_kode');
                $table->text('anggota_id');
                $table->dateTime('tgl_transaksi');
                $table->text('nominal_bayar');
                $table->text('kembalian_bayar');
                $table->text('sisa_bayar');
                $table->text('ket_bayar');
                $table->text('metode')->nullable()->comment('1=bayar langsung,2=Transfer');
                $table->text('status')->nullable();
               
            });   
        };
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_pinjaman_transaksi');
    }
}
