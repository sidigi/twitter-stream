<div class="page-wrapper">
	<div class="col-md-6">
		<div class="posts">
			@if($mainTweet)
				<div class="post">
					<div class="post-header">
						<div class="user">
							<div class="img">
								<img src="{{ $mainTweet->user_avatar_url }}"
								     alt="">
								<div class="name">{{ $mainTweet->user_screen_name }}</div>
								<div class="created">{{ $mainTweet->created_at->diffForHumans() }}</div>

							</div>
						</div>
					</div>
					<div class="post-body">
						<p>
							{{ $mainTweet->tweet_text }}
						</p>
					</div>
					@if($mainTweet->media)
						<div class="post-media">
							@foreach($mainTweet->media as $media)
								<img src="{{ $media['media_url'] }}" alt="">
							@endforeach
						</div>
					@endif
				</div>
			@endif
			@if($subTweet)
				<div class="post">
					<div class="post-header">
						<div class="user">
							<div class="img">
								<img src="{{ $subTweet->user_avatar_url }}"
								     alt="">
								<div class="name">{{ $subTweet->user_screen_name }}</div>
								<div class="created">{{ $subTweet->created_at->diffForHumans() }}</div>
							</div>
						</div>
					</div>
					<div class="post-body">
						<p>
							{{ $subTweet->tweet_text }}
						</p>
					</div>
				</div>
			@endif
		</div>
	</div>

	<div class="col-md-6">
		<div class="posts">
			@foreach($tweets as $tweet)
				<div class="post">
					<div class="post-header">
						<div class="user">
							<div class="img">
								<img src="{{ $tweet->user_avatar_url }}"
								     alt="">
								<div class="name">{{ $tweet->user_screen_name }}</div>
								<div class="created">{{ $tweet->created_at->diffForHumans() }}</div>

							</div>
						</div>
					</div>
					<div class="post-body">
						<p>
							{{ $tweet->tweet_text }}
						</p>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</div>

<script>
    var seconds = 5;
    setInterval(function(){
        $.ajax({
	        url: location.href,
        }).done(function(data){
			$('.page-wrapper').html($(data).find('.page-wrapper').html())
        });
    }, seconds * 1000);
</script>