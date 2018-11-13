@extends('layouts.admin')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="text-center">
				<h1>#PRCRussiaCIS2018</h1>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-3">

					<div class="tweet-list">
						@include('admin.tweet.list')
					</div>

				</div>
			</div>
		</div>
	</div>
@endsection