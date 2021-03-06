@extends('back')
<style>
  .form-user{
    width: 400px;
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
  {{ Form::model($user, array('route' => array('user.update', $user->id), 'method' => 'PUT')) }}
    <div class="form-group">
      {{ Form::label('email', 'Email') }}
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

    <div class="form-group">
        {{ Form::label('user_access', 'Access Level') }}
        @if ($errors->has('user_access'))
        <span class="bg-danger"> {{ $errors->first('user_access') }} </span>
        @endif
        <?php $types = array() ?>

        @foreach($userTypes as $userType)
            <?php $types[$userType->id] = $userType->user_type_name; ?>
        @endforeach
        {{ Form::select('user_access', $types, null, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Save', array('class' => 'btn btn-primary', 'name' => 'save')) }}
    {{ Form::submit('Save and New', array('class' => 'btn btn-info', 'name' => 'save_and_new')) }}
    {{ Form::submit('Save and Close', array('class' => 'btn btn-success', 'name' => 'save_and_close')) }}
    {{ link_to(Request::segment(1), 'Cancel', ['class' => 'btn btn-danger']) }}

  {{ Form::close() }}
</div>
