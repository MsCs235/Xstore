@extends('application')

@section('content')

    <!-- product details -->
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <div class="main-photo zoom">
                    <img src="{{asset('imgs/auctions/' . $item->Auction_imgs->first()->img_url)}}">
                </div>
                <div class="sub-photo">
                    @foreach ($item->Auction_imgs as $img)
                        <img src="{{asset('imgs/auctions/' . $img->img_url)}}">
                    @endforeach
                    
                </div>
            </div>

            <div class="col-md-6 p-x-2px">
                <div class="card border-0" style="width: 100%;">
                    <div class="card-body p-x-2px">
                        <h3 class="card-title text-center my-3">{{$item->title}}</h3>
                        <h4 class="card-subtitle mb-4 text-center">Price: 
                            <small class="text-danger">
                                @if ($item->Bid == 0)
                                    {{$item->startPrice}} EG
                                @else
                                    {{$item->Bid}} EG
                                @endif
                            </small> &nbsp;&nbsp; 
                            Initial Bid: <small class="text-danger">{{$item->initialBid}} EG</small>
                        </h4>
                        
                        <div class="align-items-center">
                            <form action="{{route('add.bid',$item->id)}}" method="post">
                                @csrf
                                <div class="col-12">
                                    <input  type="hidden" value="{{$item->Bid }}" name="lastbid">
                                    <input  type="hidden" value="{{$item->initialBid}}" name="initialbid">
                                    <input  type="hidden" value="{{$item->startPrice}}" name="startPrice">
                                    <input type="submit" class="btn btn-dark w-100 mb-2" value="Add your Bid">
                                </div>
                            </form>
                        </div>

                        <div class="accordion mb-3" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    <strong>Auction Details</strong>
                                </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Title</td>
                                                    <td>{{$item->title}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Categore</td>
                                                    <td>{{$item->category}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Start Price</td>
                                                    <td>{{$item->startPrice}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Create at</td>
                                                    <td>{{$item->created_at}}</td>
                                                </tr>
                                                <tr>
                                                    <td>End Time</td>
                                                    <td>{{$item->EndTime}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Status</td>
                                                    <td>{{$item->status}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    <strong>Auction Description</strong>
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
@endsection