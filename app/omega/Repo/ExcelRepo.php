<?php namespace App\omega\Repo;

use App\omega\Traits\DateTime;
use App\omega\models\status;
use Carbon\Carbon;
use DB;
use Excel;

class ExcelRepo
{
    use DateTime;

    public function toExcel()
    {
        $db = collect(

            DB::table('devices')
                ->rightJoin('statuses', 'statuses.device_id', '=', 'devices.id')
                ->get(['devices.ip', 'devices.location', 'statuses.rh', 'statuses.temp', 'statuses.is_recording', 'statuses.created_at'])

        )->map(function($item) {
            return collect($item)->toArray();
        });

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