<?php

namespace App\Charts;

use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TransaksiChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        // Get total transactions for each month of the current year
        $monthlyTotals = Transaksi::selectRaw('MONTH(tanggal_transaksi) as month, SUM(total) as total')
            ->whereYear('tanggal_transaksi', date('Y'))
            ->groupBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        // Generate an array of months from January to December
        $months = array_map(function ($month) {
            return date('F', mktime(0, 0, 0, $month, 1));
        }, range(1, 12));

        // Fill in total values for available months, set 0 for missing months
        $transaksiData = array_map(function ($month) use ($monthlyTotals) {
            return isset($monthlyTotals[$month]) ? $monthlyTotals[$month] : 0;
        }, range(1, 12));

        return $this->chart->barChart()
            ->setTitle('Omzet Transaksi')
            ->setSubtitle('Selama Tahun ' . date('Y'))
            ->addData('Total Omzet', $transaksiData)
            ->setXAxis($months);
    }
}
