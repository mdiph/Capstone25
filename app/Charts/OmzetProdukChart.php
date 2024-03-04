<?php

namespace App\Charts;

use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class OmzetProdukChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {

        $data = DB::select("SELECT
        produk.nama_produk AS label,
        SUM(transaksi_detail.stok_keluar) AS total_stok_keluar,
        produk.harga,
       produk.satuan,
        SUM(transaksi.total) AS total_transaksi
    FROM
        transaksi
    JOIN
        transaksi_detail ON transaksi.id = transaksi_detail.transaksi_id
    JOIN
        produk ON transaksi_detail.produk_id = produk.id
    GROUP BY
        produk.nama_produk, produk.harga, produk.satuan;");

        $dataArray1 = array_column($data, 'total_transaksi');
        $dataArray1 = array_map('intval', $dataArray1);

        $dataArray2 = array_column($data, 'total_stok_keluar');
        $dataArray2 = array_map('intval', $dataArray2);
        $labelArray = array_column($data, 'label');

        return $this->chart->barChart()
            ->setTitle('Omzet Produk.')
            ->setSubtitle('Total Harga & Stok Keluar')
            ->addData('Total Harga', $dataArray1)
            ->addData('Stok Keluar', $dataArray2)
            ->setHeight(250)
            ->setXAxis($labelArray);
    }

    public function buildByDateRange($fromDate, $toDate): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $query = "
        SELECT
        produk.nama_produk AS label,
        SUM(transaksi_detail.stok_keluar) AS total_stok_keluar,
        produk.harga,
       produk.satuan,
        SUM(transaksi_detail.total) AS total_transaksi
    FROM
        transaksi
    JOIN
        transaksi_detail ON transaksi.id = transaksi_detail.transaksi_id
    JOIN
        produk ON transaksi_detail.produk_id = produk.id

        WHERE transaksi.tanggal_transaksi BETWEEN ? AND ?
    GROUP BY
        produk.nama_produk, produk.harga, produk.satuan;
        ";

        $data = DB::select($query, [$fromDate, $toDate]);
        $dataArray1 = array_column($data, 'total_transaksi');
        $dataArray1 = array_map('intval', $dataArray1);



        $dataArray2 = array_column($data, 'total_stok_keluar');
        $dataArray2 = array_map('intval', $dataArray2);
        $labelArray = array_column($data, 'label');

        return $this->chart->barChart()
            ->setTitle('Omzet Produk.')
            ->setSubtitle("2024 - $fromDate to $toDate")
            ->setHeight(250)
            ->setSubtitle("2024 - $fromDate to $toDate")
            ->addData('Total Harga', $dataArray1)
            ->addData('Stok Keluar', $dataArray2)
            ->setXAxis($labelArray);
    }
}
