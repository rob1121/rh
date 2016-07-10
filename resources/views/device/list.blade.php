@extends('layouts.layout')

@push('style')
<link rel="stylesheet" type="text/css" href="{{ $server }}/css/vue-device.css">
@endpush

@section('content')
    list of item
@endsection

@push('script')
<script src="{{ $server }}/js/vue-device.js"></script>
@endpush
