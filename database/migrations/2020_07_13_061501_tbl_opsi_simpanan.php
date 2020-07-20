<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblOpsiSimpanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tbl_opsi_simpanan')) {
            Schema::create('tbl_opsi_simpanan', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->text('simpanan_pokok');
                $table->text('simpanan_wajib');
                $table->text('biaya_buku')->nullable();
                $table->text('biaya_admin')->nullable();
                $table->text('biaya_endapan')->nullable();
                $table->text('sukarela_min')->nullable();
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
       Schema::dropIfExists('tbl_opsi_simpanan');
    }
}
