@extends('dashboard')
@section('content')

<div class="card">
   <div class="card-body">
       <h5>Return orders Requests</h5>
        <table class="table">
            <tbody>

                <tr>
                    <td>User Name</td>
                    <td>{{$item->name}}</td>
                </tr>

                <tr>
                    <td>Phone</td>                  
                    <td>{{$item->phone}}</td>
                </tr>

                <tr>
                    <td>Address</td>
                    <td>{{$item->address}}</td>
                </tr>

                <tr>
                    <td>Email</td>
                    <td>{{$item->email}}</td>
                </tr>
                <tr>
                    <td>Auction</td>
                    <td>{{$item->title}}</td>
                </tr>

                <tr>
                    <td>Start Price</td>                  
                    <td>{{$item->startPrice}}</td>
                </tr>

                <tr>
                    <td>End Price</td>
                    <td>{{$item->Bid}}</td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>{{$item->status}}</td>
                </tr>

                <tr>
                    <td>Created at</td>
                    <td>{{$item->created_at}}</td>
                </tr>

                <tr>
                    <td>End Time</td>
                    <td>{{$item->EndTime}}</td>
                </tr>

            </tbody>
        </table>
        <div class="d-block justify-content-center my-3">
        <!-- link -->
        </div>
   </div>
</div>


@endsection