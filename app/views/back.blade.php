<!DOCTYPE html>
<html>
<head>
	<title> Inkings Admin Panel </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@include('global/css')
	<style>
		body {
			margin-top: 55px;
			padding:10px;
		}
		
		table th {
        	font-size: 14px;
	    }

	    table tbody tr td {
	        font-size: 12px;
	        margin: 0;
	        padding: 0;
	    }
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row wrapper">
			<!-- START: header -->
			<div class="header">
			@include('back/header')
			</div>
			<!-- END: header -->			
		</div>
	</div>
	@include('global/js')
	<script type="text/javascript">
		$('#tags').tagsInput({});
	</script>
</body>
</html>