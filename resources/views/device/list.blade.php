@extends('layouts.layout')

@push('style')
	<link
		rel="stylesheet"
		type="text/css"
		href="{{ $server }}/css/vue-device.css"
	>
@endpush

@section('content')
	<div class="content">
		<section class="header">
			<p class="title">Devices</p>
			<device-table :devices="devices"></device-table>
		</section>
	</div>
@endsection

@push('script')
<script src="{{ $server }}/js/vue-device.js"></script>
@endpush
