<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblTarikDana extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tbl_tarik_dana')) {
            Schema::create('tbl_tarik_dana', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->text('kode_user');
                $table->text('kode_transaksi');
                $table->text('no_rekening');
                $table->text('nominal');
                $table->text('jenis');
                $table->dateTime('tgl_aju');
                $table->dateTime('tgl_cair')->nullable();
                $table->text('ket')->nullable();
                $table->text('info')->nullable();
                $table->text('status')->comment('0=review,1=diapprove');
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
        Schema::dropIfExists('tbl_tarik_dana');
    }
}
