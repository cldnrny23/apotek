<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeranjangsTable extends Migration
{
    public function up()
    {
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('id_obat');
            $table->double('harga');
            $table->integer('jumlah');
            $table->timestamps();

            $table->foreign('id_pelanggan')->references('id')->on('pelanggans');
            $table->foreign('id_obat')->references('id')->on('obats');
        });
    }

    public function down()
    {
        Schema::dropIfExists('keranjangs');
    }
}

