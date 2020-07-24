<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblSimpananUmroh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       if (!Schema::hasTable('tbl_simpanan_umroh')) {
            Schema::create('tbl_simpanan_umroh', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->text('anggota_id');
                $table->text('no_rekening');
                $table->text('opsi_simpanan_lain_id');
                $table->text('jangka_umroh');
                $table->text('angsuran_umroh');
                $table->text('total');
                $table->text('total_angsur')->nullable();
                $table->date('tgl_mulai');
                $table->date('tgl_tutup')->nullable();
                $table->text('ket')->nullable();
                $table->text('status_aju')->comment('0=masih tahap review,1=disetjui');
                $table->text('status')->comment('0=masih review,1=tahap angsuran, 2=lunas,3=tutup_tabungan');

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
        Schema::dropIfExists('tbl_simpanan_umroh');
    }
}
