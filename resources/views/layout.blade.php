
<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <meta name="_token" content="{{csrf_token()}}" />
    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>
<body>

<div class="container">

    <div class="row">
        <div class="col-lg-12 col-sm-12 col-12 main-section">
				<div class="dropdown">
					<a href="{{ url('cart') }}" class="btn btn-primary btn-block">
					<i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart
					
					@auth
						<span id="total_items" class="badge badge-pill badge-danger">
							<?php echo DB::table('carts')->where('uid',Auth::user()->id)->count(); ?>
						</span>
					@else
						<?php if(session('cart')){ ?>
							<span class="badge badge-pill badge-danger" id="total_items">
								<?php echo count(session('cart'));  ?>
							</span>
						<?php }else{ ?>
							<span id="total_items" class="badge badge-pill badge-danger">0</span>
						<?php } ?>
					@endauth
					
						
					</a>
				</div>
				@auth
					<div class="dropdown">
						<a  class="btn btn-info btn-block" href="{{ route('logout') }}"
						   onclick="event.preventDefault();
										 document.getElementById('logout-form').submit();">
							{{ __('Logout') }}
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</div>
					<div class="dropdown"><a href="{{ url('/') }}" class="btn btn-info btn-block">Home</a></div>
					<div class="pull-left" style="margin-top:10px;font-size:20px;">Welcome {{ Auth::user()->name }}</div>
				@else
					<div class="dropdown"><a href="{{ route('login') }}" class="btn btn-info btn-block">Login</a></div>

					@if (Route::has('register'))
						<div class="dropdown"><a href="{{ route('register') }}" class="btn btn-info btn-block">Register</a></div>
					@endif
					
					<div class="dropdown"><a href="{{ url('/') }}" class="btn btn-info btn-block">Home</a></div>
				@endauth
				
				
        </div>
    </div>
</div>

<div class="container page">
    @yield('content')
</div>


    @yield('scripts')

</body>
</html>