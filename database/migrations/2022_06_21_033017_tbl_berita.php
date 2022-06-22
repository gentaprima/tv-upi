<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblBerita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_berita',function(Blueprint $table){
            $table->id();
            $table->string('judul');
            $table->string('deskripsi');
            $table->date('tgl');
            $table->string('count_like');
            $table->string('created_by');
            $table->unsignedBigInteger("id_kategori")->unsigned();
            $table->integer('is_publish');
            $table->foreign("id_kategori")->references("id")->on('tbl_kategori_berita')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_berita');
    }
}
