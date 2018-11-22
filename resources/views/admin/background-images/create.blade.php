@extends('layouts.admin')

@section('content')
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

    {!! Form::open(array('route' => 'fileUpload','enctype' => 'multipart/form-data')) !!}
    <div class="row cancel">
        <div class="col-md-4">
            {!! Form::file('image', array('class' => 'image')) !!}
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-success">Create</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection