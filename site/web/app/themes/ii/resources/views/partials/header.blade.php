<header class="banner">
      <nav id="nav-page" class="nav-primary container-fluid">
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
      <div id="logo" class="container-fluid">
        <div class="container">
          <div class="row justify-content-start no-gutters">
            <a href="{{ home_url('/') }}" class="brand col-2 col-md-1">
              <svg version="1.1" viewBox="0 0 203 231" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                <g transform="matrix(.72284 0 0 .73101 -33.034 -19.737)"><g fill="#171f42"><path class="st6" d="m306.6 63.3 18.5-16.1c2.8-2.4 1.1-7.2-2.6-7.2h-99.9c-3.7 0-5.5 4.9-2.6 7.3l18.5 15.9c0.2 0.2 0.3 0.8 0.5 0.8h67.1c0.1 0 0.3-0.5 0.5-0.7z"/><path class="st6" d="m149.9 40h-99.9c-3.7 0-5.5 4.9-2.6 7.3l18.5 15.9c0.2 0.2 0.3 0.8 0.5 0.8h67.1c0.2 0 0.3-0.5 0.5-0.6l18.5-16.1c2.8-2.5 1.1-7.3-2.6-7.3z"/><path class="st6" d="m134 306.5c-0.2-0.2-0.3-0.6-0.5-0.6h-67.1c-0.2 0-0.3 0.4-0.5 0.6l-18.5 16.1c-2.8 2.4-1.1 7.3 2.6 7.3h99.9c3.7 0 5.5-4.7 2.6-7.1z"/><path class="st6" d="m306.6 306.5c-0.2-0.2-0.3-0.6-0.5-0.6h-67.1c-0.2 0-0.3 0.4-0.5 0.6l-18.5 16.2c-2.8 2.4-1.1 7.3 2.6 7.3h99.9c3.7 0 5.5-4.7 2.6-7.1z"/><path class="st6" d="m306 298v-226h-67v96h-87c-2.5 0-4 2.2-4 4.7v24.8c0 2.5 1.6 4.6 4 4.6h87v96h67zm-14-212.1c0-2 1.5-3.7 3.5-3.7s3.5 1.7 3.5 3.7v198.1c0 2-1.5 3.7-3.5 3.7s-3.5-1.7-3.5-3.7zm-16 197c0 2.8-2.3 5.1-5.1 5.1h-0.7c-2.8 0-5.1-2.3-5.1-5.1v-194.8c0-2.8 2.3-5.1 5.1-5.1h0.7c2.8 0 5.1 2.3 5.1 5.1z"/><path class="st6" d="m133 298v-226h-66v226zm-14-212.2c0-2 1.5-3.7 3.5-3.7s3.5 1.7 3.5 3.7v198.1c0 2-1.5 3.7-3.5 3.7s-3.5-1.7-3.5-3.7zm-16 197.1c0 2.8-2.3 5.1-5.1 5.1h-0.7c-2.8 0-5.1-2.3-5.1-5.1v-194.8c0-2.8 2.3-5.1 5.1-5.1h0.7c2.8 0 5.1 2.3 5.1 5.1z"/><path class="st6" d="m49.2 34h100.9c1.9 0 3.5-1.6 3.5-3.5s-1.6-3.5-3.5-3.5h-100.9c-1.9 0-3.5 1.6-3.5 3.5s1.6 3.5 3.5 3.5z"/><path class="st6" d="m221.9 34h100.9c1.9 0 3.5-1.6 3.5-3.5s-1.6-3.5-3.5-3.5h-100.9c-1.9 0-3.5 1.6-3.5 3.5s1.5 3.5 3.5 3.5z"/><path class="st6" d="m150.1 336h-100.9c-1.9 0-3.5 1.6-3.5 3.5s1.6 3.5 3.5 3.5h100.9c1.9 0 3.5-1.6 3.5-3.5 0-2-1.6-3.5-3.5-3.5z"/><path class="st6" d="m322.7 336h-100.8c-1.9 0-3.5 1.6-3.5 3.5s1.6 3.5 3.5 3.5h100.9c1.9 0 3.5-1.6 3.5-3.5-0.1-2-1.6-3.5-3.6-3.5z"/></g>
                </g>
              </svg>
            </a>
            <h1 class="brand col-9 col-md-3">
              <a href="{{ home_url('/') }}">Incrível<br / >História</a>
            </h1>
          </div>
        </div>
      </div>
    {{-- <a class="brand" href="{{ home_url('/') }}">{{ get_bloginfo('name', 'display') }}</a> --}}


<nav class="nav-primary nav-primary-main container-fluid navbar navbar-toggleable-md navbar-light bg-faded">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
   data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
   aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
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
</header>
