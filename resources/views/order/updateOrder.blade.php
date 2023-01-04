@extends('layout.app')

@section('content')
    <br>
    <div class="form-body">
        <form method="POST" action="/updateOrder/{{ $order ->id }}"  class="form-create">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{$order ->name}}">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
                {{--                <input type="text" name="description" class="form-control" value="{{$product ->description}}">--}}
                <textarea name="description" class="form-control" rows="5">{{$order ->description}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
