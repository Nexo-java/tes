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
        Schema::create('carts', function (Blueprint $table) {
          $table->id('chart_id');
            $table->Integer('nis');
            $table->unsignedInteger('menu_id');
            $table->Integer('jml');
            $table->decimal('subtotal', 10, 2);

            $table->foreign('nis')->references('nis')->on('tb_penggunas')->onDelete('cascade');
            $table->foreign('menu_id')->references('menu_id')->on('tb_menus')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
