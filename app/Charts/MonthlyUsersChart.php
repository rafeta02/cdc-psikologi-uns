<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        return $this->chart->pieChart()
            ->setTitle('Tingkat Prestasi Mahasiswa')
            ->setSubtitle('Tahun 2024')
            ->addData([30, 50, 10])
            ->setLabels(['Internasional', 'Nasional', 'Lokal']);
    }
}
