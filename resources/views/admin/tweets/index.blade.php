@extends('layouts.admin')

@section('content')
    <div class="row reload-page">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-3">

                    <div class="tweet-list">
                        <div class="row">
                            <div class="form-group" style="display: flex;justify-content: space-between;">
                                <a class="btn btn-primary reload">Reload</a>
                                <form id="delete-no-moderated" action="{{route('admin.tweets.delete-no-moderated')}}" method="post">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger">Delete no moderated tweets </button>
                                </form>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-2">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="auto-reload">
                                        <label class="form-check-label" for="auto-reload">Auto reload</label>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <label for="">Seconds
                                        <input type="number" class="form-control seconds" id="exampleInputPassword1" placeholder="Seconds" value="5">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="ajax-wr">
                            @foreach($tweets as $tweet)
                                <div data-moderate-url="{{ route('admin.tweets.moderate', $tweet) }}"
                                     data-tweet-id="{{$tweet->id}}"
                                     class="tweet card row @if (!$tweet->moderated) unread @endif" >
                                    <div class="col-xs-8">
                                        @include('admin.tweets.detail')
                                    </div>
                                    <div class="col-xs-4 approval">
                                        <form action="{{ route('admin.tweets.approve', $tweet) }}" method="post">
                                            <label class="radio-inline">
                                                <input
                                                        type="radio"
                                                        name="tweet"
                                                        value="{{ $tweet->id }}"
                                                        class="approve-action"
                                                        @if($tweet->approved)
                                                            checked="checked"
                                                        @endif
                                                >
                                                Approve
                                            </label>
                                        </form>

                                        <form action="{{ route('admin.tweets.unapprove', $tweet) }}" method="post">
                                            <label class="radio-inline">
                                                <input
                                                        type="radio"
                                                        name="tweet"
                                                        value="{{ $tweet->id }}"
                                                        class="approve-action"
                                                        @if(! $tweet->approved && $tweet->moderated)
                                                            checked="checked"
                                                        @endif
                                                >
                                                Unapprove
                                            </label>
                                        </form>

                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>

                                        <form action="{{ route('admin.tweets.destroy', $tweet) }}" method="delete">
                                            <input
                                                    type="hidden"
                                                    name="tweet"
                                                    value="{{ $tweet->id }}"
                                            >
                                            <a href="#" style="float: right" class="delete-tweet">Delete</a>
                                        </form>
                                    </div>
                                </div>
                            @endforeach

                            <div class="row">
                                {!! $tweets->links() !!}
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection