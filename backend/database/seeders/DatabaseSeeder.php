<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat 20 user acak dengan password "password" (di-hash) dengan role mulai dari 1 sampai 8
        \App\Models\User::factory()->count(20)->create([
            'password' => bcrypt('password'),
            'role' => \App\Models\User::ROLE_ADMIN,
        ])->each(function ($user) {
            // Set role untuk setiap user
            $user->role = rand(1, 8); // Role antara 1 sampai 8
            $user->save();
        });
        // membuat data pasien 20 kali acak
        \App\Models\Pasien::factory()->count(20)->create();
        // membuat data dokter 2 kali acak
        \App\Models\Dokter::factory()->count(2)->create();
        // membuat data perawat 2 kali acak
        \App\Models\Perawat::factory()->count(2)->create();
        // membuat data poli 2 kali acak
        \App\Models\Poli::factory()->count(2)->create();
        // membuat data pendaftaran 20 kali acak
        \App\Models\Pendaftaran::factory()->count(20)->create();
    }
}
