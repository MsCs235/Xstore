@extends('dashboard')
@section('content')

<div class="card">
   <div class="card-header">
   <a href="{{route('createproduct')}}" class="btn btn-primary">Add Product</a>
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
      <table class="table ">
          <thead>
             <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Categorie</th>
                <th>Images</th>
                <th>Created_at</th>
                <th>View</th>
                <th>Edite/Delete</th> 
             </tr>
          </thead>
          <tbody>
            @foreach($item as $i)
               <tr>
                  <td>{{ $i->title }}</td>
                  <td>{{ $i->price }}</td>
                  <td>{{ $i->category }}</td>
                  <td>
                     @foreach($i->Product_imgs as $img)
                        <img src="{{asset('imgs/products/' . $img->img_url)}}" width="150" height="100"> 
                     @endforeach               
                  </td>
                  <td>{{ $i->created_at }}</td>
                  <td>
                     <a href="{{route('view.product', $img->img_url)}}">Product Page</a>
                  </td>
                  <td>
                    <a href="{{ route('display.product', $i->id) }}" class="btn btn-primary">Edite</a>
                    <a href="{{ route('delete.product', $i->id) }}" class="btn btn-danger">Delete</a>
                  </td>
               </tr>
            @endforeach
          </tbody>
      </table>
      
   </div>
</div>

@endsection
