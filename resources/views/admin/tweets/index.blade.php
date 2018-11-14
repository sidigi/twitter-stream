@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-3">

                    <div class="tweet-list">

                        <div class="row">
                            <div class="form-group">
                                <a class="btn btn-primary reload">Reload</a>
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
                                     class="tweet row @if (!$tweet->moderated) unread @endif" >
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

    <script>
        const token = $('meta[name="csrf-token"]').attr('content');

        var reload = function(){
            $.ajax({
                url: location.href,
                beforeSend: function() {
                    $('.ajax-wr').css({
                        'opacity': '.2',
                    })
                },
                complete: function() {
                    $('.ajax-wr').css({
                        'opacity': '1',
                    })
                }
            })
                .done(function(data){
                    var domStr = '.ajax-wr',
                        response = $(data).find(domStr);

                    $(domStr).html(response.html());
                });
        };

        $(function(){
            if (localStorage.getItem('autoReload')){
                $('#auto-reload').prop('checked', true);
            }

            $(document).on('click', '.reload', function(event){
                event.preventDefault();
                reload();
            });

            var seconds = $('.seconds').val();
            var interval = setInterval(function(){
                if ($('#auto-reload').prop('checked')){
                    reload();
                }
            }, seconds * 1000);

            $(document).on('keyup', '.seconds', function(event){
                seconds = parseInt($(this).val()) || 1;

                clearInterval(interval);
                interval = setInterval(function(){
                    if ($('#auto-reload').prop('checked')){
                        reload();
                    }
                }, seconds * 1000);
            });

            $(document).on('change', '#auto-reload', function(event){
                var _this = $(this);

                if (_this.prop('checked')){
                    localStorage.setItem('autoReload', 'true');
                }else{
                    localStorage.setItem('autoReload', '');
                }

            });

            $(document).on('change', '.approve-action', function(event){
                event.preventDefault();

                var _this = $(this),
                    form = _this.closest('form'),
                    tweet = _this.closest('.tweet');

                _this.closest('.tweet').removeClass('unread');
                _this.closest('.tweet').find('input[type="radio"]').prop('checked', false);
                _this.prop('checked', true);

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize() + '&_token=' + token,
                    beforeSend: function() {
                        _this.closest('.tweet').css({
                            'opacity': '.1',
                        })
                    },
                    complete: function() {
                        _this.closest('.tweet').css({
                            'opacity': '1',
                        })
                    }
                })
                .done(function(){
                    $.ajax({
                        url: tweet.attr('data-moderate-url'),
                        type: 'post',
                        data: {
                            _token : token,
                            tweet : tweet.attr('data-tweet-id'),
                        },
                    })
                });

                return false;
            });

            $(document).on('click', '.delete-tweet', function(event){
                if (confirm('Are you shure?')){
                    var
                        _this = $(this),
                        tweet = _this.closest('.tweet'),
                        form = _this.closest('form');

                    $.ajax({
                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: form.serialize() + '&_token=' + token,
                        beforeSend: function() {
                            tweet.css({
                                'opacity': '.1',
                            })
                        },
                        complete: function() {
                            tweet.remove();
                        }
                    })
                }
                event.preventDefault();
            });

        });
    </script>
@endsection

