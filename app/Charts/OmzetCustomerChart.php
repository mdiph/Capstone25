<?php

namespace App\Charts;

use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class OmzetCustomerChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {

        $data = DB::select('
        SELECT customer.nama_customer AS label, SUM(transaksi.total) AS data
        FROM customer
        JOIN transaksi ON customer.id = transaksi.customer_id
        GROUP BY customer.nama_customer;
    ');

    // Mendapatkan array data dan array label dari hasil query
    $dataArray = array_column($data, 'data');
    $dataArray = array_map('intval', $dataArray);


    $labelArray = array_column($data, 'label');

    // Mengembalikan objek grafik dengan data dan label dari hasil query
    return $this->chart->pieChart()
        ->setTitle('Omzet Customer')
        ->setHeight(250)
        ->setSubtitle('2024.')
        ->addData($dataArray)
        ->setLabels($labelArray);
    }
}
