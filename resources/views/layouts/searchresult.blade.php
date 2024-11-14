@extends('application')
@section('content')


    <div class="container-fluid">
        <!-- <button class="btn-filt" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">ALL FILTERS</button> -->

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasRightLabel">
                    Filter & Sort
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
                <!--start first drop down button color-->
                <p class="d-inline-flex gap-1">
                    <a class="btn-size" data-bs-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Price
                    </a>
                </p>
                <div class="collapse" id="collapse1">
                    <div class="card card-body">
                        <form>
                            <input type="checkbox" id="pr1" name="pr1" value="pr1">
                            <label for="pr1"> EGP 0-200</label><br>
                            <input type="checkbox" id="pr2" name="pr2" value="pr2">
                            <label for="pr2"> EGP 200-600</label><br>
                            <input type="checkbox" id="pr3" name="pr3" value="pr3">
                            <label for="pr3"> EGP 600-1000</label><br>
                            <input type="checkbox" id="pr4" name="pr4" value="pr4">
                            <label for="pr4"> EGP 1000-more</label><br>
                        </form>
                    </div>
                </div>
                <!--end first drop down menu color-->
                <br>
                <!--start second drop list menu size-->
                <p class="d-inline-flex gap-1">
                    <a class="btn-size" data-bs-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Size
                    </a>
                </p>
                <div class="collapse" id="collapse2">
                    <div class="card card-body">
                        <form>
                            <input type="checkbox" id="xxs" name="xxsmall" value="xxs">
                            <label for="vehicle1"> XXS</label><br>
                            <input type="checkbox" id="XSmall" name="XSmall" value="XS">
                            <label for="vehicle2"> XS</label><br>
                            <input type="checkbox" id="Small" name="Small" value="small">
                            <label for="Small"> S</label>
                            <br>
                            <input type="checkbox" id="Medium" name="Medium" value="medium">
                            <label for="Medium"> M</label><br>
                            <input type="checkbox" id="Large" name="Large" value="Large">
                            <label for="Large"> L</label>
                            <br>
                            <input type="checkbox" id="XLarge" name="XLarge" value="XLarge">
                            <label for="XLarge"> XL</label>
                        </form>
                    </div>
                </div>
            
                <!-- end second drop list menu size-->
                <br>
                
                <!--start 3 drop list menu size-->
                <p class="d-inline-flex gap-1">
                    <a class="btn-size" data-bs-toggle="collapse" href="#collapse3" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Brand
                    </a>
                </p>

                <div class="collapse" id="collapse3">
                    <div class="card card-body">
                        @php
                            $i = 0 ;
                        @endphp
                        <form>
                            @foreach ( $products->unique('brand') as $p)
                                <input type="checkbox" name="{{'brand' . $i}}">
                                <label for="{{'brand' . $i}}"> {{ $p->brand }}</label><br>
                                @php
                                    $i = $i + 1 ;
                                @endphp
                            @endforeach
                        </form>
                    </div>
                </div>
                
                <!-- end 3 drop list menu size-->
            </div>
        </div>
    

        <div class="col">
            <div class="container-fluid text-center ">
                @if (count($products) != 0)
                    <h3 class="my-5 text-success">Products</h3>
                @else
                    <h3 class="my-5 text-danger">No products found</h3>
                @endif
                <div class="row row-cols-2 row-cols-md-4 g-4">
                    <!-- search result loop -->
                    @foreach ($products as $product)
                        <div class="col">
                            <div class="card h-100 w-75">
                                <img src="{{asset('imgs/products/' . $product->Product_imgs->first()->img_url)}}" class="card-img-top" width="75%" height="75%">
                                <div class="card-body">
                                    <h6 class="card-title">{{$product->title}}</h6>
                                    <h6 class="text-danger">
                                        Price : ${{ $product->price - (($product->price * $product->offer) / 100)}}
                                        @if ($product->offer)<sub class="card-text overview">Offer: %{{$product->offer}}</sub>@endif
                                    </h6>
                                    <a href="{{route('view.product', $product->Product_imgs->first()->img_url)}}" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- end loop -->
                </div>
            </div>
        </div>


        <div class="col mt-5">
            <div class="container-fluid text-center ">
                @if (count($auctions) != 0)
                    <h3 class="my-5 text-success">Auctions</h3>
                @endif
                
                <div class="row row-cols-2 row-cols-md-4 g-4">
                    <!-- search result loop -->
                    @foreach ($auctions as $auction)
                        <div class="col">
                            <div class="card h-100">
                                <img src="{{asset('imgs/auctions/' . $auction->Auction_imgs->first()->img_url)}}" class="card-img-top">
                                <div class="card-body">
                                    <h6>
                                        {{$auction->title}}
                                    </h6>
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
                                    <a href="{{route('view.product', $auction->Auction_imgs->first()->img_url)}}" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- end loop -->
                </div>
            </div>
        </div>

    </div>



@endsection