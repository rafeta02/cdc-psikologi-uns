<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class BarChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($title, $subtitle, $data, $label): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $grafik = $this->chart->barChart()
            ->setTitle($title)
            ->setSubtitle($subtitle)
            ->setXAxis($label)
            ->setGrid();

        foreach($data as $item) {
            $grafik->addData($item[0], $item[1]);
        }

        return $grafik;
    }
}
