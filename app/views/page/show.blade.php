@extends('back')
<p class="lead">
List of Pages with '{{$search}}'
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

<div class="container-fluid">
    <div class="col-md-6 col-sm-6 pull-left">  
        <a href="{{ URL::to('page/create') }}"> Add New Page </a>
    </div>
    <div class="col-md-6 col-sm-6 pull-right">  
        <form class="pull-right" action="{{ URL::action('PageController@show') }}">
              <input class="form-control col-lg-8" placeholder="Search" type="text" name="search">
        </form>
    </div>
</div>

<?php echo $pages->links(); ?>
@if(count($pages) != 0)
<table class="table table-striped table-hover table-bordered">
    <th colspan="2"> Action </th>
    <th> ID </th>
    <th> Page Name </th>
    <tbody>
        @foreach($pages as $page)
        <tr>
            <td width="50">
            {{ Form::open(array('url' => 'page/' . $page->id, 'class' => 'pull-right')) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete ', array('class' => 'btn btn-danger')) }}
            {{ Form::close() }} 
            </td>
            <td width="50"> <a class="btn btn-small btn-info" href="{{ URL::to('page/' . $page->id . '/edit') }}">Edit</a> </td>
            <td> {{ $page->id }}  </td>
            <td>
                {{ $page->page_name }}
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
<?php echo $pages->links(); ?>