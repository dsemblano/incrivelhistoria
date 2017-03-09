<header class="banner">
  <div class="container">
    <nav class="nav-primary row">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav col-md-12']) !!}
      @endif
    </nav>
      <a href="{{ home_url('/') }}" class="col-md-8">
        <img src="<?= get_template_directory_uri(); ?>/assets/images/logo.svg" alt="<?= get_bloginfo("name"); ?>"/>
      </a>
      {{-- <a class="brand" href="{{ home_url('/') }}">{{ get_bloginfo('name', 'display') }}</a> --}}
        <h1 class="brand col-md-4">
          <a href="{{ home_url('/') }}">Incrível<br / >História</a>
        </h1>
    <nav class="nav-primary row">
      @if (has_nav_menu('secondary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'secondary_navigation', 'menu_class' => 'nav col-md-12']) !!}
      @endif
    </nav>
  </div>
</header>
