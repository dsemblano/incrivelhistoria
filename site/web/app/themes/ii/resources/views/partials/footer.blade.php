<footer class="content-info">
  <div class="container">
    {{-- @php(dynamic_sidebar('sidebar-footer')) --}}
    <div class="row no-gutters">
        @if (has_nav_menu('secondary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'secondary_navigation', 'menu_class' => 'sitemap-footer col-8']) !!}
        @endif
        <?php
          // wp_list_categories( array(
          //   'title_li' => '',
          //   'hide_empty' => 0,
          //   'hierarchical' => 1
          //
          // ) );
          ?>
          <div class="col-4 footer-right">
            {!! get_search_form(false) !!}
            <div class="facebook-footer">
              <p>
                <a href="https://www.facebook.com/incrivel.historia" target="_blank">
                  Nosso Facebook
                </a>
              </p>
              <a href="https://www.facebook.com/incrivel.historia" target="_blank">
                <i class="fa fa-facebook-square" aria-hidden="true"></i>
              </a>

            </div>
          </div>
    </div>

  </div>
</footer>
