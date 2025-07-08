<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncDokter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-dokter';

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
        $response = Http::get('https://ti054a02.agussbn.my.id/api/dokters');

        if ($response->failed()) {
            $this->error("Gagal mengambil data dari API.");
            return;
        }

        $dataDokter = $response->json();

        foreach ($dataDokter as $dokter) {
            Dokter::updateOrCreate(
                ['id_dokter' => $dokter['id_dokter']],
                [
                    'nama_dokter' => $dokter['nama_dokter'],
                    'spesialis' => $dokter['spesialis'],
                    'no_hp_dokter' => $dokter['no_hp_dokter'],
                    'id_user' => $dokter['id_user']
                ]
            );
        }
    }
}
