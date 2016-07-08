<?php namespace App\omega\Repo;

use App\omega\models\status;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class DbTrans
{

    public function toExcel()
    {
        $db = status::all();

        Excel::create('rh-temp', function($excel) use($db)
        {
            $excel->sheet(Carbon::year(), function($sheet) use($db)
            {
                $sheet->fromArray($db);
            });
        })->download('csv');
    }
}