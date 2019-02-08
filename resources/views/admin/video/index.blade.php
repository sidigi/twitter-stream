@extends('layouts.admin')

@section('content')
    @include('admin.video.parts.create')
    <br>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-3">
                <div class="images-list">
                    @foreach($videos as $video)

                        <div class="card row">
                            <div class="col-xs-8">
                                <div class="media">
                                    <div class="media-left">
                                        <iframe id="video_{{$video->id}}" src="http://www.youtube.com/embed/{{ $video->videoId }}" frameborder="0"/>
                                    </div>
                                    <div class="media-body">

                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-4 approval">
                                <form action="{{ route('admin.video.destroy', ['video' => $video])}}" method="delete">
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