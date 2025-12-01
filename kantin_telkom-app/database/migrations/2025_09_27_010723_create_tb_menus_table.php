<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_menus', function (Blueprint $table) {
             $table->unsignedInteger('menu_id')->autoIncrement();
    $table->unsignedInteger('id_kantin');
    $table->string('nama_menu', 100);
    $table->decimal('harga', 10, 2);
    $table->integer('stok')->default(0);
    $table->string('gambar_menu', 100)->nullable();
    $table->text('deks_menu')->nullable();
    $table->enum('status_menu', ['aktif', 'nonaktif'])->default('aktif');

    $table->foreign('id_kantin')->references('id_kantin')->on('tb_kantins')->onDelete('cascade');
    $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('tb_menus');
    }
};
