@extends('layouts.admin')

@section('content')
    @include('admin.content.parts.create')
    <hr>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-3">
                <div class="images-list">
                    @foreach($content as $item)
                        <div class="card row">
                            <div class="col-xs-8">
                                <div class="media">
                                    <div class="media-left">
                                        @include('admin.content.parts.lists.' . $item->type, ['item' => $item->content])
                                    </div>

                                    <div class="media-body">
                                        <div>
                                            Date from:{{ $item->date_from }}
                                        </div>

                                        <div>
                                            Date to:{{ $item->date_to }}
                                        </div>

                                        @if($item->showing)
                                            <div>
                                                <br>
                                                <span class="text-success">Showing now</span>
                                            </div>
                                        @endif

                                    </div>

                                </div>
                            </div>

                            <div class="col-xs-4 approval">
                                <form action="{{ route('admin.content.mark-default', $item) }}" method="POST">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="default" value="1" class="mark-default" {{($item->default) ? 'checked="checked"': ''}} > Mark as default
                                            </label>
                                        </div>
                                        {!! $errors->first('date_to','<span class="help-block">:message</span>') !!}
                                    </div>
                                </form>

                                <a href="{{ route('admin.content.edit', $item) }}" style="float: right">Edit</a><br>

                                <br>
                                <br>
                                <br>
                                <br>

                                <form action="{{ route('admin.content.destroy', $item) }}" method="delete">
                                    <a href="#" style="float: right" class="delete-content">Delete</a>
                                </form>
                            </div>

                        </div>

                    @endforeach

                    <div class="row">
                        {!! $content->links() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection