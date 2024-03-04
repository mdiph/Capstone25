<?php

namespace App\Charts;

use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class OmzetSalesmanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $data = DB::select('
        SELECT salesman.nama_salesman AS label, SUM(transaksi.total) AS datatabel
        FROM transaksi JOIN salesman ON transaksi.salesman_id = salesman.id GROUP BY salesman.nama_salesman;
        ');


        $dataArray = array_column($data, 'datatabel');
        $dataArray = array_map('intval', $dataArray);
        $labelArray = array_column($data, 'label');
        return $this->chart->pieChart()
            ->setTitle('Omzet Salesman')
            ->setSubtitle('Season 2024.')
            ->setHeight(250)
            ->addData($dataArray)
            ->setLabels($labelArray);
    }

    public function buildByDateRange($fromDate, $toDate): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $query = "
        SELECT

        salesman.nama_salesman AS label,
        SUM(transaksi.total) AS total_harga
      FROM
        transaksi
        JOIN
        salesman
        ON
        transaksi.salesman_id = salesman.id
        WHERE transaksi.tanggal_transaksi BETWEEN ? AND ?
      GROUP BY

        salesman.nama_salesman;
        ";

        $data = DB::select($query, [$fromDate, $toDate]);
        $dataArray = array_column($data, 'total_harga');
        $dataArray = array_map('intval', $dataArray);
        $labelArray = array_column($data, 'label');

        return $this->chart->pieChart()
            ->setTitle('Omzet Salesman')
            ->setHeight(250)
            ->setSubtitle("2024 - $fromDate to $toDate")
            ->addData($dataArray)
            ->setLabels($labelArray);
    }
}
