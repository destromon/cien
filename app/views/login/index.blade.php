@include('front/header')
<head>
<title>Login - Page</title>
@include('global/css')
<style>
	body {
		background: url('/images/bg.png');
		overflow-y: hidden;
		overflow-x: hidden;
		
	}
	.page-login{
		margin-top:45px;
	}

	.footer {
		bottom: 0;
		position: absolute;
		overflow: hidden;
	}

	.alert {
		margin-top: 25px;
	}

	.link-inner {
		color: #fff;
		font-weight: bold;
		text-decoration: underline;
	}

	.link-inner:hover {
		color: #ccc;
	}
</style>
</head>

<body>
<div class="container-fluid">
	<div id="page-login" class="row page-login">
		<div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
			<div class="box">
				<div class="box-content">
					<div class="text-center">
						<h3 class="page-header"><i class="fa fa-sign-in"> </i> Login Page</h3>
					</div>			
					{{ Form::open(array('url' => 'login')) }}
					    <div class="form-group">
					      {{ Form::label('email', 'Email') }}
					      @if ($errors->has('user_email'))
					      <span class="bg-danger"> {{ $errors->first('user_email') }} </span>
					      @endif
					      {{ Form::email('user_email', Input::old('user_email'), array('class' => 'form-control')) }}
					    </div>

					    <div class="form-group">
					      {{ Form::label('user_password', 'Password') }}
					      @if ($errors->has('user_password'))
					      <span class="bg-danger"> {{ $errors->first('user_password') }} </span>
					      @endif
					      {{ Form::password('user_password', array('class' => 'form-control')) }}
					    </div>

					    {{ Form::submit('Login ', array('class' => 'btn btn-primary')) }}
					    <a href={{ URL::to('/register')}} class="pull-right"> Create New Account </a> <br/>
					    <a href={{ URL::to('/forgot')}} class="pull-right"> Forgot Password </a>
					{{ Form::close() }}
					
					@if (Session::has('message'))
					  <div class="alert bg-danger">{{ Session::get('message') }}</div>
					@endif
					@if (Session::has('logout'))
					  <div class="alert bg-success">{{ Session::get('logout') }}</div>
					@endif
					@if (Session::has('success'))
					  <div class="alert bg-success">{{ Session::get('success') }}</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
</body>
@include('front/footer')