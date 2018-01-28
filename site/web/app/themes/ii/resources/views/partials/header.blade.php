<header class="banner">
  <nav id="nav-page" class="nav-primary flex-item">

    <div class="container d-none d-md-block">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu' => 'nav-page','container'=> '', 'items_wrap'=>'<ul class="nav row justify-content-end">%3$s</ul>']) !!}
        {{-- {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav row justify-content-end']) !!} --}}
      @endif
    </div>

    <div class="container-fluid d-md-none">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_id' => 'menu-page', 'menu_class' => 'nav row']) !!}
      @endif
    </div>

  </nav>
  <div class="container container-brand flex-item">
    <div class="brand d-print-inline-block">
      <img src="@asset('images/brand_print.png')" alt="Incrível História logo impressão" />
      {{ get_bloginfo('name', 'display') }}
      <br />
      <span>https://incrivelhistoria.com.br - Todos os direitos reservados </span>
    </div>
      <a class="brand" href="{{ home_url('/') }}">
        {{-- {{ get_bloginfo('name', 'display') }} --}}
        {{-- <img src="@asset('images/logo.svg')" alt="Incrível História" /> --}}
      <svg version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 315 150.64896" xml:space="preserve" width="315" height="130.64896"><g transform="matrix(.74083 0 0 .74083 -154.31 -146.98)"><g fill="#fff"><path d="m265.1 382.7v-170.1c0-3.9 3.2-7.1 7.1-7.1h7v-7.1h-70.9v7.1h7.1c3.9 0 7.1 3.2 7.1 7.1v170.1c0 3.9-3.2 7.1-7.1 7.1h-7.1v7.1h70.9v-7.1h-7c-3.9 0-7.1-3.2-7.1-7.1z"/><path d="m321.7 198.4v79.4h-21.2c-15.7 0-28.3 12.7-28.3 28.3h49.5v90.7h56.7v-14.2h-7.1c-3.9 0-7.1-3.2-7.1-7.1v-155.8c0-3.9 3.2-7.1 7.1-7.1h7.1v-14.2z"/><rect x="406.8" y="283.5" width="9.2" height="41.8"/><path d="m452 325.2v-18.6c0-1.9-0.2-3.6-0.5-5.1s-0.9-2.8-1.7-3.9-1.9-1.9-3.4-2.5c-1.4-0.6-3.2-0.9-5.5-0.9-1.8 0-3.5 0.4-5.1 1.2-1.7 0.8-3 2.1-4.1 3.8h-0.2v-4.2h-7.9v30.2h8.3v-15.8c0-3.1 0.5-5.3 1.5-6.6s2.7-2 4.9-2c2 0 3.4 0.6 4.2 1.8s1.2 3.1 1.2 5.6v17.1h8.3z"/><path d="m483.1 322.8c2.6-2.1 4.1-5.2 4.7-9.2h-8c-0.3 1.9-0.9 3.4-2 4.5s-2.6 1.7-4.6 1.7c-1.3 0-2.4-0.3-3.3-0.9s-1.6-1.3-2.1-2.3c-0.5-0.9-0.9-1.9-1.1-3.1-0.2-1.1-0.4-2.2-0.4-3.3s0.1-2.3 0.4-3.4c0.2-1.1 0.6-2.2 1.2-3.2s1.3-1.7 2.2-2.3 2-0.9 3.3-0.9c3.5 0 5.6 1.7 6.1 5.2h8.1c-0.1-1.9-0.6-3.6-1.4-5.1-0.8-1.4-1.9-2.6-3.2-3.6s-2.8-1.7-4.4-2.1c-1.7-0.5-3.4-0.7-5.2-0.7-2.5 0-4.6 0.4-6.6 1.2-1.9 0.8-3.5 2-4.9 3.4-1.3 1.5-2.3 3.2-3 5.2s-1 4.2-1 6.5 0.4 4.3 1.1 6.2 1.8 3.5 3.1 4.9 2.9 2.4 4.8 3.2 4 1.1 6.2 1.1c4.1 0.2 7.4-0.9 10-3z"/><path d="m501.3 311.6c0-1.4 0.1-2.6 0.4-3.8s0.7-2.2 1.4-3.1c0.6-0.9 1.5-1.6 2.5-2.1 1.1-0.5 2.3-0.8 3.9-0.8 0.5 0 1 0 1.6 0.1 0.5 0.1 1 0.1 1.4 0.2v-7.7c-0.7-0.2-1.3-0.3-1.8-0.3-1.1 0-2.1 0.2-3 0.5-1 0.3-1.9 0.8-2.7 1.3-0.9 0.6-1.6 1.2-2.3 2s-1.2 1.7-1.6 2.6h-0.1v-5.5h-8v30.2h8.3z"/><polygon points="521.9 282.9 516.3 291.2 522 291.2 531.1 282.9"/><rect x="516.5" y="295" width="8.3" height="30.2"/><polygon points="548.6 325.2 558.8 295 550.6 295 544.2 315.6 544.1 315.6 537.7 295 529 295 539.4 325.2"/><path d="m583.6 315.9c-0.3 0.9-1 1.8-2.2 2.7-1.2 0.8-2.7 1.3-4.3 1.3-2.3 0-4.1-0.6-5.4-1.8-1.2-1.2-1.9-3.2-2-5.8h21.8c0.2-2.3 0-4.6-0.6-6.7-0.5-2.1-1.4-4.1-2.7-5.7-1.2-1.7-2.8-3-4.7-4s-4.2-1.5-6.7-1.5c-2.3 0-4.4 0.4-6.3 1.2s-3.5 1.9-4.9 3.4c-1.4 1.4-2.4 3.1-3.2 5.1-0.7 1.9-1.1 4.1-1.1 6.3 0 2.3 0.4 4.5 1.1 6.4 0.7 2 1.7 3.6 3.1 5 1.3 1.4 2.9 2.5 4.9 3.2 1.9 0.8 4.1 1.1 6.4 1.1 3.4 0 6.4-0.8 8.8-2.3 2.4-1.6 4.2-4.2 5.4-7.8h-7.4zm-13.6-11c0.2-0.7 0.6-1.4 1.1-2.1s1.2-1.2 2.1-1.7c0.9-0.4 2-0.7 3.3-0.7 2 0 3.5 0.5 4.5 1.6s1.7 2.7 2.1 4.8h-13.5c0.1-0.5 0.2-1.2 0.4-1.9z"/><rect x="596.9" y="283.5" width="8.3" height="41.8"/><polygon points="416 381.9 416 363.9 432.9 363.9 432.9 381.9 442 381.9 442 340.2 432.9 340.2 432.9 356.2 416 356.2 416 340.2 406.8 340.2 406.8 381.9"/><rect x="451.7" y="351.7" width="8.3" height="30.2"/><rect x="451.7" y="340.2" width="8.3" height="6.8"/><path d="m492.3 366.3c-0.9-0.6-1.9-1.2-3.1-1.5-1.2-0.4-2.3-0.7-3.5-1s-2.3-0.5-3.5-0.8c-1.1-0.2-2.1-0.5-3-0.8s-1.6-0.7-2.1-1.1c-0.5-0.5-0.8-1.1-0.8-1.8 0-0.6 0.2-1.1 0.5-1.5s0.7-0.7 1.1-0.8c0.4-0.2 0.9-0.3 1.5-0.4 0.5-0.1 1.1-0.1 1.5-0.1 1.5 0 2.8 0.3 3.9 0.8 1.1 0.6 1.7 1.6 1.8 3.2h7.9c-0.2-1.9-0.6-3.4-1.4-4.7-0.8-1.2-1.8-2.2-3-3-1.2-0.7-2.6-1.3-4.1-1.6s-3.1-0.5-4.8-0.5-3.2 0.1-4.8 0.4-3 0.8-4.2 1.5-2.3 1.7-3 3c-0.8 1.2-1.1 2.8-1.1 4.8 0 1.3 0.3 2.4 0.8 3.4 0.5 0.9 1.3 1.7 2.2 2.3s1.9 1.1 3.1 1.5c1.1 0.4 2.3 0.7 3.5 1 3 0.6 5.3 1.2 6.9 1.9 1.7 0.6 2.5 1.6 2.5 2.8 0 0.7-0.2 1.4-0.5 1.8-0.4 0.5-0.8 0.9-1.3 1.2s-1.1 0.5-1.8 0.6c-0.6 0.1-1.3 0.2-1.8 0.2-0.8 0-1.6-0.1-2.4-0.3s-1.4-0.5-2-0.9-1.1-0.9-1.4-1.6c-0.4-0.6-0.6-1.4-0.6-2.3h-7.9c0.1 2 0.5 3.7 1.4 5.1 0.8 1.3 1.9 2.4 3.2 3.2s2.8 1.4 4.5 1.8 3.4 0.5 5.1 0.5 3.4-0.2 5.1-0.5 3.1-0.9 4.4-1.7 2.3-1.9 3.1-3.2 1.2-3 1.2-5c0-1.4-0.3-2.6-0.8-3.5-0.6-1-1.4-1.8-2.3-2.4z"/><path d="m512.9 342.6h-8.3v9.1h-5v5.6h5v17.8c0 1.5 0.3 2.7 0.8 3.7 0.5 0.9 1.2 1.7 2.1 2.2s1.9 0.8 3 1 2.4 0.3 3.7 0.3c0.8 0 1.7 0 2.5-0.1 0.9 0 1.6-0.1 2.3-0.2v-6.4c-0.4 0.1-0.8 0.1-1.2 0.2-0.4 0-0.9 0.1-1.3 0.1-1.4 0-2.3-0.2-2.8-0.7s-0.7-1.4-0.7-2.8v-15h6.1v-5.6h-6.1v-9.2z"/><polygon points="541.1 339.6 535.5 347.9 541.3 347.9 550.3 339.6"/><path d="m551.3 355.2c-1.4-1.4-3-2.5-4.9-3.2-1.9-0.8-4.1-1.1-6.5-1.1s-4.5 0.4-6.4 1.1c-1.9 0.8-3.5 1.8-4.9 3.2s-2.4 3.1-3.2 5c-0.7 2-1.1 4.2-1.1 6.6s0.4 4.6 1.1 6.5c0.7 2 1.8 3.6 3.2 5s3 2.4 4.9 3.2c1.9 0.7 4.1 1.1 6.4 1.1 2.4 0 4.5-0.4 6.5-1.1 1.9-0.7 3.6-1.8 4.9-3.2 1.4-1.4 2.4-3.1 3.2-5 0.7-1.9 1.1-4.1 1.1-6.5s-0.4-4.6-1.1-6.6c-0.8-1.9-1.8-3.6-3.2-5zm-4.4 15.2c-0.2 1.2-0.6 2.2-1.2 3.1s-1.3 1.6-2.3 2.2c-1 0.5-2.1 0.8-3.5 0.8s-2.6-0.3-3.5-0.8-1.7-1.3-2.3-2.2-1-1.9-1.2-3.1c-0.2-1.1-0.4-2.3-0.4-3.5s0.1-2.4 0.4-3.6c0.2-1.2 0.6-2.2 1.2-3.1s1.3-1.6 2.3-2.2c0.9-0.6 2.1-0.8 3.5-0.8s2.6 0.3 3.5 0.8c1 0.6 1.7 1.3 2.3 2.2s1 1.9 1.2 3.1 0.4 2.4 0.4 3.6c0 1.1-0.2 2.3-0.4 3.5z"/><path d="m577.8 351.3c-1 0.3-1.9 0.8-2.7 1.3-0.9 0.6-1.6 1.2-2.3 2s-1.2 1.7-1.6 2.6h-0.1v-5.6h-7.9v30.2h8.3v-13.6c0-1.4 0.1-2.6 0.4-3.8s0.7-2.2 1.4-3.1c0.6-0.9 1.5-1.6 2.5-2.1 1.1-0.5 2.3-0.8 3.9-0.8 0.5 0 1 0 1.6 0.1 0.5 0.1 1 0.1 1.4 0.2v-7.7c-0.7-0.2-1.3-0.3-1.8-0.3-1.1 0.2-2.1 0.3-3.1 0.6z"/><rect x="588.4" y="351.7" width="8.3" height="30.2"/><rect x="588.4" y="340.2" width="8.3" height="6.8"/><path d="m632.7 379.1c-0.2-1.2-0.2-2.6-0.2-3.9v-15.7c0-1.8-0.4-3.3-1.2-4.4s-1.9-2-3.2-2.6-2.7-1-4.3-1.3c-1.6-0.2-3.1-0.3-4.6-0.3-1.7 0-3.3 0.2-5 0.5s-3.1 0.9-4.5 1.7c-1.3 0.8-2.4 1.8-3.3 3.1s-1.3 2.9-1.5 4.9h8.3c0.2-1.6 0.7-2.8 1.6-3.5s2.2-1.1 3.9-1.1c0.7 0 1.4 0 2.1 0.1 0.6 0.1 1.2 0.3 1.7 0.6s0.9 0.7 1.2 1.2 0.4 1.2 0.4 2.1-0.2 1.5-0.8 2c-0.5 0.4-1.3 0.8-2.2 1s-2 0.4-3.2 0.5-2.4 0.3-3.7 0.5c-1.2 0.2-2.5 0.5-3.7 0.8s-2.3 0.8-3.3 1.5-1.7 1.5-2.3 2.7-0.9 2.5-0.9 4.2c0 1.6 0.3 2.9 0.8 4s1.3 2.1 2.2 2.8 2 1.3 3.3 1.6c1.2 0.4 2.6 0.5 4 0.5 1.9 0 3.7-0.3 5.5-0.8s3.4-1.5 4.7-2.9c0 0.5 0.1 1 0.2 1.5s0.2 1 0.4 1.4h8.4c-0.3-0.5-0.6-1.4-0.8-2.7zm-8.5-8.9c0 0.5 0 1.1-0.1 1.9s-0.4 1.5-0.8 2.3-1.1 1.4-2 2c-0.9 0.5-2.2 0.8-3.8 0.8-0.7 0-1.3-0.1-1.9-0.2s-1.2-0.3-1.6-0.6c-0.5-0.3-0.8-0.7-1.1-1.2s-0.4-1.1-0.4-1.9 0.1-1.4 0.4-1.9 0.6-0.9 1.1-1.3c0.4-0.3 1-0.6 1.6-0.8s1.2-0.4 1.8-0.5c0.7-0.1 1.3-0.2 2-0.3s1.3-0.2 1.9-0.3 1.2-0.3 1.7-0.4c0.5-0.2 1-0.4 1.3-0.7v3.1z"/></g></g></svg>
      </a>
  </div>
    <nav id="nav-menu" class="flex-item">
      <label for="toggle-1" class="toggle-menu">
<i class="fa fa-bars hidden-lg-up" aria-hidden="true"></i>
      </label>
      <input type="checkbox" id="toggle-1">
    @if (has_nav_menu('secondary_navigation'))
      {!! wp_nav_menu(['menu' => 'secondary', 'theme_location' => 'secondary_navigation', 'menu_class' => 'menu first container']) !!}
    @endif
    </nav>
</header>
