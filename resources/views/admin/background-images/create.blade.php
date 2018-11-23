@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">

            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <strong>Success!</strong> {!! \Session::get('success') !!}. See on <a href="{{ route('admin.background-images.index') }}">Backgrounds</a>
                </div>
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::open(['route' => 'admin.background-image.file-upload','enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    <label for="">Загрузите изображение</label>
                    {!! Form::file('image', ['class' => 'image']) !!}
                </div>

                <button type="submit" class="btn btn-success">Submit</button>
            {!! Form::close() !!}

        </div>
    </div>
@endsection