<?php namespace App\RH\Export;

use App\Device;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class DatabaseExporter
{
    private $from;
    private $to;
    private $db;

    /**
     * DatabaseExporter constructor.
     * @param $from
     * @param $to
     */
    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function export()
    {
        $this->fetchQuery()
            ->toArray()
            ->toExcel();
    }

    /**
     * @return $this
     */
    private function fetchQuery()
    {
        $range = [
            Carbon::parse($this->from)->format('Y-m-d'),
            Carbon::parse($this->to)->format('Y-m-d')
        ];

        $this->db = Device::with(['monitor' => function($query) use ( $range ) {
            $query->whereBetween('created_at', $range);
        }])->get();

        $this->db = $this->db->map(function($item) {
            if($item->monitor) {
                return collect( $item->monitor )->map(function( $device ) use( $item ) {
                    return [
                        'ip'           => $item->ip,
                        'location'     => $item->location,
                        'rh'           => $device->rh,
                        'temp'         => $device->temp,
                        'is_recording' => $device->is_recording,
                        'created_at'   => $device->created_at
                    ];
                });
            }
        })->flatten(1);

        return $this;
    }

    private function toArray()
    {
        $this->db = collect($this->db)->map(function($item)
        {
            return collect($item)->toArray();
        });

        return $this;
    }

    private function toExcel()
    {
        $today = Carbon::now();
        Excel::create("rh-temp {$today}", function($excel)
        {
            $year = Carbon::now()->year;

            $excel->sheet("{$year}", function($sheet)
            {
                $sheet->fromArray($this->db);
            });
        })->download('csv');
    }
}