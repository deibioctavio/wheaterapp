<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\SensorData;

class SensorReportsDatatableController extends Controller
{
    public function index()
    {
        return view('sensors.reports.home');
    }

    public function all()
    {
        return Datatables::of(SensorData::get())->make(true);
        //return response()->json(SensorData::get());
    }
}
