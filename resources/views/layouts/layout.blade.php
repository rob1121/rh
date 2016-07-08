<!DOCTYPE html>
<html>
<head>
	<title>RH TEMP</title>
	<link rel="stylesheet" type="text/css" href="{{ $server }}/css/app.css">
</head>
<body>

<div id="app" v-show="atReady">
	@yield('content')
</div>

@include('layouts.footer')
<script src="{{ $server }}/js/app.js"></script>
</body>
</html>