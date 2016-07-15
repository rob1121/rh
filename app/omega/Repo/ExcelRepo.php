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
    public $db;
    const columns = [
            'devices.ip',
            'devices.location',
            'statuses.rh',
            'statuses.temp',
            'statuses.is_recording',
            'statuses.created_at'
        ];

    use DateTime;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function fetchQuery()
    {
        $range = [
            Carbon::parse($this->request->from)->format('Y-m-d'),
            Carbon::parse($this->request->to)->format('Y-m-d')
        ];

        $this->db = DB::table('devices')
            ->rightJoin('statuses', 'statuses.device_id', '=', 'devices.id')
            ->whereBetween('statuses.created_at', $range)
            ->get(static::columns);

        return $this;
    }

    public function toArray()
    {
        $this->db = collect($this->db)->map(function($item)
        {
            return collect($item)->toArray();
        });

        return $this;
    }

    public function toExcel()
    {
        $today = DateTime::today();

        Excel::create("rh-temp {$today}", function($excel)
        {
            $year = DateTime::year();

            $excel->sheet("{$year}", function($sheet)
            {
                $sheet->fromArray($this->db);
            });
        })->download('csv');
    }
}