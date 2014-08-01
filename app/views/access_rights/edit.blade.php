@extends('back')
<style>
  .form-user-type{
    width: 500px;
  }
</style>
Update User Type
<div class="form-user-type">
  {{ Form::model($userType, array('route' => array('access_rights.update', $userType->id), 'method' => 'PUT')) }}
    <div class="form-group">
      {{ Form::label('user_type_name', 'User Type Name') }}
      @if ($errors->has('user_type_name'))
      <span class="bg-danger"> {{ $errors->first('user_type_name') }} </span>
      @endif
      {{ Form::text('user_type_name', null, array('class' => 'form-control', 'readonly' => 'readonly')) }}
    </div>

    <div class="form-group">
        {{ Form::label('page_name', 'List of Pages') }}
        @if ($errors->has('page_name'))
        <span class="bg-danger"> {{ $errors->first('page_name') }} </span>
        @endif

        @foreach($pages as $page)
            <?php
            $found = AccessRights::where('user_type_name', '=', $userType->user_type_name)
                ->where('page_name', '=', $page->page_name)
                ->first();
            ?>
            @if($found)
            <input type="checkbox" name="page_name[]" value="{{$page->page_name}}" checked="checked"> {{ $page->page_name }}
            @else
            <input type="checkbox" name="page_name[]" value="{{$page->page_name}}"> {{ $page->page_name }}
            @endif
        @endforeach
    </div>

    {{ Form::submit('Update ', array('class' => 'btn btn-primary')) }}
    {{ link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-default']) }}

  {{ Form::close() }}
</div>
