<footer class="content-info">
  <div class="container">
    {{-- @php(dynamic_sidebar('sidebar-footer')) --}}
    <div class="row">
        @if (has_nav_menu('tertiary_navigation'))

        {!! wp_nav_menu(['theme_location' => 'tertiary_navigation', 'menu_class' => 'sitemap-footer col-12 col-md-8']) !!}
        @endif
        <?php
          // wp_list_categories( array(
          //   'title_li' => '',
          //   'hide_empty' => 0,
          //   'hierarchical' => 1
          //
          // ) );
          ?>
          <div class="col-12 col-md-4 footer-right">
            {!! get_search_form(false) !!}
            <div class="facebook-footer">
              <span>
                <a href="https://www.facebook.com/incrivel.historia" target="_blank">
                  Nosso Facebook
                </a>
              </span>
              <a href="https://www.facebook.com/incrivel.historia" target="_blank">
                <i class="fab fa-facebook"></i>
              </a>

            </div>
          </div>
    </div>

  </div>
  <div class="container-fluid copyright">
    Todos os direitos reservados
  </div>
</footer>
