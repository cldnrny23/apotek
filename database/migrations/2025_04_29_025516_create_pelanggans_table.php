<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan');
            $table->string('email')->unique();
            $table->string('no_telp');
            $table->string('katakunci');
            $table->string('alamat1')->default('-');
            $table->string('kota1')->default('-');
            $table->string('propinsi1')->default('-');
            $table->string('kodepos1')->default('-');
            $table->string('alamat2')->default('-');
            $table->string('kota2')->default('-');
            $table->string('propinsi2')->default('-');
            $table->string('kodepos2')->default('-');
            $table->string('alamat3')->default('-');
            $table->string('kota3')->default('-');
            $table->string('propinsi3')->default('-');
            $table->string('kodepos3')->default('-');
            $table->string('foto')->default('default.jpg');
            $table->string('url_ktp')->default('default.jpg');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pelanggans');
    }
};
