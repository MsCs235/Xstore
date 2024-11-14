@extends('dashboard')

@section('content')
  <div class="card emp-card">
    <div class="card-body">
         <!-- using (enctype="multipart/form-data) when want to submit files -->
        <form action="{{route('upload.auction')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}} <!-- SQL-injaction attake and CSRF attake -->
          <input type="text" name="title" placeholder="Auction Title" class="form-control mb-3 required" >
          <div class="error"></div>
          
          <textarea type="text" name="description" placeholder="Description" class="form-control mb-3 required" ></textarea>
          <div class="error"></div>

          <input type="number" name="startprice" placeholder="Start Price" class="form-control mb-3 required" >
          <div class="error"></div>

          <input type="text" name="category" placeholder="Category" class="form-control mb-3 required" >
          <div class="error"></div>

          <input type="text" name="initialBid" placeholder="Initial Bid" class="form-control mb-3 required" >
          <div class="error"></div>

          <label>Select End Date:</label><br>
          <input type="datetime-local" name="EndTime" placeholder="End Time" class="form-control mb-3 required" >
          <div class="error"></div>

          <label>Choose all images for your item here:</label><br>
          <input type="file" accept="image/*"   name="photos[]"  class="form-control mb-1" multiple required>

          <button type="submit" class="btn btn-primary mt-3">Open Auction</button>
        </form>
    </div>
  </div>
@endsection

@section('script')
<script>
     $(document).ready(function (){
       $('form').submit(function (event){
          
        $('.required').each(function (){
             if($(this).val() == ''){
                var msg = $(this).attr('placeholder') + ' is required';
                $(this).next('.error').html(msg);
                $('.error').css({'color':'red'});
                event.preventDefault();
             }else{
                $(this).next('.error').hide();
             }
        });
       });
     });
</script>
@endsection