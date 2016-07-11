<?php namespace App\omega\Repo;

use App\omega\Traits\DateTime;
use App\omega\models\status;
use Carbon\Carbon;
use DB;
use Excel;

class DbTrans
{
    use DateTime;

    public function toExcel()
    {
        $db = collect(

                DB::table('statuses')
                    ->leftJoin('devices', 'statuses.device_id', '=', 'devices.id')
                    ->get()

            )->map(function($item) {
                return collect($item)->toArray();
            });

            echo "date and time using query builder<br/>";
            var_dump(Carbon::parse(collect($db)->last()['created_at']));

            $eloquent = status::orderBy('id','desc')->first();
            echo "date and time using eloquent<br/>";
            var_dump($eloquent->created_at);

            die();

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