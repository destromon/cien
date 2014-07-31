@extends('back')
<p class="lead">
List of User Types
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
<a href="{{ URL::to('user_type/create') }}"> Create New User Type </a> <br/>

@if(count($userTypes) != 0)
<table class="table table-striped table-hover table-bordered">
    <th colspan="2"> Action </th>
    <th> ID </th>
    <th> Types of User </th>
    <tbody>
        @foreach($userTypes as $userType)
        <tr>
            <td width="50">
            {{ Form::open(array('url' => 'user_type/' . $userType->id, 'class' => 'pull-right')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete ', array('class' => 'btn btn-danger')) }}
            {{ Form::close() }} 
            </td>
            <td width="50"> <a class="btn btn-small btn-info" href="{{ URL::to('user_type/' . $userType->id . '/edit') }}">Edit</a> </td>
            <td> {{ $userType->id }}  </td>
            <td>
                {{ $userType->user_type_name }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="alert bg-info">
  <p> No Record Found </p>
</div>
@endif