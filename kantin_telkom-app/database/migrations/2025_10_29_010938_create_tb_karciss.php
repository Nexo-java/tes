<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('tb_karciss', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('karcis_id');
            $table->unsignedBigInteger('id_transaksi');
            $table->dateTime('tgl_cetak');
            $table->timestamps();

            $table->foreign('id_transaksi')
                  ->references('id_transaksi')
                  ->on('transaksis')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_karciss');
    }
};

