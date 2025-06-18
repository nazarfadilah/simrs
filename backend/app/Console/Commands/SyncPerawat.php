<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncPerawat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-perawat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Mulai sinkronisasi data perawat...");

        $response = \Http::withToken('5|OXbCPoiKD7g6xuOvMaBwEZnrA6IecVi7rEiuM6pd37de8074')
            ->get('https://ti054a02.agussbn.my.id/api/perawats');
        if ($response->failed()) {
            $this->error("Gagal mengambil data dari API.");
            return;
        }

        $dataPerawat = $response->json();
        foreach ($dataPerawat as $perawat) {
            \App\Models\Perawat::updateOrCreate(
                ['id_perawat' => $perawat['id_perawat']],
                [
                    'nama_perawat' => $perawat['nama_perawat'],
                    'no_hp_perawat' => $perawat['no_hp_perawat'],
                    'id_user' => $perawat['id_user'] // pastikan kolom ini ada di tabel kamu
                ]
            );
        }
        $this->info("Sinkronisasi selesai. Total: " . count($dataPerawat) . " perawat.");
    }
}
