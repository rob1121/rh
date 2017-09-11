<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\RH\Export\DatabaseExporter;

class exporterController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function export($from, $to)
    {
        $export_class = new DatabaseExporter($from, $to);
        $export_class->export();
    }
}
