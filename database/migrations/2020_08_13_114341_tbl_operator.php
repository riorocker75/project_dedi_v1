<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblOperator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tbl_operator')) {
            Schema::create('tbl_operator', function (Blueprint $table) {
                $table->bigIncrements('operator_id');
                $table->text('operator_kode');
                $table->text('operator_nomor_pegawai');
                $table->text('operator_nama');
                $table->text('operator_kelamin');
                $table->text('operator_tempat_lahir');
                $table->date('operator_tanggal_lahir');
                $table->text('operator_alamat');
                $table->text('operator_kontak');
                $table->text('operator_username');
                $table->text('operator_password');
                $table->text('jabatan')->comment('1=manager,2=asisten-manager,3=pengurus,4=staf lapang');

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
        Schema::dropIfExists('tbl_operator');
    }
}
