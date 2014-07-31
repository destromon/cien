@extends('back')
<style>
  .form-page{
    width: 500px;
  }
</style>
Update Page
<div class="form-page">
  {{ Form::model($page, array('route' => array('page.update', $page->id), 'method' => 'PUT')) }}
    <div class="form-group">
      {{ Form::label('page_name', 'Page Name') }}
      @if ($errors->has('page_name'))
      <span class="bg-danger"> {{ $errors->first('page_name') }} </span>
      @endif
      {{ Form::text('page_name', null, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Update ', array('class' => 'btn btn-primary')) }}
    {{ link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-default']) }}

  {{ Form::close() }}
</div>
