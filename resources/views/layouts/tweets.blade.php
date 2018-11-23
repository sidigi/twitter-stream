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
    <div style="height: 100%; width: 100%">
        <div style="height: 100%; width: 100%" class="app-wrapper">
            <div class="app-mode" data-app-mode="tweet-list"></div>
            @yield('content')
        </div>
    </div>


    @if (!auth()->guest())
        <div style="display: block; position: fixed; width: 100px; height: 50px; cursor: pointer; z-index: 222; bottom: 20px; left: 20px">
            <a href="/admin" class="btn btn-primary">Back to admin panel</a>
        </div>
    @endif

    <script src="{{ elixir('js/app.js') }}"></script>
</body>
</html>
