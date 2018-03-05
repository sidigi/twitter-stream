@extends('layouts.public')

@section('content')
	<section class="tweeter-stream page-wrapper">
		<div class="container">
			<div class="tweets-masonry flexbox flex-space flex-condensed row">
				@foreach($tweets as $tweet)
					<div class="tweet-box flex-item col-md-3">
						<div class="tweet">
							<div class="tweet-header">
								<span class="tweet-icon" style="background-image:url({{ $tweet->user_avatar_url }})"></span>
								<h5 class="tweet-title">{{ $tweet->user_screen_name }}</h5>
								<span class="tweet-time">{{ $tweet->created_at->diffForHumans() }}</span>
							</div>
							<div class="tweet-body">
								@if($tweet->media)
									@foreach($tweet->media as $media)
										<img class="tweet-image" src="{{ $media['media_url'] }}" alt="">
									@endforeach
								@endif
								<div class="tweet-message">{{ $tweet->tweet_text }}</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>
	<script>
        $(function(){
            $('.tweets-masonry').masonry({
                itemSelector: '.tweet-box'
            });
        });
	</script>

@endsection