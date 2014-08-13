@extends('back')
<style>
  .form-page{
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
Add New Page
<div class="form-page">
{{ Form::open(array('url' => 'page')) }}
    <div class="form-group">
        {{ Form::label('page_name', 'Page Name') }}
        @if ($errors->has('page_name'))
        <span class="bg-danger"> {{ $errors->first('page_name') }} </span>
        @endif
        {{ Form::text('page_name', Input::old('page_name'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Save', array('class' => 'btn btn-primary', 'name' => 'save')) }}
    {{ Form::submit('Save and New', array('class' => 'btn btn-info', 'name' => 'save_and_new')) }}
    {{ Form::submit('Save and Close', array('class' => 'btn btn-success', 'name' => 'save_and_close')) }}
    {{ link_to(Request::segment(1), 'Cancel', ['class' => 'btn btn-danger']) }}

  {{ Form::close() }}
</div>
