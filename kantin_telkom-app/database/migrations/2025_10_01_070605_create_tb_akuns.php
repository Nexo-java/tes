<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_akuns', function (Blueprint $table) {
            $table->id('akun_id'); // primary key auto increment
            $table->string('username', 50)->unique()->nullable(); // ✅ sekarang boleh kosong
            $table->string('password', 100);
            $table->enum('role', ['admin', 'siswa']);
            $table->integer('nis')->nullable(true);
            $table->foreign('nis')->references('nis')->on('tb_penggunas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_akuns');
    }
};
