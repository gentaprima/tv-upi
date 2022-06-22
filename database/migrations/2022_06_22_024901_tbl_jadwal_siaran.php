<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblJadwalSiaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_jadwal_siaran',function(Blueprint $table){
            $table->id();
            $table->string('nama_siaran');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->string('hari');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_jadwal_siaran');
    }
}
