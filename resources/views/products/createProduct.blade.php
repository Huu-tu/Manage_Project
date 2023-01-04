@extends('layout.app')

@section('content')
    <br>
    <div class="form-body">
    <form method="POST" action="/storeProduct"  class="form-create">
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" placeholder="Title -----">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea name="description" class="form-control" rows="5" placeholder="Description -----"></textarea>
        </div>
        @csrf
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
@endsection
