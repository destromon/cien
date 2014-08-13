@extends('back')
@if (Session::has('message'))
	<div class="bs-example">
	    <div class="alert bg-success">
	        <a href="#" class="close" data-dismiss="alert">&times;</a>
	       	{{ Session::get('message') }}
	    </div>
	</div>
@endif
@if (Session::has('warning'))
	<div class="bs-example">
	    <div class="alert bg-danger">
	        <a href="#" class="close" data-dismiss="alert">&times;</a>
	       	{{ Session::get('warning') }}
	    </div>
	</div>
@endif