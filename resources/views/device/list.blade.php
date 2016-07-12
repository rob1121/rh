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
		<device-table
			:devices.sync="devices"
			:input.sync="input"
			:index.sync="index"
			:id.sync="id"
		>

		</device-table>
	</section>

	<div class="form">
		<input-text :input.sync="input.ip" name="ip"></input-text>
		<input-text :input.sync="input.location" name="location"></input-text>

		<button class="btn save" @click="updateDevice" v-show="index != null">
			Save
			<i class="fa fa-save"></i>
		</button>

		<button class="btn save" @click="storeDevice" v-show="index == null">
			Insert
			<i class="fa fa-plus"></i>
		</button>

		<button class="btn cancel">
			Cancel
			<i class="fa fa-remove"></i>
		</button>
	</div>
</div>
@endsection

@push('script')
<script src="{{ $server }}/js/vue-device.js"></script>
@endpush
