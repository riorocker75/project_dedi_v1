<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblOpsiSimpananBerjangka extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       if (!Schema::hasTable('tbl_opsi_simpanan_berjangka')) {
           Schema::create('tbl_opsi_simpanan_berjangka', function (Blueprint $table) {
               $table->bigIncrements('id');
               $table->text('nominal_deposit');
               $table->text('bunga_deposit');
               $table->text('nisbah_bulan')->nullable();
               $table->text('periode_deposit');
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
        Schema::dropIfExists('tbl_opsi_simpanan_berjangka');

    }
}
