@extends('page/header')
<head>
<title>Login - Page</title>
@include('global/css')
</head>

<body>
<div class="container-fluid">
	<div id="page-login" class="row">
		<div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
			<div class="box">
				<div class="box-content">
					<div class="text-center">
						<h3 class="page-header"> Login Page</h3>
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

					{{ Form::close() }}
					@if (Session::has('message'))
					  <div class="alert bg-danger">{{ Session::get('message') }}</div>
					@endif
					@if (Session::has('logout'))
					  <div class="alert bg-success">{{ Session::get('logout') }}</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
</body>