<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Semester;
use Illuminate\Support\Carbon;

class SemesterSeeder extends Seeder
{
    public function run()
    {
        $tahun1 = 2017;
        $tahun2 = 2018;
        for ($i = 0; $i < 7; $i++) {
            Semester::create([
                'semester' => "Ganjil",
                "tahun_ajaran" => "$tahun1/$tahun2",
                'tanggal_mulai' => Carbon::create(
                    $tahun1,
                    8,
                    1
                ),
                'tanggal_selesai' => Carbon::create($tahun1, 12, 15),
            ]);
            Semester::create([
                'semester' => "Genap",
                "tahun_ajaran" => "$tahun1/$tahun2",
                'tanggal_mulai' => Carbon::create(
                    $tahun2,
                    2,
                    3
                ),
                'tanggal_selesai' => Carbon::create($tahun2, 7, 15),
            ]);
            $tahun1++;
            $tahun2++;
        }
    }
}
