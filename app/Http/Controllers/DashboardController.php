<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\TransaksiChart;

class DashboardController extends Controller
{
    //

    public function index(TransaksiChart $chart)
{
    return view('welcome', ['chart' => $chart->build()]);
}
}
