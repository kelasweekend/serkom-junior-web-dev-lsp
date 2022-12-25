<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('armada_id');
            $table->foreign('armada_id')->references('id')->on('armadas')->onDelete('cascade');
            $table->string('nama');
            $table->string('ktp');
            $table->string('handphone');
            $table->date('jadwal');
            $table->integer('normal');
            $table->integer('lansia')->nullable();
            $table->string('harga');
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
        Schema::dropIfExists('transaksis');
    }
};
