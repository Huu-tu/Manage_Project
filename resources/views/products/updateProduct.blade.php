@extends('layout.app')

@section('content')
    <br>
    <div class="form-body">
        <form method="POST" action="/editProduct/{{ $product ->id }}"  class="form-create">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{$product ->title}}">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
{{--                <input type="text" name="description" class="form-control" value="{{$product ->description}}">--}}
                <textarea name="description" class="form-control" rows="5">{{$product ->description}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
