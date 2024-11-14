@extends('dashboard')
@section('content')

<div class="card">
   <div class="card-header">
   <a href="{{route('createauction')}}" class="btn btn-primary">Add Auction</a>
   </div>
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
      <table class="table">
          <thead>
             <tr>
                <th>Auction Name</th>
                <th>Initial Bid</th>
                <th>Start Bid</th>
                <th>Last Bid</th>
                <th>Created at</th>
                <th>End Time</th>
                <th>Status</th>
                <th>View</th>
                <th>Edite/Delete</th> 
             </tr>
          </thead>
          <tbody>
            @foreach ( $item as $i )
               @if ($i->status == 'Open')
                  <tr>
                     <td>{{$i->title}}</td>
                     <td>{{$i->initialBid}}</td>
                     <td>{{$i->startPrice}}</td>
                     <td>{{$i->Bid}}</td>
                     <td>{{$i->created_at}}</td>
                     <td>{{$i->EndTime}}</td>
                     <td>{{$i->status}}</td>
                     <td>
                        <a href="{{route('view.auction', $i->Auction_imgs->first()->img_url)}}">Auction Page</a>
                     </td>
                     <td>
                     <a href="{{ route('display.auction', $i->id) }}" class="btn btn-primary">Edite</a>
                     <a href="{{ route('delete.auction', $i->id) }}" class="btn btn-danger">Delete</a>
                     </td>
                  </tr>
               @endif
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
         <h5>End Auctions</h5>
         <table class="table">
            <thead>
               <tr>
                  <th>Auction Name</th>
                  <th>Initial Bid</th>
                  <th>Start Bid</th>
                  <th>Last Bid</th>
                  <th>Created at</th>
                  <th>End Time</th>
                  <th>Status</th>
                  <th>Details</th>
               </tr>
            </thead>
            <tbody>
               @foreach ( $item as $i )
                  @if ($i->status == 'Close')
                     <tr>
                        <td>{{$i->title}}</td>
                        <td>{{$i->initialBid}}</td>
                        <td>{{$i->startPrice}}</td>
                        <td>{{$i->Bid}}</td>
                        <td>{{$i->created_at}}</td>
                        <td>{{$i->EndTime}}</td>
                        <td>{{$i->status}}</td>
                        <td>
                           <a href="{{route('auction.details', $i->id)}}">view Details</a>
                        </td>

                     </tr>
                  @endif
               @endforeach
            </tbody>
         </table>
        <div class="d-block justify-content-center my-3">
        <!-- link -->
        </div>
   </div>
</div>

@endsection
