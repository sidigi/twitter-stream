@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-3">

                <div class="alert alert-info">
                    Now: {{ \Carbon\Carbon::now() }}
                </div>

                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {!! \Session::get('success') !!}. See on <a href="{{ route('admin.content.index') }}">Backgrounds</a>
                    </div>
                @endif

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.
                    </div>
                @endif

                @include('admin.content.parts.lists.' . $content->type, ['item' => $content->content])
                <br>

                <form action="{{ route('admin.content.update', $content) }}" method="POST" class="update-content-form">
                    @csrf
                    @method('PUT')

                    <div class="form-group {{ $errors->has('date_from') ? 'has-error' :'' }}">
                        <label for="url">Date from</label>
                        <input type="text" class="form-control date-input" name="date_from" placeholder="Date from" value="{{$content->date_from->format('Y-m-d H:i:s')}}">
                        {!! $errors->first('date_from','<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group {{ $errors->has('date_to') ? 'has-error' :'' }}">
                        <label for="url">Date to</label>
                        <input type="text" class="form-control date-input" name="date_to" placeholder="Date to" value="{{$content->date_to->format('Y-m-d H:i:s')}}">
                        {!! $errors->first('date_to','<span class="help-block">:message</span>') !!}
                    </div>

                    <button type="submit" class="btn btn-success">Submit</button>

                </form>

            </div>

        </div>
    </div>
@endsection