<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-3">

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

            {!! Form::open(['route' => 'admin.video.store','enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    <label for=""></label>
                    <input type="text" name="url" class="form-control" id="url" aria-describedby="url" placeholder="Enter url">
                    <small id="url" class="form-text text-muted">Youtube URL Example: https://www.youtube.com/watch?v=AXkL51pfQ0A</small>
                </div>

                <button type="submit" class="btn btn-success">Submit</button>
            {!! Form::close() !!}

        </div>

    </div>
</div>
