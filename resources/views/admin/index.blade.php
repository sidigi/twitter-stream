@extends('layouts.admin')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="text-center">
				<h1>#PRCRussiaCIS2018</h1>
			</div>
		</div>

		@if(auth()->check() && auth()->user()->hasRole('manager'))
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-3">

						<div class="tweet-list">
							@include('tweet.list-admin')
						</div>

					</div>
				</div>
			</div>
		@else
			@include('tweet.list')
		@endif
	</div>
@endsection