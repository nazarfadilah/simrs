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
        Schema::create('polis', function (Blueprint $table) {
            $table->smallIncrements('id_poli'); // Primary key, auto-increment smallint
            $table->string('nama_poli', 50);
            $table->unsignedSmallInteger('id_perawat');
            $table->unsignedSmallInteger('id_dokter');
            $table->timestamps();

            // Foreign key constraints (assuming tables 'perawats' and 'dokters' exist)
            $table->foreign('id_perawat')->references('id_perawat')->on('perawats')->onDelete('cascade');
            $table->foreign('id_dokter')->references('id_dokter')->on('dokters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polis');
    }
};
