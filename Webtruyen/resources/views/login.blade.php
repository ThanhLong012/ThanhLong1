
<!doctype html>
<html lang="en">
  <head>
  	<title>Đăng nhập</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="{{ asset('public/login/css/style.css') }}">
	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			
			<div class="row justify-content-center">
				
				<div class="col-md-6 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
					
		      		<span class="fa fa-user-o"></span>
		      	</div>
				  @if(session('message'))
					<div class="alert alert-danger">
						{{session('message')}}
	
					</div>
					@endif
				<form action="{{ route('admin.login') }}" method="POST" class="login-form">
					@csrf
		      		<div class="form-group">
		      			<input type="text" class="form-control rounded-left @error('email') is-invalid @enderror" placeholder="Email" name="email">
						  @if($errors->has('email'))
						  <div class="error-text txt-red">
							  {{$errors->first('email')}}
						  </div>
					  @endif
		      		</div>
	            	<div class="form-group d-flex">
	              		<input type="password" class="form-control rounded-left @error('password') is-invalid @enderror" placeholder="Password" name="password">
						  @if($errors->has('password'))
							<div class="error-text txt-red">
								{{$errors->first('password')}}
							</div>
						@endif 
	            	</div>
					<div class="form-group d-md-flex">
	            		<div class="w-50">
	            			<label class="checkbox-wrap checkbox-primary">Remember Me
									  <input type="checkbox" checked name="remember_me">
									  <span class="checkmark"></span>
									</label>
								</div>
								<div class="w-50 text-md-right">
									<a href="#">Forgot Password</a>
								</div>
	            	</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary rounded submit p-3 px-5">Đăng nhập</button>
					</div>
					
	          </form>
			
	        </div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{ asset('public/login/js/jquery.min.js') }}"></script>
  <script src="{{ asset('public/login/js/popper.js') }}"></script>
  <script src="{{ asset('public/login/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('public/login/js/main.js') }}"></script>

	</body>
</html>


