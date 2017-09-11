@extends('layouts.app')

@push('style')
<style>nav {
        display: none;
    }
    .qualification {
        position: fixed;
        bottom: 10px;
        right: 10px;
    }
</style>
@endpush
@push('script')
    <script src="{{url("/js/monitor.js")}}"></script>
@endpush

@section('content')
    <div class="qualification">
        <strong>PASSING RANGE:</strong> <br>
        <strong>HUMIDITY:</strong> 45 % - 55 % <strong>TEMPERATURE:</strong> 20 &deg;C - 25 &deg;C
    </div>
    <div  v-for="deviceSet in chunkRow" class="col-xs-12">
        <div v-for="device in deviceSet" class="col-xs-6 col-md-2">
    <div :class="'panel card panel-default ' + device.measurement.measurement_status" v-if="device.measurement.humidity">

        <div class="panel-heading">
            <strong>@{{device.location}}</strong>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6"><strong>HUMIDITY</strong></div>
                <div class="col-xs-6 text-right rate"><strong>@{{device.measurement.humidity}}</strong></div>
            </div>

            <div class="row">
                <div class="col-xs-6"><strong>TEMPERATURE</strong></div>
                <div class="col-xs-6 text-right rate"><strong>@{{device.measurement.temperature}}</strong></div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-xs-12 text-right">
                    <small>RECORDING : @{{device.measurement.recording}}</small>
                </div>
            </div>
        </div>

    </div>
        </div>
    </div>
@endsection
