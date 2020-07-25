<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblSyarat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tbl_syarat')){ 
            Schema::create('tbl_syarat', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->text('anggota_id');
                $table->text('kode_syarat')->nullable();
                $table->text('isi');
                $table->text('bukti')->nullable();
             
                $table->date('tgl_upload');
                $table->date('tgl_diterima')->nullable();
                $table->text('ket_syarat')->nullable();
                $table->text('status')->comment('0=masih di up, 1=telah disetujui, 2=ditolak karena buriq');
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
        Schema::dropIfExists('tbl_syarat');
    }
}
