@extends('application')

@section('content')

    <!-- product details -->
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6 h-75">
                <div class="main-photo zoom">
                    <img src="{{asset('imgs/products/' . $item->product_imgs->first()->img_url)}}">
                </div>
                <div class="sub-photo">
                    <!-- loop -->
                    @foreach ($item->product_imgs as $img)
                        <img src="{{asset('imgs/products/' . $img->img_url)}}">
                    @endforeach
                </div>
            </div>

            <div class="col-md-6 p-x-2px">
                <div class="card border-0" style="width: 100%;">
                    <div class="card-body p-x-2px">
                        <h3 class="card-title text-center my-3">{{$item->title}}</h3>
                        <h4 class="card-subtitle mb-4 text-center text-danger">
                            ${{ $item->price - (($item->price * $item->offer) / 100)}} 
                            @if ($item->offer)
                                <del style="color:grey;"> {{$item->price}} </del>
                            @endif   
                        </h4>
                        
                        <div class="align-items-center">
                            <form action="{{route('add.product', $item->id)}}" method="post">
                                @csrf
                                <div class="col-md-12 my-2">
                                    <div class="col-12 input-group">
                                        <input  type="hidden" value="{{ $item->price - (($item->price * $item->offer) / 100)}}" name="price">
                                        <input class="form-control col-2 " type="number" value="" min="1" max="5" name="qty" id="qty" placeholder="quantity">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <input type="submit" class="btn btn-dark w-100 mb-2" value="Add to cart">
                                </div>

                                
                            </form>
                        </div>

                        <div class="accordion mb-3" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    <strong>Product Details</strong>
                                </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Brand Name</td>
                                                    <td>{{$item->brand}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Category</td>
                                                    <td>{{$item->category}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Stock</td>
                                                    <td>{{$item->stock}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Offer</td>
                                                    <td>
                                                        @if ($item->offer)
                                                            %{{$item->offer}}
                                                        @else
                                                            {{'No'}}
                                                        @endif
                                                        
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    <strong>Product Description</strong>
                                </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <strong>About this item</strong>
                                        <p>{{$item->description}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- review -->
    <div class="container my-5">

        @if (count($review) != 0)
            <h3 class="my-5 txet-center">Reviews</h3>
        @endif

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          Write Review
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Write Review</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="{{ route('review.submit' , $item->id) }}" method="post">
                  @csrf
                  <div class="form-group row">
                      <label for="inputExperience" class="col-sm-2 col-form-label">Comment</label>
                      <div class="col-sm-10">
                          <textarea class="form-control" name="comment"  id="inputExperience" placeholder="Comment"></textarea>
                      </div>
                  </div>
                  <div class="rating">
                    <label>
                      <input type="radio" name="star" value="1" />
                      <span class="icon">★</span>
                    </label>
                    <label>
                      <input type="radio" name="star" value="2" />
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                    </label>
                    <label>
                      <input type="radio" name="star" value="3" />
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                      <span class="icon">★</span>   
                    </label>
                    <label>
                      <input type="radio" name="star" value="4" />
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                    </label>
                    <label>
                      <input type="radio" name="star" value="5" />
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                      <span class="icon">★</span>
                    </label>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        
        <div class="card-container mt-2">
          @foreach ( $review as $r )

            <div class="card h-100 card-scroll border bg-light">
                <div class="card-body">
                  <h5 class="card-title">{{$r->user->name}}</h5>
                  <p class="card-text overview">{{$r->comment}}</p>
                  <form class="rating">
                      <label>
                        <input type="radio" name="star" value="1" @if ($r->star == 1) {{'checked'}} @endif disabled/>
                        <span class="icon">★</span>
                      </label>
                      <label>
                        <input type="radio" name="star" value="2" @if ($r->rating == 2) {{'checked'}} @endif disabled/>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                      </label>
                      <label>
                        <input type="radio" name="star" value="3" @if ($r->rating == 3) {{'checked'}} @endif disabled/>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>   
                      </label>
                      <label>
                        <input type="radio" name="star" value="4" @if ($r->rating == 4) {{'checked'}} @endif disabled/>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                      </label>
                      <label>
                        <input type="radio" name="star" value="5" @if ($r->rating == 5) {{'checked'}} @endif disabled/>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                        <span class="icon">★</span>
                      </label>
                  </form>
                </div>
            </div>
          @endforeach
        </div>
    </div>
    <!-- end review -->
    

    

@endsection