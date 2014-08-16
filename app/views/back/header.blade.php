<?php $menus = Menu::render(); ?>
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
    <a class="navbar-brand" href="{{ URL::to('/account') }}">Dashboard</a>
  </div>
  <div style="" class="navbar-collapse navbar-responsive-collapse collapse in">
    @foreach($menus as $menu)
    <ul class="nav navbar-nav">
      <li class="dropdown">
        <a href="" class="dropdown-toggle" data-toggle="dropdown">
            <i class="{{$menu['class']}}"> </i>
            {{$menu['name']}} 
            <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            @foreach($menu['subMenu'] as $subMenu)
                @if(AccessRights::inMenu($subMenu['link']))
                <li><a href="{{ $subMenu['link']}}"> {{$subMenu['text']}} </a> </li>
                @endif
            @endforeach
        </ul>
      </li>
    </ul>
    @endforeach

    <ul class="nav navbar-nav navbar-right">
      <li><a href="{{ URL::to('/') }}"> <i class="fa fa-home"> </i> Back to Site </a></li>
      <li class="dropdown">
        <a href="" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->user_email }} <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="{{ URL::to('profile') }}"> Edit Profile </a> </li>          
          <li><a href="{{ URL::to('logout') }}">Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>