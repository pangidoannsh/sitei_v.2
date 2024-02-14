<?php

namespace App\Charts;

use App\Models\Prodi;
use App\Models\Mahasiswa;
use App\Models\PendaftaranKP;
use ArielMejiaDev\LarapexCharts\PieChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use ArielMejiaDev\LarapexCharts\BarChart;

class AngkatanKPChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function buildChart4(): \ArielMejiaDev\LarapexCharts\BarChart
{

    $nims = PendaftaranKP::pluck('mahasiswa_nim')->toArray();

    $angkatanCounts = [];
    foreach ($nims as $nim) {
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();
        if ($mahasiswa) {
            $angkatan = $mahasiswa->angkatan;
            if (!isset($angkatanCounts[$angkatan])) {
                $angkatanCounts[$angkatan] = 1;
            } else {
                $angkatanCounts[$angkatan]++;
            }
        }
    }

    $totalPendaftar = array_sum($angkatanCounts);

    $labels = [];
    $data = [];
    foreach ($angkatanCounts as $angkatan => $count) {
        $percentage = ($totalPendaftar != 0) ? round(($count / $totalPendaftar) * 100, 2) : 0;
        $labels[] = 'Angkatan ' . $angkatan;
        $data[] = $count;
    }

    $chart = (new BarChart)->setTitle('Kerja Praktek/Angkatan')
                           ->setLabels($labels)
                           ->setWidth(550)
                           ->setHeight(400)
                           ->addData('Angkatan',$data);

    return $chart;
}

    // {
//     // Mengambil NIM Mahasiswa dari Tabel PendaftaranKP
//     $nims = PendaftaranKP::pluck('mahasiswa_nim')->toArray();

//     // Menghitung Jumlah Angkatan Mahasiswa
//     $angkatanCounts = [];
//     foreach ($nims as $nim) {
//         $mahasiswa = Mahasiswa::where('nim', $nim)->first();
//         if ($mahasiswa) {
//             $angkatan = $mahasiswa->angkatan;
//             if (!isset($angkatanCounts[$angkatan])) {
//                 $angkatanCounts[$angkatan] = 1;
//             } else {
//                 $angkatanCounts[$angkatan]++;
//             }
//         }
//     }

//     // Menghitung Total Jumlah Pendaftar
//     $totalPendaftar = array_sum($angkatanCounts);

//     // Menghitung Persentase dan Membuat Label
//     $labels = [];
//     $data = [];
//     foreach ($angkatanCounts as $angkatan => $count) {
//         $percentage = ($totalPendaftar != 0) ? round(($count / $totalPendaftar) * 100, 2) : 0;
//         $labels[] = 'Angkatan ' . $angkatan;
//         $data[] = $count;
//     }

//     // Membuat Objek Grafik Pie Chart
//     $chart = (new PieChart)->setTitle('Kerja Praktek/Angkatan Pendaftar')
//                            ->setLabels($labels)
//                            ->addData($data)
//                            ->setGrid()
//                            ->setWidth(550)
//                            ->setHeight(550);

//     return $chart;
// }


}
