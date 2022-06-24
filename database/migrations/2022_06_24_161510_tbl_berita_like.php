<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblBeritaLike extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_berita_like',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('id_users')->unsigned();
            $table->unsignedBigInteger('id_berita')->unsigned();
            $table->foreign("id_users")->references("id")->on('tbl_users')->onDelete('cascade');
            $table->foreign("id_berita")->references("id")->on('tbl_berita')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_berita_like');
    }
}
