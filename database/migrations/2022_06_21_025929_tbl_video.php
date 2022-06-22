<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblVideo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_video',function(Blueprint $table){
            $table->id();
            $table->string('judul');
            $table->string('link');
            $table->integer('is_active');
            $table->integer('count');
            $table->string('banner');
            $table->unsignedBigInteger('id_kategori')->unsigned();
            $table->foreign('id_kategori')->references('id')->on('tbl_kategori_video')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_video');
    }
}
