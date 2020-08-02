<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblNotif extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tbl_notif')) {
            Schema::create('tbl_notif', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->text('kode_user');
                $table->text('pesan');
                $table->text('ket');
                $table->dateTime('tgl');
                $table->text('level');
                $table->text('kode_transaksi')->nullable();
                $table->text('status_baca')->comment('0=belum dilihat, 1=dilihat');
                $table->text('status')->comment('0=belum aktif, 1=aktif');
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
      Schema::dropIfExists('tbl_notif');
    }
}
