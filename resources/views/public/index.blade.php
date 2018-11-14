@extends('layouts.public')

@section('content')
	@if (!auth()->guest())
		<div style="display: block; position: fixed; width: 100px; height: 50px; cursor: pointer; z-index: 222; bottom: 20px; left: 20px">
			<a href="/admin" class="btn btn-primary">Back to admin panel</a>
		</div>
	@endif

	<div class="row">
		<div class="col-md-12">
			<div class="text-center">
				<h1>Twitter stream <b>#PRCRussiaCIS2018</b></h1>
			</div>
		</div>
	</div>

	<section class="tweeter-stream page-wrapper">
		<div class="container-fluid">
			<div class="tweets-masonry row" data-masonry='{"itemSelector": ".tweet-box", "horizontalOrder": "true"}'>
				@foreach($tweets as $tweet)
					<div class="tweet-box col-md-3">
						<div class="tweet {{$tweet->id}}" data-tweet-id="{{$tweet->id}}">
							<div class="tweet-header">
								<span class="tweet-icon" style="background-image:url({{ $tweet->user_avatar_url }})"></span>
								<h5 class="tweet-title">{{ $tweet->user_screen_name }}</h5>
								<span class="tweet-time"> {{ $tweet->created_at->diffForHumans() }}</span>
							</div>
							<div class="tweet-body">
								@if($tweet->media)
									@foreach($tweet->media as $media)
										<img class="tweet-image" src="{{ $media['media_url'] }}" alt="">
									@endforeach
								@endif
								<div class="tweet-message">{!! $tweet->tweet_text !!}</div>
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