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
        Schema::create('dokters', function (Blueprint $table) {
            $table->smallIncrements('id_dokter');
            $table->string('nama_dokter', 50);
            $table->string('spesialis', 50);
            $table->char('no_hp_dokter', 15);
            $table->unsignedBigInteger('id_user');
            $table->timestamps();
        });
        Schema::table('dokters', function (Blueprint $table) {
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokters');
    }
};
