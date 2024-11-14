    <!-- scroll bar -->
      <!--titel-->
      <div class="main-title my-4 mx-md-5 position-relative">
        <!-- Bags, cars, fashion, shoes, watches and toys -->
        <h3 class="mx-3">Explore Popular Categories</h3>
        <!--cards-->
        <div class="card-container mt-2">
            <div class="card card-scroll gallary">
                <img src="{{asset('imgs/category/cat1.jpg')}}" width="75%">
                <div class="card-body">
                    <p>clothes</p>
                    <a href="{{route('filter.view', 'clothes')}}" class="stretched-link"></a>
                </div>
            </div>

            <div class="card card-scroll gallary">
                <img src="{{asset('imgs/category/cat2.jpg')}}" width="75%" >
                <div class="card-body">
                    <p>watches</p>
                    <a href="{{route('filter.view', 'watche')}}" class="stretched-link"></a>
                </div>
            </div>

            <div class="card card-scroll gallary">
                <img src="{{asset('imgs/category/cat3.jpg')}}" width="75%" >
                <div class="card-body">
                    <p>shoes</p>
                    <a href="{{route('filter.view', 'shose')}}" class="stretched-link"></a>
                </div>
            </div>

            <div class="card card-scroll gallary">
                <img src="{{asset('imgs/category/cat4.jpg')}}" width="75%" >
                <div class="card-body">
                    <p>video game</p>
                    <a href="{{route('filter.view', 'game')}}" class="stretched-link"></a>
                </div>
            </div>

            <div class="card card-scroll gallary">
                <img src="{{asset('imgs/category/cat5.jpg')}}" width="75%" >
                <div class="card-body">
                    <p>cars</p>
                    <a href="{{route('filter.view', 'car')}}" class="stretched-link"></a>
                </div>
            </div>

            <div class="card card-scroll gallary"> 
                <img src="{{asset('imgs/category/cat6.jpg')}}" width="75%" >
                <div class="card-body">
                    <p>Bags</p>
                    <a href="{{route('filter.view', 'bag')}}" class="stretched-link"></a>
                </div>
            </div>

        </div>
    </div>
    <!--end titel-->
    <!-- end scroll bar -->