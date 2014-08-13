@extends('back')
<style>
  .form-user{
    width: 300px;
  }
</style>
@if (Session::has('message'))
  <div class="bs-example">
      <div class="alert bg-success">
          <a href="#" class="close" data-dismiss="alert">&times;</a>
          {{ Session::get('message') }}
      </div>
  </div>
@endif
Update User
<div class="form-user">
  {{ Form::model($user, array('route' => array('profile.update', $user->id), 'method' => 'PUT')) }}
    <div class="form-group">
      {{ Form::label('user_email', 'Email') }}
      @if ($errors->has('user_email'))
      <span class="bg-danger"> {{ $errors->first('user_email') }} </span>
      @endif
      {{ Form::email('user_email', null, array('class' => 'form-control')) }}
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
      {{ Form::text('user_first', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
      {{ Form::label('user_last', 'Last Name') }}
      @if ($errors->has('user_last'))
      <span class="bg-danger"> {{ $errors->first('user_last') }} </span>
      @endif
      {{ Form::text('user_last', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
      {{ Form::label('user_middle', 'Middle Name') }}
      @if ($errors->has('user_middle'))
      <span class="bg-danger"> {{ $errors->first('user_middle') }} </span>
      @endif
      {{ Form::text('user_middle', null, array('class' => 'form-control')) }}
    </div>
    
    {{ Form::submit('Update ', array('class' => 'btn btn-primary')) }}
    {{ link_to(Request::segment(1), 'Cancel', ['class' => 'btn btn-default']) }}

  {{ Form::close() }}
</div>
