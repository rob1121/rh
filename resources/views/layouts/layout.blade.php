<!DOCTYPE html>
<html>
<head>
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
							<a href="{{ route('devices') }}">
								<i class="fa fa-table"></i>
								update device list
							</a>
						</div>
					</li>

					<li>
						<div class="item">
							<a href="{{ route('exportToCsv') }}">
								<i class="fa fa-download"></i>
								export to excel
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