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
        Schema::create('tb_penggunas', function (Blueprint $table) {
        $table->integer('nis')->primary()->unique();
        $table->string('nama_siswa', 100);
        $table->string('telp_siswa', 100);
        $table->string('email_siswa', 100);
        $table->string('jurusan_siswa', 100)->nullable();
        $table->string('kelas_siswa', 100);
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_penggunas');
    }
};
