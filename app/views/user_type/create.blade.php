@extends('back')
<style>
  .form-user{
    width: 500px;
  }
</style>
Create New User
<div class="form-user">
{{ Form::open(array('url' => 'user_type')) }}
    <div class="form-group">
        {{ Form::label('user_type_name', 'User Type Name') }}
        @if ($errors->has('user_type_name'))
        <span class="bg-danger"> {{ $errors->first('user_type_name') }} </span>
        @endif
        {{ Form::text('user_type_name', Input::old('user_type_name'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Save ', array('class' => 'btn btn-primary')) }}

  {{ Form::close() }}
</div>
