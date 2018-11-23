@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-3">
                <div class="comtrol-panel">
                    <form action="{{ route('admin.app.change-mode')}}" method="post">
                        <div class="checkbox">
                            <label>
                                <input
                                    type="checkbox"
                                    name="mode"

                                    @if($appMode === 'image')
                                        value="tweet-list"
                                    @else
                                        value="image"
                                    @endif

                                    class="app-mode-image"
                                    @if($appMode === 'image')
                                        checked="checked"
                                    @endif
                                > Show image instead tweets</label>
                        </div>
                    </form>
                </div>

                <br><br>

                <div class="images-list">
                    @foreach($files as $file)
                        <div class="card row">
                            <div class="col-xs-8">
                                <div class="media">
                                    <div class="media-left">
                                        <img class="img-thumbnail media-object" src="{{$file->pathname}}" style="width: 350px">
                                    </div>
                                    <div class="media-body">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-4 approval">
                                <form action="{{ route('admin.background-image.active-image')}}" method="post">
                                    <label class="radio-inline">
                                        <input
                                                type="radio"
                                                name="pathname"
                                                value="{{$file->pathname}}"
                                                class="active-image"
                                                @if($file->active)
                                                checked="checked"
                                                @endif
                                        >
                                        Active
                                    </label>
                                </form>

                                <form action="{{ route('admin.background-image.delete-image')}}" method="delete">
                                    <input
                                            type="hidden"
                                            name="pathname"
                                            value="{{$file->pathname}}"
                                    >
                                    <a href="#" style="float: right" class="delete-image">Delete</a>
                                </form>
                            </div>

                            <hr>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection