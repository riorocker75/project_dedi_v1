<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblKas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       if (!Schema::hasTable('tbl_kas')) {
           Schema::create('tbl_kas', function (Blueprint $table) {
               $table->bigIncrements('id');
               $table->text('saldo')->nullable();
               $table->text('nama');
               $table->dateTime('tgl')->nullable();
               $table->text('status')->nullable()->comment('1=aktif,0=non aktif');
              
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
        Schema::dropIfExists('tbl_kas');
    }
}
