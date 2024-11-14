@extends('dashboard')
@section('content')

<div class="card">
   <div class="card-body">
       <h5>Return orders Requests</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Request number</th>
                    <th>Order id</th>
                    <th>Description</th>
                    <th>status</th>
                    <th>Created at</th>
                </tr>
            </thead>
            <tbody>
                @foreach($item as $r)
                <tr>
                    <td>{{ $r->id }}</td>
                    <td>{{ $r->order_id }}</td>
                    <td>{{ $r->description }}</td>
                    <td>{{ $r->status }}</td>
                    <td>{{ $r->created_at }}</td>
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
