@extends('back')
<p class="lead">
Access Rights List with '{{$search}}'
</p>
@if (Session::has('message'))
<div class="bs-example">
    <div class="alert bg-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        {{ Session::get('message') }}
    </div>
</div>
@endif
@if (Session::has('delete'))
<div class="bs-example">
    <div class="alert bg-danger">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        {{ Session::get('delete') }}
    </div>
</div>
@endif
@if (Session::has('error'))
<div class="bs-example">
    <div class="alert bg-danger">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        {{ Session::get('error') }}
    </div>
</div>
@endif

<div class="container-fluid">
    <div class="col-md-6 col-sm-6 pull-left">  
        <a href="{{ URL::to('access_rights/create') }}"> Assign Pages </a>
    </div>
    <div class="col-md-6 col-sm-6 pull-right">  
        <form class="pull-right" action="{{ URL::action('AccessRightsController@show') }}">
              <input class="form-control col-lg-8" placeholder="Search" type="text" name="search">
        </form>
    </div>
</div>
<?php echo $accessRights->links(); ?>
@if(count($accessRights) != 0)
<table class="table table-striped table-hover table-bordered">
    <th> Action </th>
    <th> ID </th>
    <th> Types of User </th>
    <th> Pages </th>
    <tbody>
        <?php $temp ='' ?>
        @foreach($accessRights as $accessRight)

        @if($temp == '' OR $temp != $accessRight->user_type_name)
        </td>
        </tr>
        <tr>
            <td width="50"> <a class="btn btn-small btn-info" href="{{ URL::to('access_rights/' . $accessRight->user_type_id . '/edit') }}">Edit</a> </td>
            <td>
                {{ $accessRight->user_type_id }}
            </td>
            <td>
                {{ $accessRight->user_type_name }}
            </td>
            <td>
                | {{ $accessRight->page_name }} |
        @else
            {{ $accessRight->page_name }} |
        @endif
        <?php $temp = $accessRight->user_type_name; ?>
        @endforeach
    </tbody>
</table>
@else
<div class="alert bg-info">
  <p> No Record Found </p>
</div>
@endif
<?php echo $accessRights->links(); ?>