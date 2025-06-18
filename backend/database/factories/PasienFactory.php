<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pasien>
 */
class PasienFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rm' => $this->faker->unique()->numerify(),
            'nik' => $this->faker->unique()->numerify(str_repeat('#', 16)),
            'nama_pasien' => $this->faker->name(),
            'tgl_lahir' => $this->faker->date(),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'kabupaten' => $this->faker->randomElement([
                'Banjar',
                'Barito Kuala',
                'Tapin',
                'Hulu Sungai Selatan',
                'Hulu Sungai Tengah',
                'Hulu Sungai Utara',
                'Tabalong',
                'Tanah Laut',
                'Tanah Bumbu',
                'Balangan',
                'Kotabaru',
                'Banjarmasin (Kota)',
                'Banjarbaru (Kota)'
            ]),
            'pekerjaan' => $this->faker->jobTitle(),
            'jns_kelamin' => $this->faker->randomElement(['pria', 'perempuan']),
            'alamat' => $this->faker->address(),
            'no_hp_pasien' => $this->faker->numerify($this->faker->randomElement(['08###########', '08##########'])),
            'email_pasien' => $this->faker->unique()->userName . '@gmail.com',
            'gol_darah' => $this->faker->randomElement(['A', 'B', 'AB', 'O']),
        ];
    }
}
