@extends('dashboard')

@section('content')
  <div class="card emp-card">
    <div class="card-body">
        <!-- using (enctype="multipart/form-data) when want to submit files -->
        <form action="{{route('update.auction' , $item->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}} <!-- SQL-injaction attake and CSRF attake -->
          <input type="text" name="title" placeholder="Auction Title" value="{{$item->title}}" class="form-control mb-3 required" >
          <div class="error"></div>
          
          <textarea type="text" name="description" placeholder="Description" class="form-control mb-3 required" >{{$item->description}}</textarea>
          <div class="error"></div>

          <input type="number" name="startprice" placeholder="Start Price" value="{{$item->startPrice}}" class="form-control mb-3 required" >
          <div class="error"></div>

          <input type="text" name="category" placeholder="Category" value="{{$item->category}}" class="form-control mb-3 required" >
          <div class="error"></div>

          <input type="text" name="initialBid" placeholder="Initial Bid" value="{{$item->initialBid}}" class="form-control mb-3 required" >
          <div class="error"></div>

          <select class="form-select mb-3 required" name="status" id="inputGroupSelect04" aria-label="Example select with input addon">
              <option value="Open" @if ($item->status == 'Open') {{'selected'}} @endif >Open</option>
              <option value="Close" @if ($item->status == 'Close') {{'selected'}} @endif >Close</option>
          </select>
          <div class="error"></div>

          <label>Select End Date:</label><br>
          <input type="datetime-local" name="EndTime" placeholder="End Time" value="{{$item->EndTime}}" class="form-control mb-3 required" >
          <div class="error"></div>

          <label>Uplaod new images for your item here:</label><br>
          <input type="file" accept="image/*"   name="photos[]"  class="form-control mb-1" multiple >

          <button type="submit" class="btn btn-primary mt-3">Edite Auction</button>
        </form>
    </div>
  </div>
@endsection