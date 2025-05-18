<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPenjualansTable extends Migration
{
    public function up()
    {
        Schema::create('detail_penjualans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penjualan');
            $table->unsignedBigInteger('id_obat');
            $table->integer('jumlah_beli');
            $table->double('harga_beli');
            $table->integer('subtotal');
            $table->timestamps();

            $table->foreign('id_penjualan')->references('id')->on('penjualans');
            $table->foreign('id_obat')->references('id')->on('obats');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_penjualans');
    }
}
