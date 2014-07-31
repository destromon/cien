<style type="text/css">
	.logo {
		float:center;
	}
	.navbar-form {
		margin-top:15px;
	}	
</style>
<div class="navbar navbar-default">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
    </button>
    <a class="navbar-brand" href="{{URL::to('/')}}">Project Name</a>
  </div>
  <div style="" class="navbar-collapse navbar-responsive-collapse collapse in">
    <ul class="nav navbar-nav">
      <li class="active"><a href="{{URL::to('/')}}">Home</a></li>
    </ul>
    <form class="navbar-form navbar-left" action="">
      <input class="form-control col-lg-8" placeholder="Search" type="text" name="tag">
    </form>
  </div>
</div>
