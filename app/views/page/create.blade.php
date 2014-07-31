@extends('back')
<style>
  .form-page{
    width: 500px;
  }
</style>
Add New User Type
<div class="form-page">
{{ Form::open(array('url' => 'page')) }}
    <div class="form-group">
        {{ Form::label('page_name', 'Page Name') }}
        @if ($errors->has('page_name'))
        <span class="bg-danger"> {{ $errors->first('page_name') }} </span>
        @endif
        {{ Form::text('page_name', Input::old('page_name'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Save ', array('class' => 'btn btn-primary')) }}
    {{ link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-default']) }}

  {{ Form::close() }}
</div>
