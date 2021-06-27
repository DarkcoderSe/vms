<!DOCTYPE html>
<html>

@include('layouts._partials.head')

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ URL::to('/home') }} " class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ URL::to('/profile') }} " class="nav-link">Profile</a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ URL::to('/#contact') }} " class="nav-link">test</a>
      </li> -->
      <li class="nav-item d-none d-sm-inline-block">
          <a class="nav-link"  href="{{ route('logout') }}"
             onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
      </li>
 
    </ul>

    <!-- SEARCH FORM -->
 

    <!-- Right navbar links -->

  </nav>
  <!-- /.navbar -->

  @include('layouts._partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper pt-4">

    <!-- Main content -->
    @yield('content')
    <!-- /.content -->
  </div>
  
  @include('layouts._partials.footer')



<div class="modal fade" id="makeASale" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Customer Information</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
			</div>
			<div class="modal-body">
				<a href="javascript:void(0)" onclick="unknown()">Unknown?</a>
				<form action="{{ URL::to('/tempBook/submit') }}" method="post">
					@csrf
					<div class="form-row">
						<div class="form-group col-md-7">
							<label>Customer Name</label>
							<input type="search" list="customers" id="customerName" name="customer_name" class="form-control">
							<datalist id="customers">
							</datalist>

						
						</div>
						<div class="form-group col-md-5">
							<label>Phone Number</label>
							<input type="text" id="phoneNo" name="phone_no" class="form-control">
							
						</div>

					</div>

					<div class="row">
						<div class="col-md-6">
							<button type="reset" class="btn btn-warning">Reset</button>

						</div>
						<div class="col-md-6 text-right">
							<button type="submit" class="btn btn-success">
								Next
							</button>
						</div>
					</div>
				   
					
					
				</form>
			</div>
		</div>
	</div>
</div>

</div>
<!-- ./wrapper -->

@include('layouts._partials.scripts')
</body>
</html>