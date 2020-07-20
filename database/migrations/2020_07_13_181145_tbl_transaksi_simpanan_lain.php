<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblTransaksiSimpananLain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tbl_simpanan_lain_transaksi')) {
            Schema::create('tbl_simpanan_lain_transaksi', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->text('kode_transaksi');
                $table->text('kode_simpanan');
                $table->text('no_rekening');
                $table->text('anggota_id');
                $table->text('nominal_transaksi');
                $table->text('kembalian_transaksi')->nullable();
                $table->dateTime('tgl_transaksi');
                $table->text('sisa_angsuran');
                $table->text('status')->nullable();

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
        Schema::dropIfExists('tbl_simpanan_lain_transaksi');
    }
}
