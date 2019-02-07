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

                                    @if($mode === \App\Models\Option\Option::IMAGES_MODE)
                                        value="{{\App\Models\Option\Option::TWEETS_MODE}}"
                                    @else
                                        value="{{\App\Models\Option\Option::IMAGES_MODE}}"
                                    @endif

                                    class="app-mode-image"
                                    @if($mode === \App\Models\Option\Option::IMAGES_MODE)
                                        checked="checked"
                                    @endif
                                > Show image instead tweets</label>
                        </div>
                    </form>
                </div>

                <br><br>

                <div class="images-list">
                    @foreach($images as $image)
                        <div class="card row">
                            <div class="col-xs-8">
                                <div class="media">
                                    <div class="media-left">
                                        <img class="img-thumbnail media-object" src="{{asset('storage/' . $image->path)}}" style="width: 350px">
                                    </div>
                                    <div class="media-body">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-4 approval">
                                <form action="{{ route('admin.background-image.active')}}" method="post">
                                    <label class="radio-inline">
                                        <input
                                                type="radio"
                                                name="id"
                                                value="{{$image->id}}"
                                                class="active-image"
                                                @if($image->active)
                                                    checked="checked"
                                                @endif
                                        >
                                        Active
                                    </label>
                                </form>

                                <form action="{{ route('admin.background-image.destroy', ['image' => $image])}}" method="delete">
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