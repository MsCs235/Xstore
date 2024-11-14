@extends('dashboard')
@section('content')

<div class="card">
   <div class="card-body">
        <!-- check if session return msg with view or not -->
        @if(Session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <!-- print msg -->
                {{Session()->get('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(Session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <!-- print msg -->
                {{Session()->get('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <!-- alert message div -->
       <h5>Your Orders</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Order number</th>
                    <th>Status</th>
                    <th>Total price</th>
                    <th>Products</th>
                    <th>Address</th>
                    <th>Create at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($item as $i)
                <tr>
                    <td>{{ $i->id }}</td>
                    <td>{{ $i->status }}</td>
                    <td>{{ $i->totalPrice }}</td>
                    <td>
                        @foreach ($i->Cart as $product )
                            {{$product->Product->title . ', '}}
                        @endforeach
                    </td>
                    <td>{{ $i->shippingAddress }}</td>
                    <td>{{ $i->created_at }}</td>
                    <td>
                        <a href="{{route('cancel.order', $i->id)}}">Cancel</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-block justify-content-center my-3">
        <!-- link -->
        </div>
   </div>
</div>


<div class="card">
   <div class="card-body">
       <h5>Requests</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Request number</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Customer</th>
                    <th>Address</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $r)
                <tr>
                    <td>{{ $r->id }}</td>
                    <td>{{ $r->Cart->Product->title }}</td>
                    <td>{{ $r->Cart->Product->price }}</td>
                    <td>{{ $r->user->name }}</td>
                    <td>{{ $r->user->address }}</td>
                    <td>{{ $r->created_at }}</td>
                    <td>
                        <a href="{{route('confirm.order', $r->cart_id)}}">Confirm</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-block justify-content-center my-3">
        <!-- link -->
        </div>
   </div>
</div>




@endsection
