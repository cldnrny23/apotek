<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('nonota');
            $table->date('tgl_pembelian');
            $table->decimal('total_bayar', 12, 2);
            $table->foreignId('id_distributor')->constrained('distributors');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembelians');
    }
};
