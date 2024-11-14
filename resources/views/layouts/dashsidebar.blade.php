<div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('back/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{route('userprofile')}}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">

            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="{{route('over')}}" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                  Overview
                    
                  </p>
                </a>
              </li>  

              <li class="nav-item">
                <a href="{{route('order.view')}}" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                  Orders
                    
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('userproducts')}}" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                  Products
                    
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('userauctions')}}" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                  Auctions
                    
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('userreturns')}}" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                  Returns
                    
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('userprofile')}}" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                  Profile
                    
                  </p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>