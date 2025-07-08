<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncPoli extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-poli';

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
        $response = Http::get('https://ti054a02.agussbn.my.id/api/polis');

        if ($response->failed()) {
            $this->error("Gagal mengambil data dari API.");
            return;
        }

        $dataPoli = $response->json();
        foreach ($dataPoli as $poli) {
            \App\Models\Poli::updateOrCreate(
                ['id_poli' => $poli['id_poli']],
                [
                    'nama_poli' => $poli['nama_poli'],
                    'id_dokter' => $poli['id_dokter'],
                    'id_perawat' => $poli['id_perawat'] // pastikan kolom ini ada di tabel kamu
                ]
            );
        }
    }
}
