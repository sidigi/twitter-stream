@extends('layouts.admin')

@section('content')
    <div class="row twitter-answer">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-3">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <strong>Success!</strong> {!! \Session::get('success') !!}. See on <a href="{{ route('admin.tweets.index') }}">Tweets</a>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <strong>Danger!</strong> {{$errors->first()}}
                        </div>
                    @endif

                    <form method="POST"
                          action="{{ route('admin.tweets.store') }}"
                          data-get-tweet-url="{{ route('admin.api.twitter.tweet.show', '#') }}"
                    >

                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="tweet">Tweet</label>
                            <input type="text" name="tweet" class="form-control" id="tweet" aria-describedby="tweet" placeholder="Enter tweet">
                            <small id="tweet" class="form-text text-muted">Tweet URL or tweet ID. Example: https://twitter.com/BGSgroup_eu/status/1062229951502524416</small>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input name="approve" type="checkbox" class="form-check-input" id="approve">
                                <label class="form-check-label" for="approve">Approve after save</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary save-tweet" disabled>Save</button>
                    </form>

                    <br>

                    <div class="tweet-list">
                        <div class="tweet card row" >
                            <div class="col-xs-8">
                                <div id="result">No tweets was found</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection