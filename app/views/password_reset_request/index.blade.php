@include('front/header')
<head>
<title>Registration Page</title>
@include('global/css')
<style>
	body {
		background: url('/images/bg.png');
		overflow-y: hidden;
		overflow-x: hidden;
	}

	.page-register{
		margin-top:120px;
	}

	.footer {
		bottom: 0;
		position: absolute;
	}
</style>
</head>
<body>
<div class="container-fluid">
	<div id="page-register" class="row page-register">
		<div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
			<div class="box">
				<div class="box-content">
					<div class="text-center">
						<h3 class="page-header"> <i class="fa fa-user"></i> Forgot Password </h3>
					</div>			
					{{ Form::open(array('url' => 'forgot')) }}
					    <div class="form-group">
					      {{ Form::label('email', 'Email') }}
					      @if ($errors->has('user_email'))
					      <span class="bg-danger"> {{ $errors->first('user_email') }} </span>
					      @endif
					      {{ Form::email('user_email', Input::old('user_email'), array('class' => 'form-control')) }}
					    </div>

					    {{ Form::submit('Forgot Password', array('class' => 'btn btn-primary')) }}
					    <a href="{{ URL::to('login')}}" class="pull-right"> Go to login page</a>
					{{ Form::close() }}
					@if (Session::has('message'))
					  <div class="alert bg-danger">{{ Session::get('message') }}</div>
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