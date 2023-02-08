@extends('layout.app')

@section('content')
    <br>
    <div class="form-body">
        <form method="POST" action="/google-drive/file-upload" enctype="multipart/form-data" class="form-create">
            @csrf
            <div class="form-group">
                <label>File</label>
                <input type="file" name="file" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
