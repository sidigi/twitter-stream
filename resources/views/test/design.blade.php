@extends('layouts.public')

@section('content')
	<style>
		.tweet-box {
			margin-bottom: 10px;
		}
		.tweet {
			padding: 1em;
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
			margin-bottom:15px;
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

	<section class="tweeter-stream">
		<div class="container">
			<div class="tweets-masonry flexbox flex-space flex-condensed row">
				<div class="tweet-box flex-item col-md-3">
					<div class="tweet">
						<div class="tweet-header">
							<span class="tweet-icon" style="background-image:url(http://ultraimg.com/images/photo-3.jpg)"></span>
							<h5 class="tweet-title">Duis lobortis massa imperdiet</h5>
							<span class="tweet-time">10 min</span>
						</div>
						<div class="tweet-body">
							<img class="tweet-image" src="http://oilepoch.com/upload/optimized/resize_cache/iblock/470/800_600_1/47074a06cb6da9c8256e8d7eb999fa1a.jpg">
							<div class="tweet-message">
								Vestibulum facilisis, purus nec pulvinar iaculis, ligula mi congue nunc, vitae euismod ligula urna in dolor. Etiam rhoncus. Cras dapibus. Etiam sollicitudin, ipsum eu pulvinar rutrum, tellus ipsum laoreet sapien, quis venenatis ante odio sit amet eros.

								Aliquam lobortis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Vivamus elementum semper nisi. Aliquam erat volutpat.
							</div>
						</div>
					</div>
				</div>
				<div class="tweet-box flex-item col-md-3">
					<div class="tweet">
						<div class="tweet-header">
							<span class="tweet-icon" style="background-image:url(http://ultraimg.com/images/photo-3.jpg)"></span>
							<h5 class="tweet-title">Duis lobortis massa imperdiet</h5>
							<span class="tweet-time">13 hours ago</span>
						</div>
						<div class="tweet-body">
							<img class="tweet-image" src="http://oilepoch.com/upload/optimized/resize_cache/iblock/470/800_600_1/47074a06cb6da9c8256e8d7eb999fa1a.jpg">
							<div class="tweet-message">
								Pellentesque ut neque. Nullam cursus lacinia erat. Donec orci lectus, aliquam ut, faucibus non, euismod id, nulla.

								Praesent ac sem eget est egestas volutpat. Aenean massa. Etiam rhoncus.
							</div>
						</div>
					</div>
				</div>
				<div class="tweet-box flex-item col-md-3">
					<div class="tweet">
						<div class="tweet-header">
							<span class="tweet-icon" style="background-image:url(http://ultraimg.com/images/photo-3.jpg)"></span>
							<h5 class="tweet-title">Duis lobortis massa imperdiet</h5>
							<span class="tweet-time">13 hours ago</span>
						</div>
						<div class="tweet-body">
							<img class="tweet-image" src="http://oilepoch.com/upload/optimized/resize_cache/iblock/470/800_600_1/47074a06cb6da9c8256e8d7eb999fa1a.jpg">
							<div class="tweet-message">
								Etiam ultricies nisi vel augue. Integer tincidunt. Vestibulum rutrum, mi nec elementum vehicula, eros quam gravida nisl, id fringilla neque ante vel mi. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Aenean imperdiet.

								Praesent nonummy mi in odio. Etiam rhoncus. Etiam ultricies nisi vel augue. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Quisque ut nisi.
							</div>
						</div>
					</div>
				</div>
				<div class="tweet-box flex-item col-md-3">
					<div class="tweet">
						<div class="tweet-header">
							<span class="tweet-icon" style="background-image:url(http://ultraimg.com/images/photo-3.jpg)"></span>
							<h5 class="tweet-title">Duis lobortis massa imperdiet</h5>
							<span class="tweet-time">13 hours ago</span>
						</div>
						<div class="tweet-body">
							<img class="tweet-image" src="http://oilepoch.com/upload/optimized/resize_cache/iblock/470/800_600_1/47074a06cb6da9c8256e8d7eb999fa1a.jpg">
							<div class="tweet-message">
								Etiam ultricies nisi vel augue. Integer tincidunt. Vestibulum rutrum, mi nec elementum vehicula, eros quam gravida nisl, id fringilla neque ante vel mi. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Aenean imperdiet.

								Praesent nonummy mi in odio. Etiam rhoncus. Etiam ultricies nisi vel augue. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Quisque ut nisi.

								In turpis. Cras non dolor. Phasellus nec sem in justo pellentesque facilisis. Etiam sollicitudin, ipsum eu pulvinar rutrum, tellus ipsum laoreet sapien, quis venenatis ante odio sit amet eros. Donec vitae orci sed dolor rutrum auctor.

								Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Praesent egestas neque eu enim. Etiam feugiat lorem non metus. Pellentesque dapibus hendrerit tortor. Vivamus laoreet.

								Aenean massa. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Praesent adipiscing. Curabitur ullamcorper ultricies nisi. Ut leo.
							</div>
						</div>
					</div>
				</div>
				<div class="tweet-box flex-item col-md-3">
					<div class="tweet">
						<div class="tweet-header">
							<span class="tweet-icon" style="background-image:url(http://ultraimg.com/images/photo-3.jpg)"></span>
							<h5 class="tweet-title">Duis lobortis massa imperdiet</h5>
							<span class="tweet-time">13 hours ago</span>
						</div>
						<div class="tweet-body">
							<img class="tweet-image" src="http://oilepoch.com/upload/optimized/resize_cache/iblock/470/800_600_1/47074a06cb6da9c8256e8d7eb999fa1a.jpg">
							<div class="tweet-message">
								Etiam ultricies nisi vel augue. Integer tincidunt. Vestibulum rutrum, mi nec elementum vehicula, eros quam gravida nisl, id fringilla neque ante vel mi. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Aenean imperdiet.

								Praesent nonummy mi in odio. Etiam rhoncus. Etiam ultricies nisi vel augue. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Quisque ut nisi.

								In turpis. Cras non dolor. Phasellus nec sem in justo pellentesque facilisis. Etiam sollicitudin, ipsum eu pulvinar rutrum, tellus ipsum laoreet sapien, quis venenatis ante odio sit amet eros. Donec vitae orci sed dolor rutrum auctor.

								Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Praesent egestas neque eu enim. Etiam feugiat lorem non metus. Pellentesque dapibus hendrerit tortor. Vivamus laoreet.

								Aenean massa. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Praesent adipiscing. Curabitur ullamcorper ultricies nisi. Ut leo.
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script>
        $(function(){
            $('.tweets-masonry').masonry({
                itemSelector: '.tweet-box'
            });
        })
	</script>
@endsection