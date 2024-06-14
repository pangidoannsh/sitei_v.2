<?php

namespace Database\Seeders;

use App\Models\Mbkm\MataKuliah;
use App\Models\Mbkm\Program;
use Illuminate\Database\Seeder;

class MbkmSeeder extends Seeder
{
    public function run()
    {
        $programs = [
            "Studi Indenpenden", "Magang", "IISMA", "PMM (Pertukaran Pelajar Merdeka)",
            "KAMPUS MENGAJAR", "Lainnya"
        ];
        foreach ($programs as  $program) {
            Program::create([
                'name' => $program
            ]);
        }
    }
}
