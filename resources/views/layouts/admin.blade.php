<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Optional theme -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <title>{{ config('app.name', 'EPOCH2018') }}</title>
	<link rel="stylesheet" href="{{ mix('build/admin/css/app.css') }}">
</head>
<body>
        @if (!auth()->guest())
		    <nav class="navbar navbar-default navbar-static-top">
			    <div class="container">
		            <div class="collapse navbar-collapse" id="app-navbar-collapse">
						<ul class="nav navbar-nav navbar">
							<li class="dropdown">
								<form action="{{ route('admin.app.change-mode')}}" method="post" style="padding: 5px 15px;">
									<div class="checkbox">
										<label>
											<input
												type="checkbox"
												name="content-mode"

												@if($mode === \App\Models\Option\Option::CONTENT_MODE)
													value="{{\App\Models\Option\Option::TWEETS_MODE}}"
												@else
													value="{{\App\Models\Option\Option::CONTENT_MODE}}"
												@endif

												class="app-mode-image"
												@if($mode === \App\Models\Option\Option::TWEETS_MODE)
													checked="checked"
												@endif
											> Show only tweets</label>
									</div>
								</form>
							</li>
						</ul>

                        <ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="{{ route('admin.tweets.index') }}">
									Tweets
								</a>
							</li>
							<li class="dropdown">
								<a href="{{ route('admin.tweets.create') }}">
									Add tweet
								</a>
							</li>
							<li class="dropdown">
								<a href="{{ route('admin.content.index') }}">
									Content
								</a>
							</li>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Public <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li class="dropdown">
										<a  href="{{ route('home') }}">
											Home
										</a>
									</li>
									<li class="dropdown">
										<a href="{{ route('tweets') }}">
											Tweets only
										</a>
									</li>
									<li class="dropdown">
										<a href="{{ route('content') }}">
											Content only
										</a>
									</li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profile <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li>
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
											{{ auth()->user()->name }}
										</a>
									</li>
									<li>
										<a href="{{ url('/logout') }}"
										   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout
										</a>
										<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
											{{ csrf_field() }}
										</form>
									</li>
								</ul>
							</li>
                        </ul>
		            </div>
			    </div>
		    </nav>
        @endif

        <div class="container-wide">
	        <section class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="text-center">
							<h1>#PRCRussiaCIS2018</h1>
						</div>
					</div>
				</div>

		        @yield('content')
	        </section>
        </div>

    <!-- Scripts -->
    <script src="{{ mix('build/admin/js/app.js') }}"></script>
	@yield('scripts')
</body>
</html>
