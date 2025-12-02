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
        Schema::create('datasiswas', function (Blueprint $table) {
            $table->id('siswa_id');
            $table->string('nama_siswa');
            $table->string('kelas_siswa');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->string('nip', 18)->unique();
            $table->enum('status', ['aktif', 'non-aktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datasiswas');
    }
};
