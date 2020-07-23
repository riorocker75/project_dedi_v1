<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblSimpananBerjangka extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       if (!Schema::hasTable('tbl_simpanan_berjangka')) {
           Schema::create('tbl_simpanan_berjangka', function (Blueprint $table) {
               $table->bigIncrements('id');
               $table->text('opsi_deposit_id');
               $table->text('anggota_id');
               $table->text('rekening_deposit');
               $table->text('nilai_deposit');
               $table->text('jangka_deposit');
               $table->dateTime('tgl_deposit');
               $table->text('total_nisbah')->nullable();

               $table->dateTime('tgl_tarik')->nullable(); 
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
        Schema::dropIfExists('tbl_simpanan_berjangka');
    }
}
