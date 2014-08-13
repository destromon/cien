@extends('back')
<style>
  .form-user-type{
    width: 500px;
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
Update User Type
<div class="form-user-type">
  {{ Form::model($userType, array('route' => array('user_type.update', $userType->id), 'method' => 'PUT')) }}
    <div class="form-group">
      {{ Form::label('user_type_name', 'User Type Name') }}
      @if ($errors->has('user_type_name'))
      <span class="bg-danger"> {{ $errors->first('user_type_name') }} </span>
      @endif
      {{ Form::text('user_type_name', null, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Save', array('class' => 'btn btn-primary', 'name' => 'save')) }}
    {{ Form::submit('Save and New', array('class' => 'btn btn-info', 'name' => 'save_and_new')) }}
    {{ Form::submit('Save and Close', array('class' => 'btn btn-success', 'name' => 'save_and_close')) }}
    {{ link_to(Request::segment(1), 'Cancel', ['class' => 'btn btn-danger']) }}

  {{ Form::close() }}
</div>
