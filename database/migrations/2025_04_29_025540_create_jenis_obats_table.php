<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisObatsTable extends Migration
{
    public function up()
    {
        Schema::create('jenis_obats', function (Blueprint $table) {
            $table->id();
            $table->string('jenis', 50);
            $table->string('deskripsi_jenis', 255)->nullable();
            $table->string('image_url', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jenis_obats');
    }
}
