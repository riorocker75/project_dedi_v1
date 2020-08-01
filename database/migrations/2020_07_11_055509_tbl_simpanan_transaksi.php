<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblSimpananTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tbl_simpanan_transaksi')){ 
            Schema::create('tbl_simpanan_transaksi', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->text('anggota_id');
                $table->text('no_rekening');
                $table->text('operator_id')->nullable();
                $table->text('kode_simpanan');
                $table->text('kode_transaksi');
                $table->text('sisa_angsuran')->nullable();
                $table->text('nominal_transaksi');
                $table->text('kembalian_transaksi')->nullable();
                $table->dateTime('tgl_transaksi');
                $table->text('jenis_transaksi')->nullable();
                $table->text('ket_transaksi');
                $table->text('metode')->nullable()->comment('1=bayar langsung,2=Transfer');
                $table->text('status')->comment('1=simpanan,2=penarikan');
                    
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
        Schema::dropIfExists('tbl_simpanan_transaksi');

    }
}
