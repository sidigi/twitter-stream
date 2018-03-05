<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<script
			src="//code.jquery.com/jquery-3.3.1.min.js"
			></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="http://code.jquery.com/color/jquery.color-2.1.2.min.js"></script>

    <title>{{ config('app.name', 'EPOCH2018') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

	<style>
		@font-face {
			font-family: light;
			src: url("/fonts/Proxima Nova Light.otf?076d851b602b9915c429f3a2e436c639");
			src: local(light);
			src: url("/fonts/Proxima Nova Light.otf?076d851b602b9915c429f3a2e436c639") format("opentype");
		}

		@font-face {
			font-family: regular;
			src: url("/fonts/Proxima Nova Regular.otf?410504d49238e955ba7dc23a7f963021");
			src: local(regular);
			src: url("/fonts/Proxima Nova Regular.otf?410504d49238e955ba7dc23a7f963021") format("opentype");
		}

		@font-face {
			font-family: bold;
			src: url("/fonts/Proxima Nova Bold.otf?62d4d7d369292a9bf23762465ec6d704");
			src: local(bold);
			src: url("/fonts/Proxima Nova Bold.otf?62d4d7d369292a9bf23762465ec6d704") format("opentype");
		}

		@font-face {
			font-family: extrabold;
			src: url("/fonts/Proxima Nova Extrabold.otf?b4f9eb8ce027016ab9b9860817451d07");
			src: local(extrabold);
			src: url("/fonts/Proxima Nova Extrabold.otf?b4f9eb8ce027016ab9b9860817451d07") format("opentype");
		}

		body {
			background: #e7ecef;
			font-family: regular, sans-serif;
			font-size: 2em;
		}

		h1, h2 , .tweet-title{
			color: #000;
		}

		.tweet-title, .tweet-time{
			font-size: 1.1em;
		}

		.tweeter-stream h3 {
			text-transform: unset;
			text-align: center;
		}
		.tweeter-stream h2 {
			text-align: center;
		}
		.tweets-masonry {
			margin-left: -7px;
			margin-right: -7px;
		}
		.tweet-box {
			margin-bottom: 14px;
			padding-left: 7px;
			padding-right: 7px;
		}
		.tweet {
			padding: 10px;
			-webkit-transition:1s ease all;
			box-sizing: border-box;
			-moz-box-sizing: border-box;
			-webkit-box-sizing: border-box;
			-webkit-box-shadow: 0 1px 3px rgba(0,0,0,.35);
			box-shadow: 0 1px 3px rgba(0,0,0,.35);
			background-color: #F9F9F9;
		}
		.tweet .tweet-header {
			display: -webkit-box;
			display: -webkit-flex;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-align: center;
			-webkit-align-items: center;
			-ms-flex-align: center;
			align-items: center;
			margin-bottom: 10px;
		}
		.tweet .tweet-header > * {}
		.tweet .tweet-header .tweet-icon {
			width: 40px;
			max-width: 40px;
			min-width: 40px;
			height: 40px;
			max-height: 40px;
			min-height: 40px;
			border-radius: 50%;
			border: 1px solid #dcdcdc;
			background-repeat: no-repeat;
			background-position: center center;
			-webkit-background-size: cover;
			background-size: cover;
		}
		.tweet .tweet-header .tweet-title {
			margin: 0;
			font-weight: bold;
		}
		.tweet .tweet-header .tweet-time {
			font-size: .8em;
			min-width: 5em;
			text-align: right;
			color: gray;
			margin-left: auto;
		}
		.tweet .tweet-header .tweet-icon + .tweet-title {
			margin-left: 10px;
		}
		.tweet .tweet-body .tweet-image {
			width:100%;
		}
		.tweet .tweet-body .tweet-image + .tweet-message {
			margin-top: 10px;
		}
	</style>
</head>
<body>
	<div>
		@yield('content')
	</div>

    <script src="/js/app.js"></script>
	<script src="/js/masonry.min.js"></script>
	<script>
        var seconds = 5;
        /*setInterval(function(){
            $.ajax({
                url: location.href,
            }).done(function(data){
                $('.page-wrapper').html($(data).find('.page-wrapper').html());
                $('.tweets-masonry').masonry({
                    itemSelector: '.tweet-box'
                });
            });
        }, seconds * 1000);*/

	</script>
</body>
</html>
