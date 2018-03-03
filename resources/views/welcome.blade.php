@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="text-center">
				<h1>#EPOCH2018</h1>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-3">

				<div class="tweet-list">
					@if(auth()->check() && auth()->user()->hasRole('manager'))
						@include('tweets.list-admin')
					@else
						@include('tweets.list')
					@endif
				</div>

			</div>
		</div>
	</div>
@endsection