@extends('layout.app')

@section('content')
    <a class="btn btn-primary mb-3" href="createProduct">
        Add Product
    </a>
    <br>
    @foreach($products as $product)
        <div class="container py-3">
            <div class="card content">
                <div class="row ">
                    <div class="col-md-7 px-3">
                        <div class="card-block px-6">
                            <h4 class="card-title">{{$product -> title}}</h4>
                            <p class="card-text">
                                {{$product ->description}}
                            </p>
                            <br>
                            <a href="updateProduct/{{ $product->id }}" class="mt-auto btn btn-primary">Update</a>
                            <form method="POST" action="/deleteProduct/{{ $product->id }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="mt-auto btn btn-danger">Delete</button>
                            </form>
{{--                            <a href="{{ route('deleteProduct', [$product->id]) }}" class="mt-auto btn btn-danger">Delete</a>--}}
                        </div>
                    </div>
                    <!-- Carousel start -->
                    <div class="col-md-5">
                        <div id="CarouselTest" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#CarouselTest" data-slide-to="0" class="active"></li>
                                <li data-target="#CarouselTest" data-slide-to="1"></li>
                                <li data-target="#CarouselTest" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active card-img">
                                    <img class="d-block" src="https://i.pinimg.com/564x/94/ce/24/94ce241e898fb10ebdc375a4afa12342.jpg" alt="">
                                </div>
                                <div class="carousel-item card-img">
                                    <img class="d-block" src="https://i.pinimg.com/564x/b0/e3/dd/b0e3dd844d98e001ee694c5326d191c9.jpg" alt="">
                                </div>
                                <div class="carousel-item card-img">
                                    <img class="d-block" src="https://i.pinimg.com/564x/05/13/e8/0513e8efe11f49f41806284950fb6a5f.jpg" alt="">
                                </div>
                                <a class="carousel-control-prev" href="#CarouselTest" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#CarouselTest" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- End of carousel -->
                </div>
            </div>
            <br>
        </div>
    @endforeach
<br>
<br>
@endsection
