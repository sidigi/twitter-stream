@extends('layouts.admin')

@section('content')

    <div id="result">
        <div style="min-width: 600px; min-height: 600px; background: #ccc; text-align: center; vertical-align: middle">No tweets</div>
    </div><br>

    @if (\Session::has('success'))
        <div class="alert alert-success">
            <strong>Success!</strong> {!! \Session::get('success') !!}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Danger!</strong> {{$errors->first()}}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.tweet.store') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="tweet">Tweet</label>
            <input type="text" name="tweet" class="form-control" id="tweet" aria-describedby="tweet" placeholder="Enter tweet">
            <small id="tweet" class="form-text text-muted">Tweet URL or tweet ID. Example: https://twitter.com/BGSgroup_eu/status/1062229951502524416</small>
        </div>
        <button type="submit" class="btn btn-primary save-tweet" disabled>Save</button>
    </form>


    <script>
        $(function(){
            $(document).on('keyup', '#tweet', function(){
                let val = $(this).val();

                val = val.split('/').pop();

                $('.save-tweet').prop('disabled', true);

                if (val.length <= 3){
                    return;
                }

                $.ajax({
                    url: '/admin/tweet/' + val,
                    beforeSend: function() {
                        $('#result').css({
                            'opacity': '.2',
                        })
                    },
                    complete: function() {
                        $('#result').css({
                            'opacity': '1',
                        })
                    }
                })
                .fail(function () {
                    $('#result').html('<div style="min-width: 600px; min-height: 600px; background: #ccc; text-align: center; vertical-align: middle">No tweets</div>');
                })
                .done(function(data){
                    $('#result').html($(data).html());
                    $('.save-tweet').prop('disabled', false);
                });
            })
        });
    </script>
@endsection