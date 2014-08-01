@extends('back')
<style>
  .form-access-rights{
    width: 500px;
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
    <?php $types[$userType->user_type_name] = $userType->user_type_name ?>
@endforeach

<div class="form-access-rights">
{{ Form::open(array('url' => 'access_rights')) }}
    <div class="form-group">
        {{ Form::label('user_type_name', 'List of User Types') }}
        @if ($errors->has('user_type_name'))
        <span class="bg-danger"> {{ $errors->first('user_type_name') }} </span>
        @endif
        {{ Form::select('user_type_name', $types )}}
    </div>

    <div class="form-group">
        {{ Form::label('page_name', 'List of Pages') }}
        @if ($errors->has('page_name'))
        <span class="bg-danger"> {{ $errors->first('page_name') }} </span>
        @endif

        @foreach($pages as $page)
        {{ Form::checkbox('page_name[]', $page->page_name ) }} {{ $page->page_name }}
        @endforeach
    </div>

    {{ Form::submit('Save ', array('class' => 'btn btn-primary')) }}
    {{ link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-default']) }}

  {{ Form::close() }}
</div>
