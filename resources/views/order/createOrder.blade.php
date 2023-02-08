@extends('layout.app')

@section('content')
    <br>
    <div class="form-body">
        <form method="POST" action="/storeOrder"  class="form-create">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Title -----">
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea name="description" class="form-control" rows="5" placeholder="Description -----"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
