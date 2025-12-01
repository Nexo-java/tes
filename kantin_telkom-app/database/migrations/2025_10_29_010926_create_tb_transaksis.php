<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('transaksis', function (Blueprint $table) {
    $table->engine = 'InnoDB';
    $table->bigIncrements('id_transaksi');
    $table->integer('nis');
    $table->enum('metode_bayar', ['tunai', 'non-tunai']);
    $table->string('bukti_transfer', 100)->nullable();
    $table->enum('status_pembayaran', ['belum', 'bayar'])->default('belum');
    $table->dateTime('tgl_transaksi');
    $table->timestamps();

    $table->foreign('nis')->references('nis')->on('tb_penggunas')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
