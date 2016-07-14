<?php namespace App\omega\Repo;

use App\omega\Traits\DateTime;
use App\omega\models\status;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Excel;

class ExcelRepo
{
    public $request;
    use DateTime;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function toExcel()
    {   $columns = [
            'devices.ip',
            'devices.location',
            'statuses.rh',
            'statuses.temp',
            'statuses.is_recording',
            'statuses.created_at'
        ];
        $clause['operator'] = $this->request->month > 0 ? 'LIKE' : '<>';
        $clause['look_up_value'] = $this->request->month > 0 ? $this->request->month : 0;

        $db = collect(

            DB::table('devices')
                ->rightJoin('statuses', 'statuses.device_id', '=', 'devices.id')
                ->whereMonth('statuses.created_at', $clause['operator'], $clause['look_up_value'])
                ->whereYear('statuses.created_at', '=', $this->request->year)
                ->get($columns)

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