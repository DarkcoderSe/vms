
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://i.pinimg.com/originals/b1/bb/ec/b1bbec499a0d66e5403480e8cda1bcbe.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ URL::to('/home') }} " class="d-block">
            {{ Auth::user()->name }}
          </a>
        </div>
      </div>
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any oth er icon font library -->
        
          <li class="nav-item has-treeview">
            <a href="{{ URL::to('/home') }} " class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <button onclick="makeASale();" type="button" class="btn btn-primary btn-block nav-link text-left text-white">
                <i class="nav-icon fas fa-cash-register"></i>
                <p>
                  Make a Sale
                </p>
            </button>
          </li>
          <li class="nav-item">
            <a href="{{ URL::to('/tempBook') }}" class="nav-link">
                <i class="nav-icon fab fa-firstdraft"></i>
                <p>
                    Sales History
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ URL::to('/customer') }}" class="nav-link">
              <i class="nav-icon fas fa-address-book"></i>
                <p>
                  Dues Book
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ URL::to('/cashBook') }}" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
                <p>
                  Cash Register
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ URL::to('/provider') }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Providers
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ URL::to('/owner') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
                <p>
                  Owner
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ URL::to('/agent') }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Users
                </p>
            </a>
          </li>
          
          
    
          {{-- <li class="nav-item">
            <a href="{{  URL::to('owner/transactionHistory') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Owner Transaction
              </p>
            </a>
          </li> --}}

          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>