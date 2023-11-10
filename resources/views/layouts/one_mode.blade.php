<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'EPOCH2018') }}</title>
    <link href="{{ mix('build/index/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @if ($mode === \App\Models\Option\Option::TWEETS_MODE)
            <tweet-page :title="{{ json_encode(config('app.name', 'EPOCH2018')) }}" :sponsor="{{ json_encode(config('laravel-twitter-streaming-api.sponsor')) }}"></tweet-page>
        @endif

        @if ($mode === \App\Models\Option\Option::CONTENT_MODE)
            <content-page></content-page>
        @endif

    </div>

    @if (!auth()->guest())
        <div style="display: block; position: fixed; width: 100px; height: 50px; cursor: pointer; z-index: 222; bottom: 20px; left: 20px">
            <a href="{{ route('admin.index') }}" class="btn btn-primary">Back to admin panel</a>
        </div>
    @endif

    <script src="{{ mix('build/index/js/app.js') }}"></script>
</body>
</html>
