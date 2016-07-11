@extends('layouts.layout')

@push('style')
    <link rel="stylesheet" type="text/css" href="{{ $server }}/css/app.css">
@endpush

@section('content')
    <card :omegas="omegas" :time="time">TSPI RH & Temp. Monitoring</card>
@endsection

@push('script')
    <script src="{{ $server }}/js/app.js"></script>
@endpush
