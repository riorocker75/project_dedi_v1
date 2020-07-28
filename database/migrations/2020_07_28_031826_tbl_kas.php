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
               $table->text('pendapatan');
               $table->dateTime('tgl')->nullable();
               $table->text('jenis')->nullable();
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
        Schema::dropIfExists('tbl_kas');
    }
}
