<!DOCTYPE html>
<html>
<head>
	<title>RH TEMP</title>
	<link rel="stylesheet" type="text/css" href="{{ env('CSS_LINK', '') }}/css/app.css">
</head>
<body>

<div id="app">
	@yield('content')
</div>

@include('layouts.footer')
<script src="{{ env('JS_LINK', '') }}/js/app.js"></script>
</body>
</html>