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
        Schema::create('penyetorans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nasabah_id');
            $table->unsignedBigInteger('jenis_sampah_id');
            $table->float('berat');
            $table->integer('harga_per_kg');
            $table->integer('total');
            $table->date('tanggal_setor');
            $table->timestamps();

            // Foreign keys
            $table->foreign('nasabah_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('jenis_sampah_id')->references('id')->on('jenis_sampahs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('penyetorans'); // sesuai dengan nama tabel
    }
};