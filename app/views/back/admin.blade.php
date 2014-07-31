@extends('back')
@if (Session::has('message'))
	<div class="bs-example">
	    <div class="alert bg-success">
	        <a href="#" class="close" data-dismiss="alert">&times;</a>
	       	{{ Session::get('message') }}
	    </div>
	</div>
@endif
<h4> Welcome to admin page </h4>