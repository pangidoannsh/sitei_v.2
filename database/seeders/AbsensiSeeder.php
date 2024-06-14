<?php

namespace Database\Seeders;

use App\Models\AbGedung;
use App\Models\Kelas;
use App\Models\MataKuliah;
use Illuminate\Database\Seeder;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kelas::create([
            'nama_kelas' => 'D3 TE',
        ]);

        Kelas::create([
            'nama_kelas' => 'S1 TE A',
        ]);
        Kelas::create([
            'nama_kelas' => 'S1 TE B',
        ]);
        Kelas::create([
            'nama_kelas' => 'S1 TI A',
        ]);
        Kelas::create([
            'nama_kelas' => 'S1 TI B',
        ]);

        Kelas::create([
            'nama_kelas' => 'S1 TI RPL',
        ]);

        Kelas::create([
            'nama_kelas' => 'S1 TI KCV',
        ]);

        Kelas::create([
            'nama_kelas' => 'S1 TI KBJ',
        ]);
        Kelas::create([
            'nama_kelas' => 'S1 TE TELKOM',
        ]);

        Kelas::create([
            'nama_kelas' => 'S1 TE POWER',
        ]);

        Kelas::create([
            'nama_kelas' => 'S1 TE C',
        ]);

        Kelas::create([
            'nama_kelas' => 'Teknik Informatika',
        ]);

        AbGedung::create([
            'nama_gedung' => 'Gedung C',
            'koordinat_latitude' => '101.376851',
            'koordinat_longitude' => '0.480043'
        ]);
    }
}
