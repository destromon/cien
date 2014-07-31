<!DOCTYPE html>
<html>
<head>
	<title> Inkings Official Website </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@include('global/css')
	<style>
		body { background-color: #222222; margin-top:30px; }
		.container-fluid { width: 1366px; }
		.content { background-color: #DEDEDE; }
		.header { padding: 10px; }
		.sidebar { background-color: #B1B1B1; position: relative;  }
		.logo { margin-left: 20px; }

		/* Large desktop */
		@media (min-width: 1200px) {
	
		}

		/* Portrait tablet to landscape and desktop */
		@media (min-width: 768px) and (max-width: 979px) {
			
		}

		/* Landscape phone to portrait tablet */
		@media (max-width: 767px) {
			.container-fluid { width: auto; }
		}

		/* Landscape phones and down */
		@media (max-width: 480px) {
			.container-fluid { width: auto; }
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row wrapper">
			<!-- START: header -->
			<div class="header">
			@include('page/header')
			</div>
			<!-- END: header -->
			<!-- START: Sidebar -->
			<div class="sidebar col-md-2 col-sm-2">
			 	@include('page/sidebar')
			</div>
			<!-- End: Sidebar -->
			<!-- START: Content -->
			<div class="content col-md-10 col-sm-10">
			@yield('content')
			</div>
			<!-- End: Content -->
		</div>
	</div>
	@include('global/js')
	<script type="text/javascript">
		/**
		 * infinite scroll
		 * name of wrapper : '.image-content'
		 * name of wrapper parent: '#boxes'
		 * for this to work, pagination must be present.
		 * name of pagination, '.paginate'
		 */
		$('#boxes').infinitescroll({
		    navSelector     : ".paginate",
		    nextSelector    : ".paginate a:last",
		    itemSelector    : ".image-content",
		    debug           : false,
		    dataType        : 'html',
		    path: function(index) {
		    	console.log(index);
		        return "?page=" + index;
		    }
		}, function(newElements, data, url){

		    var $newElems = $( newElements );
		    $('#boxes').masonry( 'appended', $newElems, true);
		});
	</script>
</body>
</html>