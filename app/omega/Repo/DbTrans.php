<?php namespace App\omega\Repo;

use App\omega\models\status;
use App\omega\Traits\DateTime;
use Excel;

class DbTrans
{
    use DateTime;

    public function toExcel()
    {
        $db = status::all();
        $today = DateTime::today();

        Excel::create("rh-temp {$today}", function($excel) use($db)
        {
            $year = DateTime::year();

            $excel->sheet("{$year}", function($sheet) use($db)
            {
                $sheet->fromArray($db);
            });
        })->download('csv');
    }
}