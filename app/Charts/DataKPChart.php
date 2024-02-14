<?php

namespace App\Charts;

use App\Models\Prodi;
use App\Models\PendaftaranKP;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class DataKPChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function buildChart3(): \ArielMejiaDev\LarapexCharts\PieChart
{
    $prodis = Prodi::pluck('id')->toArray();

    $data = [];
    $total = 0;

    foreach ($prodis as $prodi) {
        $count = PendaftaranKP::where('prodi_id', $prodi)->count();
        $data[] = $count;
        $total += $count;
    }

    $labels = [];
    foreach ($prodis as $index => $prodiId) {
        $prodi = Prodi::find($prodiId);
        $percentage = ($total != 0) ? round(($data[$index] / $total) * 100, 2) : 0;
        $labels[] = $prodi->nama_prodi . ' (' . $percentage . '%)';
    }

    return $this->chart->pieChart()
        ->setTitle('Data Kerja Praktek')
        // ->setColors(['#FFC107', '#D32F2F'])
        ->setLabels($labels)
        ->addData($data)
        ->setGrid()
        ->setWidth(550)
        ->setHeight(550);
}
}
