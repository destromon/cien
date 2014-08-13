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

<div class="container-fluid">
    <div class="col-md-6 col-sm-6 pull-left">  
        <a href="{{ URL::to('user_type/create') }}"> Add New User Type </a>
    </div>
    <div class="col-md-6 col-sm-6 pull-right">  
        <form class="pull-right" action="{{ URL::action('UserTypeController@show') }}">
              <input class="form-control col-lg-8" placeholder="Search" type="text" name="search">
        </form>
    </div>
</div>

<?php echo $userTypes->links(); ?>
@if(count($userTypes) != 0)
<table class="table table-striped table-hover table-bordered">
    <th colspan="2"> Action </th>
    <th> ID </th>
    <th> Types of User </th>
    <tbody>
        @foreach($userTypes as $userType)
        <tr>
            <td width="50">
                {{ Form::button('Delete ', array(
                    'class'       => 'btn btn-danger',
                    'href'        => '#',
                    'data-href'   => '/user_type/' . $userType->id,
                    'data-name'   => $userType->user_type_name,
                    'data-toggle' => 'modal', 
                    'data-target' => '#confirm-delete'
                    ))
                }}
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
<?php echo $userTypes->links(); ?>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                System Message
            </div>
            <div class="modal-body">
                Do you want to remove <strong>
                <span class="selected-name">
                </span>
                </strong> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button> 
                {{ Form::open(array('url' => '/user_type/', 'class' => 'pull-right danger')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete ', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }} 
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.danger').attr('action', $(e.relatedTarget).data('href'));
            $(this).find('.selected-name').text($(e.relatedTarget).data('name'));
        });
    });
</script>
@stop