<style type="text/css">
	.sidebar-content .logo {
		margin-left: 35px;
	}
	.sidebar-content {
		background: #B1B1B1 repeat-y;
		padding: 10px;
		position:fixed;
		width: 215px;
	}

	.sidebar-content h4 {
		text-shadow: 1px 1px 2px #525252;
	}

	/* Large desktop */
	@media (min-width: 1200px) {
		
	}

	/* Medium devices (desktops, 992px and up) */
	@media (min-width: @screen-md-min) {
		.sidebar-content {
			position:fixed;
			width: auto;
		}
	}

	/* Portrait tablet to landscape and desktop */
	@media (min-width: 768px) and (max-width: 979px) {
		.sidebar-content {
			position:relative;
		}

	}

	/* Landscape phone to portrait tablet */
	@media (max-width: 767px) {
		.sidebar-content {
			position:relative;
			width: auto;
		}
	}

	/* Landscape phones and down */
	@media (max-width: 480px) {
		.sidebar-content {
			position:relative;
		}
		.sidebar-content .logo {
			margin-left: 50px;
		}
	}
</style>

<div class="sidebar-content">
	<!-- START: logo -->
		<a href="{{URL::to('/')}}"> {{ HTML::image('images/logo.png', 'a logo',  array('class' => 'logo') )}} </a>
	<!-- END: logo -->
	<hr/>
	<h4>
	MAIKO G. PASCUAL
	</h4>
	</p>
	<p>
	University of the Philippines Diliman 
	B. Fine Arts, Visual Communication 2010 <br/>
	Tarlac Local Designers Program 2011 <br/>
	</p>
	<hr/>

	<address>
	  <strong>Address:</strong><br>
	  795 Folsom Ave, Suite 600
	  San Francisco, CA 94107
	  <abbr title="Phone">P:</abbr> (123) 456-7890
	</address>
	<hr/>

	<address>
	  <strong>Email:</strong><br>
	  <a href="mailto:#">first.last@email.com</a>
	</address>
	<hr/>

	<address>
	  <strong>Facebook:</strong><br>
	  <a href="mailto:#">first.last@facebook.com</a>
	</address>

	<hr/>
	<p> Copyright &copy; 2014. All Rights Reserved. </p>
	<hr/>
</div>