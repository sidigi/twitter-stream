<div class="media">
	<div class="media-left">
		<img class="img-thumbnail media-object" src="{{ $tweet->user_avatar_url }}" alt="Avatar">
	</div>
	<div class="media-body">
		<h4 class="media-heading">{{ '@' . $tweet->user_screen_name }}</h4>
		<p>{{ $tweet->tweet_text }}</p>
		<p><a target="_blank" href="https://twitter.com/{{ $tweet->user_screen_name }}/status/{{ $tweet->id }}">
				View on Twitter
			</a></p>
		@if($tweet->media)
			<div class="post-media">
				@foreach($tweet->media as $media)
					<img src="{{ $media['media_url'] }}" alt="" class="img-responsive">
				@endforeach
			</div>
		@endif
	</div>
</div>