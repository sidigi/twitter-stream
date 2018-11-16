<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EPOCH2018') }}</title>
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
</head>
<body>
	<div>
		@yield('content')
	</div>

	<script src="{{ elixir('js/app.js') }}"></script>
</body>
</html>
