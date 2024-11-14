@extends('dashboard')

@section('content')
  <div class="card emp-card">
    <div class="card-body">
         <!-- using (enctype="multipart/form-data) when want to submit files -->
        <form action="{{route('update.product' , $item->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}} <!-- SQL-injaction attake and CSRF attake -->
          <input type="text" name="title" placeholder="Product Title" value="{{$item->title}}" class="form-control mb-3 required" >
          <div class="error"></div>
          
          <textarea type="text" name="description" placeholder="Description" class="form-control mb-3 required" >{{$item->description}}</textarea>
          <div class="error"></div>

          <input type="text" name="price" placeholder="Price" value="{{$item->price}}" class="form-control mb-3 required" >
          <div class="error"></div>

          <input type="number" name="offer" placeholder="Offer Ex: 10%" value="{{$item->offer}}" class="form-control mb-3 required" >
          <div class="error"></div>

          <input type="text" name="category" placeholder="Category" value="{{$item->category}}" class="form-control mb-3 required" >
          <div class="error"></div>

          <input type="text" name="brand" placeholder="Brand" value="{{$item->brand}}" class="form-control mb-3 required" >
          <div class="error"></div>

          <input type="number" min="0" name="stock" placeholder="Stock" value="{{$item->stock}}" class="form-control mb-3 required" >
          <div class="error"></div>

          <label>Uplaod new images for your item here:</label><br>
          <input type="file" accept="image/*"   name="photos[]"  class="form-control mb-1" multiple >

          <button type="submit" class="btn btn-primary mt-3">Update Product</button>
        </form>
    </div>
  </div>
@endsection