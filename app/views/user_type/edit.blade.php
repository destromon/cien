@extends('back')
<style>
  .form-user-type{
    width: 500px;
  }
</style>
Update User
<div class="form-user-type">
  {{ Form::model($userType, array('route' => array('user_type.update', $userType->id), 'method' => 'PUT')) }}
    <div class="form-group">
      {{ Form::label('user_type_name', 'User Type Name') }}
      @if ($errors->has('user_type_name'))
      <span class="bg-danger"> {{ $errors->first('user_type_name') }} </span>
      @endif
      {{ Form::text('user_type_name', null, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Update ', array('class' => 'btn btn-primary')) }}
    {{ link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-default']) }}

  {{ Form::close() }}
</div>
