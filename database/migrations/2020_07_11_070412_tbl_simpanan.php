<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblSimpanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            if(!Schema::hasTable('tbl_simpanan')){ 
            Schema::create('tbl_simpanan', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->text('no_rekening');
                $table->text('anggota_id');
                $table->text('total_simpanan');
                $table->text('simpanan_opsi_id');
                $table->text('jlh_pokok');
                $table->text('jlh_wajib');
                $table->dateTime('tgl_buka_rek');
                $table->dateTime('tgl_tutup_rek')->nullable();
                $table->text('status');
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
        Schema::dropIfExists('tbl_simpanan');
    }
}
