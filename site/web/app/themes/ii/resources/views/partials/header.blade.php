<header class="banner">
  <nav id="nav-page" class="nav-primary">
    <div class="container hidden-sm-down">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav row justify-content-end']) !!}
      @endif
    </div>
    <div class="hidden-md-up">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav row']) !!}
      @endif
    </div>
  </nav>
  <div class="container container-brand">
      <a class="brand" href="{{ home_url('/') }}">
        <img src="@asset('images/IH.svg')" alt="Incrível História" />
      </a>
  </div>
  <nav id="nav-menu" class="nav-primary nav-primary-main navbar navbar-toggleable-md navbar-inverse">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
     data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
     aria-label="Toggle navigation">
       {{-- <span class="navbar-toggler-icon"></span> --}}
       <i class="fa fa-bars hidden-lg-up" aria-hidden="true"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
     @if (has_nav_menu('secondary_navigation'))
     {!! wp_nav_menu(['theme_location' => 'secondary_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'navbar-nav nav pull-right']) !!}
     @endif
     </div>
     <!-- <form class="form-inline collapse navbar-collapse pull-right">
     <button class="btn btn-outline-success" type="button">Main button</button>
     </form> -->
   </nav>
    {{-- <a class="brand" href="{{ home_url('/') }}">{{ get_bloginfo('name', 'display') }}</a> --}}
</header>
