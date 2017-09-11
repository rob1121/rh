<?php namespace App\RH\Traits\Macro;

use App\RH\Modules\Measurements;
use Illuminate\Support\Collection;

trait MeasurementCollectionMacro
{
    public function __construct()
    {
        Collection::macro("putMeasurements", function() {
            return (new Measurements($this->items))->getReadings();
        });
    }
}