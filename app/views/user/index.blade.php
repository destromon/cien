@extends('back')
<p class="lead">
List of Users
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
<a href="/user/create"> Create New User </a> <br/>

@if(count($users) != 0)
<table class="table table-striped table-hover table-bordered">
<?php echo $users->links(); ?>
    <th colspan="2"> Action </th>
    <th> ID </th>
    <th> Name </th>
    <th> Email </th>  
    <tbody>
        @foreach($users as $user)
        <tr>
            <td width="50">
            {{ Form::open(array('url' => 'user/' . $user->id, 'class' => 'pull-right')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete ', array('class' => 'btn btn-danger')) }}
            {{ Form::close() }} 
            </td>
            <td width="50"> <a class="btn btn-small btn-info" href="{{ URL::to('user/' . $user->id . '/edit') }}">Edit</a> </td>
            <td> {{ $user->id }}  </td>
            <td>
                {{ $user->user_last }}
                {{ $user->user_first }}
                {{ $user->user_middle }}
            </td>
            <td> {{ $user->user_email }} </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<div class="alert bg-info">
  <p> No Record Found </p>
</div>
@endif
<?php echo $users->links(); ?>