<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="_token" value="{{ csrf_token() }}">

	<title>RH TEMP</title>
    @stack('style')
</head>
<body>

<div id="app" v-show="atReady">
	<toggle-gear>
		<div class="dropdown-box">
			<ul class="dropdown">
				@if(Auth::user())
					<li>
						<div class="item">

							<a href="
								@php
									echo Request::url() == route('devices')
										? route('home')
										: route('devices')
								@endphp
								">
								<i class="fa fa-table"></i>
								@php
									echo Request::url() == route('devices')
										? "home"
										: "update device list"
								@endphp
							</a>
						</div>
					</li>

					<li>
						<div class="item">
							<a href="{{ url('/logout') }}">
								<i class="fa fa-sign-out"></i>
								Logout
							</a>
						</div>
					</li>
				@else
					<li>
						<div class="item">
							<a href="{{ url('/login') }}">
								<i class="fa fa-sign-in"></i>
								Login
							</a>
						</div>
					</li>
				@endif
			</ul>
		</div>
	</toggle-gear>

	@yield('content')
</div>

@include('layouts.footer')
@stack('script')
</body>
</html>