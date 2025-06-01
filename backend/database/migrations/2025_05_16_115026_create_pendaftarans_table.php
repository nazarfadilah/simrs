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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->increments('no_registrasi'); // auto_increment dan primary key
            $table->integer('rm', false, true); // int, unsigned, to match pasiens.rm
            $table->smallInteger('id_poli', false, true); // smallint(6) NOT NULL
            $table->dateTime('tgl_kunjungan');
            $table->tinyInteger('status');
            $table->smallInteger('no_antrian');
            $table->timestamps();

            // Foreign key ke tabel pasiens
            $table->foreign('rm')->references('rm')->on('pasiens')->onDelete('cascade');

            // Foreign key ke tabel polis
            $table->foreign('id_poli')->references('id_poli')->on('polis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
