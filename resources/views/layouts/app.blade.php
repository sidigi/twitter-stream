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
		.tweet {
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
			margin-bottom: 20px;
		}
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
		}

		.container-wide {
			width: 1400px;
			margin: 0 auto;
		}

		.container-wide h1 {
			color: #707070;
			font-size: 4em;
			margin: 80px auto 60px;
			font-family: regular, sans-serif;
		}

		.posts {
			padding: 0 40px;
		}

		.posts .post {
			margin-bottom: 30px;
		}

		.posts .post-header .user {
			overflow: hidden;
		}

		.posts .post-header .user img {
			float: left;
			width: 50px;
			height: 50px;
			border-radius: 50%;
		}

		.posts .post-header .name {
			font-size: 1.4em;
			margin: 12px 0 0 15px;
			float: left;
			font-weight: bold;
		}

		.posts .post-header .created {
			float: left;
			margin: 15px 0 0 15px;
			color: #8e8e8e;
			font-size: 1.2em;
		}

		.posts .post-body {
			font-size: 1.2em;
			line-height: 1.4;
		}

		.posts .post-media {
			margin: 20px 0 50px;
		}

		.posts .post-media img {
			max-width: 100%;
		}

		.unread{
			background: #baffbe;;
		}
	</style>
</head>
<body>
        @if (!auth()->guest())
		    <nav class="navbar navbar-default navbar-static-top">
			    <div class="container">
		            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ auth()->user()->name }}
                                </a>
                            </li>
	                        <li class="dropdown">
	                            <a href="{{ url('/logout') }}"
	                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout
	                            </a>
		                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
			                        {{ csrf_field() }}
		                        </form>
	                        </li>
                        </ul>
		            </div>
			    </div>
		    </nav>
        @endif

        <div class="container-wide">
	        <section class="container-fluid">
		        @yield('content')
	        </section>
        </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
