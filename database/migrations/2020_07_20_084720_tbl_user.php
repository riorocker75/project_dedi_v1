<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    //   jangan lupa tambahin di situ if table
    if (!Schema::hasTable('tbl_user')) {
           Schema::create('tbl_user', function (Blueprint $table) {
               $table->bigIncrements('id');
               $table->text('nama');
               $table->text('username');
               $table->text('password');
               $table->text('kode_user');

               $table->text('level')->comment('1=admin,2=pengurus,3=anggota');
               $table->text('status')->comment('1=aktif, 0=non');


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
        Schema::dropIfExists('tbl_user');
    }
}
