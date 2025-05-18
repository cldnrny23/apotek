<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObatsTable extends Migration
{
    public function up()
    {
        Schema::create('obats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_obat', 100);
            $table->unsignedBigInteger('id_jenis');
            $table->double('harga_jual');
            $table->text('deskripsi_obat')->nullable();
            $table->string('foto1', 255)->nullable();
            $table->string('foto2', 255)->nullable();
            $table->string('foto3', 255)->nullable();
            $table->integer('stok')->default(0);
            $table->timestamps();

            $table->foreign('id_jenis')->references('id')->on('jenis_obats')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('obats');
    }
}

