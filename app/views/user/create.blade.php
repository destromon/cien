@extends('back')
<style>
  .form-user{
    width: 300px;
  }
</style>
Create New User
<div class="form-user">
{{ Form::open(array('url' => 'user')) }}
    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        @if ($errors->has('user_email'))
        <span class="bg-danger"> {{ $errors->first('user_email') }} </span>
        @endif
        {{ Form::email('user_email', Input::old('email'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('user_password', 'Password') }}
        @if ($errors->has('user_password'))
        <span class="bg-danger"> {{ $errors->first('user_password') }} </span>
        @endif
        {{ Form::password('user_password', array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
      {{ Form::label('user_password_confirmation', 'Confirm Password') }}
      {{ Form::password('user_password_confirmation', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('user_first', 'First Name') }}
        @if ($errors->has('user_first'))
        <span class="bg-danger"> {{ $errors->first('user_first') }} </span>
        @endif
        {{ Form::text('user_first', Input::old('user_first'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('user_last', 'Last Name') }}
        @if ($errors->has('user_last'))
        <span class="bg-danger"> {{ $errors->first('user_last') }} </span>
        @endif
        {{ Form::text('user_last', Input::old('user_last'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('user_middle', 'Middle Name') }}
        @if ($errors->has('user_middle'))
        <span class="bg-danger"> {{ $errors->first('user_middle') }} </span>
        @endif
        {{ Form::text('user_middle', Input::old('user_middle'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('user_access', 'Access Level') }}
        @if ($errors->has('user_access'))
        <span class="bg-danger"> {{ $errors->first('user_access') }} </span>
        @endif
        {{ Form::select('user_access', array('admin' => 'Administrator', 'user' => 'User'), Input::old('user_accesslevel'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Save ', array('class' => 'btn btn-primary')) }}

  {{ Form::close() }}
</div>
