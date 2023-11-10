<div class="media">
	<div class="media-left">
		<img class="img-thumbnail media-object" src="{{ $tweet->user_avatar_url }}" alt="Avatar">
	</div>
	<div class="media-body">
		<h4 class="media-heading">{{ '@' . $tweet->user_screen_name }}</h4>
		<p>{!! $tweet->tweet_text !!}</p>
		<p><a target="_blank" href="https://twitter.com/{{ $tweet->user_screen_name }}/status/{{ $tweet->id }}">
				View on Twitter
			</a></p>
		@if($tweet->media)
			<div class="post-media">
				@foreach($tweet->media as $media)
					@if ($media['type'] === 'photo')
						<img src="{{ $media['media_url'] }}" alt="" class="img-responsive">
					@endif

					@if ($media['type'] === 'video')
						<video style="width:600px;max-width:100%;" controls muted>
							@foreach($media['video_info']['variants'] as $video)
								<source src="{{$video['url']}}" type="{{$video['content_type']}}">
							@endforeach
							Your browser does not support HTML5 video.
						</video>
					@endif
				@endforeach
			</div>
		@endif
	</div>
</div>