<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblOpsiSimpananLain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tbl_opsi_simpanan_lain')) {
            Schema::create('tbl_opsi_simpanan_lain', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->text('jenis_simpanan');
                $table->text('kode_simpanan');
                $table->text('jangka_simpanan');
                $table->text('angsuran_simpanan');
                $table->text('total_simpanan');
                $table->text('bunga')->nullable();
                
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
        Schema::dropIfExists('tbl_opsi_simpanan_lain');
    }
}
