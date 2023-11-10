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

            {!! Form::open(['route' => 'admin.content.store','enctype' => 'multipart/form-data', 'class' => 'create-content-form']) !!}
                <div class="form-group {{ $errors->has('type') ? 'has-error' :'' }}">
                    <label for="type">Type of content</label>
                    <select name="type" id="type" class="form-control">
                        <option value="image">Image</option>
                        <option value="video">Video</option>
                    </select>
                    {!! $errors->first('type','<span class="help-block">:message</span>') !!}
                </div>

                <div class="form-group show-for for-image {{ $errors->has('image') ? 'has-error' :'' }}">
                    <label for="image">Image</label>
                    <input type="file" id="image" name="image">
                    <p class="help-block">jpeg,png,jpg,gif,svg</p>
                    {!! $errors->first('image','<span class="help-block">:message</span>') !!}
                </div>

                <div class="form-group show-for for-video {{ $errors->has('url') ? 'has-error' :'' }}">
                    <label for="url">Youtube video url</label>
                    <input type="text" class="form-control" name="url" placeholder="Youtube video url">
                    <p class="help-block">Example: https://www.youtube.com/watch?v=AXkL51pfQ0A</p>
                    {!! $errors->first('url','<span class="help-block">:message</span>') !!}
                </div>

                <div class="form-group {{ $errors->has('date_from') ? 'has-error' :'' }}">
                    <label for="url">Date from</label>
                    <input type="text" class="form-control date-input" name="date_from" placeholder="Date from" value="">
                    {!! $errors->first('date_from','<span class="help-block">:message</span>') !!}
                </div>

                <div class="form-group {{ $errors->has('date_to') ? 'has-error' :'' }}">
                    <label for="url">Date to</label>
                    <input type="text" class="form-control date-input" name="date_to" placeholder="Date to" value="">
                    {!! $errors->first('date_to','<span class="help-block">:message</span>') !!}
                </div>

                <button type="submit" class="btn btn-success">Submit</button>

            {!! Form::close() !!}

        </div>

    </div>
</div>
