@extends('dashboard')
@section('content')

<div class="alert alert-info" role="alert">
    <strong>Note:</strong> This page is for sellers only. Please ensure you are authorized to view and manage orders.
</div>


<div class="card">
   <div class="card-body">
       <h5>Your Received Orders</h5>
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
                @foreach($received as $i)
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
                            @if ($i->status == 'delivered')
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Return Order
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Why need to return..?</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('return.order', $i->id) }}" method="post">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <div class="col-sm-10">
                                                            <textarea class="form-control" name="comment"  id="inputExperience" placeholder="Comment"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Confirm</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <p>Wait Confirm</p>
                            @endif
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

