@extends('back')
<style>
  .form-user-type{
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
Update User Type
<div class="form-user-type">
  {{ Form::model($userType, array('route' => array('access_rights.update', $userType->id), 'method' => 'PUT')) }}
    <div class="form-group">
      {{ Form::label('user_type_id', 'User Type Name') }}
      @if ($errors->has('user_type_id'))
      <span class="bg-danger"> {{ $errors->first('user_type_id') }} </span>
      @endif
      {{ Form::hidden('user_type_id', null, array('class' => 'form-control', 'readonly' => 'readonly')) }}
      {{ Form::text('user_type_name', null, array('class' => 'form-control', 'readonly' => 'readonly')) }}
    </div>

    <div class="form-group">
        {{ Form::label('page_id', 'List of Pages') }}
        @if ($errors->has('page_id'))
        <span class="bg-danger"> {{ $errors->first('page_id') }} </span>
        @endif

        @foreach($pages as $page)
            <?php
            $found = AccessRights::where('user_type_id', '=', $userType->id)
                ->where('page_id', '=', $page->id)
                ->first();
            ?>
            @if($found)
            <input type="checkbox" name="page_id[]" value="{{$page->id}}" checked="checked"> {{ $page->page_name }}
            @else
            <input type="checkbox" name="page_id[]" value="{{$page->id}}"> {{ $page->page_name }}
            @endif
        @endforeach
    </div>

    {{ Form::submit('Update ', array('class' => 'btn btn-primary')) }}
    {{ link_to(Request::segment(1), 'Cancel', ['class' => 'btn btn-default']) }}

  {{ Form::close() }}
</div>
