<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblLaporan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tbl_laporan')) {
            Schema::create('tbl_laporan', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->text('nominal');
                $table->text('kode_laporan');
                $table->text('kas_id')->nullable();
                $table->text('jenis')->nullable();
                $table->dateTime('tgl');
                $table->text('ket');
                $table->text('status')->comment('1=pemasukan,2=pengeluaran');
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
        Schema::dropIfExists('tbl_laporan');
    }
}
