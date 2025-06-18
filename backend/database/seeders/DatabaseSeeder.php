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
        ])->each(function ($user) {
            // Set role untuk setiap user
            $user->role = rand(1, 8); // Role antara 1 sampai 8
            $user->save();
        });
        // membuat data pasien 20 kali acak
        \App\Models\Pasien::factory()->count(20)->create();
    }
}
