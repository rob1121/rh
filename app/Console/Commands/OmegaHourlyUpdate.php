<?php namespace App\Console\Commands;

use App\Device;
use App\RH\Modules\Measurements;
use Illuminate\Console\Command;

class OmegaHourlyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'omega:read';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'read and update database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $devices  = Device::get(['id','ip','location','position']);
        $readings = (new Measurements($devices))->getMeasurements();

        collect($readings)->each(function ($reading) {
                 $this->logReadings($reading);
        });
    }

    /**
     * @param $reading
     * @internal param $readings
     */
    private function logReadings($reading)
    {
        // if ($reading['measurement_status'] === "failed")
        Device::find($reading['id'])->monitor()->create($this->monitorStab($reading));
    }

    /**
     * @param $reading
     * @return array
     */
    public function monitorStab($reading)
    {
        return [
            'rh' => $reading['humidity'],
            'temp' => $reading['temperature'],
            'is_recording' => $reading['recording']
        ];
    }
}
