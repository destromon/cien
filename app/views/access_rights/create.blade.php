@extends('back')
<style>
  .form-access-rights{
    width: 800px;
  }
  /* Large desktop */
    @media (min-width: 1200px) {
  
    }

    /* Portrait tablet to landscape and desktop */
    @media (min-width: 768px) and (max-width: 979px) {
      
    }

    /* Landscape phone to portrait tablet */
    @media (max-width: 767px) {
      .form-access-rights {
        width: auto;
      }
    }

    /* Landscape phones and down */
    @media (max-width: 480px) {
      .form-access-rights {
        width: auto;
      }
    }
</style>
<?php $types = array() ?>
@foreach($userTypes as $userType)
    <?php $found = AccessRights::where('user_type_id', '=', $userType->id)->get(); ?>
    @if(count($found) == 0)
        <?php $types[$userType->id] = $userType->user_type_name ?>
    @endif
@endforeach
<div class="form-access-rights">
{{ Form::open(array('url' => 'access_rights')) }}
    <div class="form-group">
        {{ Form::label('user_type_id', 'List of User Types') }}
        @if ($errors->has('user_type_id'))
        <span class="bg-danger"> {{ $errors->first('user_type_id') }} </span>
        @endif
        {{ Form::select('user_type_id', $types )}}
    </div>

    <div class="form-group">
        {{ Form::label('page_id', 'List of Pages') }}
        @if ($errors->has('page_id'))
        <span class="bg-danger"> {{ $errors->first('page_id') }} </span>
        @endif

        @foreach($pages as $page)
        {{ Form::checkbox('page_id[]', $page->id ) }} {{ $page->page_name }}
        @endforeach
    </div>

    {{ Form::submit('Save ', array('class' => 'btn btn-primary')) }}
    {{ link_to(Request::segment(1), 'Cancel', ['class' => 'btn btn-default']) }}

  {{ Form::close() }}
</div>
