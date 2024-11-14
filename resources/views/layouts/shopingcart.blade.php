@extends('application')

@section('content')


 <!-- big div -->
        <div class="d-flex justify-content-around scard">
            <!-- small div-1 -->
            <div class="left-side">
                @foreach ($items as $i)
                    <div class="mt-3 border p-3">
                        <div class="row py-3">
                            <div class="col-8 row">
                                <img class="col-4 productimg" src="{{asset('imgs/products/' . $i->Product->Product_imgs->first()->img_url)}}" width="75%">
                                <div class="col-6">
                                    <p><strong>Title:</strong> {{$i->Product->title}}</p>
                                    <p><strong>Brand:</strong> {{$i->Product->brand}}</p>
                                    <p><strong>Category:</strong> {{$i->Product->category}}</p>
                                </div>
                            </div>
                            <div class="col-2">
                                <p><strong>Qty:</strong> {{$i->qty}}</p> 
                            </div>
                            <div class="col-2">
                                <h3>${{$i->price}}</h3>
                                <p>
                                    @if ($i->Product->offer)
                                        Offer: %{{$i->Product->offer}}
                                    @endif
                                </p>
                            </div>
                        </div>
            
                        <div class="d-flex justify-content-end">
                            
                            <a href="{{ route('delete.cart', $i->id) }}"  class="link">Remove</a>    
                        </div>
                    </div>
                @endforeach 
            </div> 

            <div class="right-side">
                @php
                    $num = 1 ;
                    $num2 = 1;
                    $total_price = 0 ; 
                @endphp
                @foreach ($items as $i )
                    <div class="d-flex justify-content-between">
                        <p class="my-0">item ({{$num}})</p>
                        <p class="my-0">${{$i->price * $i->qty}}</p>
                    </div>
                    @php
                        $num = $num + 1 ;
                        $total_price = $total_price + ($i->price * $i->qty) ;
                    @endphp
                @endforeach
                <hr>
                <div class="d-flex justify-content-between mb-2">
                    <h3>Total</h3>
                    <h3>${{$total_price}}</h3>
                </div>
                <div class="d-flex justify-content-center">
                    <p><i class="fa-solid fa-sack-dollar"></i> Purchase protected by<strong> Xstore </strong> </p>
                </div>

                <form action="{{ route('make.order') }}" method="get">
                    @csrf
                    @foreach ($items as $i )
                        <input  type="hidden" value="{{ $i->Product->title}}" name="{{'product'. $num2}}"> 
                        <input  type="hidden" value="{{ $i->cart_num}}" name="cart_num"> 
                        @php
                        $num2 = $num2 + 1 ;
                        @endphp
                    @endforeach
                    <input  type="hidden" value="{{ $total_price}}" name="total_price">
                    @auth
                        @if (Auth::user()->address)
                            <input type="submit" value="Check Out" class="btn btn-dark py-2">
                        @else
                            <input type="submit" value="Please complete your profile info." class="btn btn-dark py-2" disabled>
                        @endif
                    @endauth                   
                </form>

            </div>    
        </div>

@endsection