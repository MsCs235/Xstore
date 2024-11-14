@extends('application')

@section('content')

    <!-- Trending Products -->
    <div class="main-title my-4 mx-md-5 position-relative">
        <h3 class="m-3">Trending Now</h3>
        <!--cards-->
        <div class="card-container mt-2">
            @foreach ($products as $product)
                <div class="card h-100 card-scroll border bg-light shadow" style="max-width: 18rem;">
                    <img src="{{asset('imgs/products/' . $product->img_url)}}" class="card-img-top" alt="{{$product->title}}" style="height: 200px; object-fit: cover; width: 100%;">
                    <div class="card-body">
                        <h6 class="card-title">{{$product->title}}</h6>
                        <h6 class="text-danger">
                            Price : ${{ $product->price - (($product->price * $product->offer) / 100)}}
                            @if ($product->offer)<sub class="card-text overview">Offer: %{{$product->offer}}</sub>@endif
                        </h6>
                        <a href="{{route('view.product', $product->img_url)}}" class="stretched-link"></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Offers -->
    <div class="main-title my-4 mx-md-5 position-relative">
        <h3 class="m-3">Offers</h3>
        <!--cards-->
        <div class="card-container mt-2">
            @foreach ($offers as $product)
                <div class="card h-100 card-scroll border bg-light shadow" style="max-width: 18rem;">
                    <img src="{{asset('imgs/products/' . $product->img_url)}}" class="card-img-top" alt="{{$product->title}}" style="height: 200px; object-fit: cover; width: 100%;">
                    <div class="card-body">
                        <h6 class="card-title">{{$product->title}}</h6>
                        <h6 class="text-danger">
                            Price : ${{ $product->price - (($product->price * $product->offer) / 100)}}
                            @if ($product->offer)<sub class="card-text overview">Offer: %{{$product->offer}}</sub>@endif
                        </h6>
                        <a href="{{route('view.product', $product->img_url)}}" class="stretched-link"></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Auctions -->
    <div class="main-title my-4 mx-md-5 position-relative">
        <h3 class="m-3">Auctions</h3>
        <!--cards-->
        <div class="card-container mt-2">
            @foreach ($auctions as $auction)
                <div class="card h-100 card-scroll border bg-light shadow" style="max-width: 18rem;">
                    <img src="{{asset('imgs/auctions/' . $auction->img_url)}}" class="card-img-top" alt="{{$auction->title}}" style="height: 200px; object-fit: cover; width: 100%;">
                    <div class="card-body">
                        <h6 class="card-title">{{$auction->title}}</h6>
                        <h6 class="text-danger">
                            Price : 
                            @if ($auction->Bid == 0)
                                {{$auction->startPrice}}  
                            @else
                                {{$auction->Bid}}   
                            @endif 
                        </h6>
                        <h6 class="text-danger">
                            Initial Bid : {{$auction->initialBid}}
                        </h6>
                        <a href="{{route('view.auction', $auction->img_url)}}" class="stretched-link"></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Footer -->
    <div class="mt-5">
        <a href="#" class="btn w-100 btn-dark rounded-0" role="button" aria-disabled="true">Back to top</a>
        <footer class="text-center w-100 bg-body-tertiary py-4">
            <!-- Grid container -->
            <div class="container">
            <!-- Section: Social media -->
            <section class="mb-4">
                <!-- Facebook -->
                <a
                data-mdb-ripple-init
                class="btn btn-link btn-floating btn-lg text-body m-1"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fab fa-facebook-f"></i
                ></a>

                <!-- Twitter -->
                <a
                data-mdb-ripple-init
                class="btn btn-link btn-floating btn-lg text-body m-1"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fab fa-twitter"></i
                ></a>

                <!-- Google -->
                <a
                data-mdb-ripple-init
                class="btn btn-link btn-floating btn-lg text-body m-1"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fab fa-google"></i
                ></a>

                <!-- Instagram -->
                <a
                data-mdb-ripple-init
                class="btn btn-link btn-floating btn-lg text-body m-1"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fab fa-instagram"></i
                ></a>

                <!-- Linkedin -->
                <a
                data-mdb-ripple-init
                class="btn btn-link btn-floating btn-lg text-body m-1"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fab fa-linkedin"></i
                ></a>
                <!-- Github -->
                <a
                data-mdb-ripple-init
                class="btn btn-link btn-floating btn-lg text-body m-1"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fab fa-github"></i
                ></a>
            </section>
            <!-- Section: Social media -->
            </div>
            <!-- Grid container -->

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 Copyright:
            <a class="text-body" href="#">Xstore.com</a>
            </div>
            <!-- Copyright -->
        </footer>
    </div>

@endsection
