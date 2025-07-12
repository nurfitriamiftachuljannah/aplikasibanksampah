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

        public function up(): void
    {
        Schema::create('sampahs', function (Blueprint $table) {
    
        // Relasi ke tabel jenis_sampahs
        $table->id();
        $table->unsignedBigInteger('jenis_sampah_id');
        $table->decimal('harga', 10, 0);
        $table->string('foto')->nullable();
        $table->timestamps();

        // Foreign key yang benar
        $table->foreign('jenis_sampah_id')
          ->references('id')
          ->on('jenis_sampahs')
          ->onDelete('cascade');
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('sampahs');
    }
};
