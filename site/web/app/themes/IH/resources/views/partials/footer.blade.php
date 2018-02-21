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

            <svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
              <defs>
                <symbol id="icon-facebook-official" viewBox="0 0 27 32">
                  <title>facebook-official</title>
                  <path d="M25.92 2.272q0.608 0 1.056 0.448t0.448 1.088v24.384q0 0.64-0.448 1.088t-1.056 0.448h-6.976v-10.656h3.552l0.512-4.128h-4.064v-2.656q0-0.992 0.416-1.472t1.632-0.512l2.176-0.032v-3.68q-1.12-0.16-3.2-0.16-2.4 0-3.872 1.408t-1.44 4.064v3.040h-3.584v4.128h3.584v10.656h-13.152q-0.608 0-1.056-0.448t-0.448-1.088v-24.384q0-0.64 0.448-1.088t1.056-0.448h24.416z"></path>
                </symbol>
              </defs>
            </svg>
            <div class="facebook-footer">
              <span>
                <a href="https://www.facebook.com/incrivel.historia" target="_blank">
                  Nosso Facebook
                </a>
              </span>
              <a href="https://www.facebook.com/incrivel.historia" target="_blank">
                <svg class="icon icon-facebook-official"><use xlink:href="#icon-facebook-official"></use></svg>
              </a>

            </div>
          </div>
    </div>

  </div>
  <div class="container-fluid copyright">
    Todos os direitos reservados
  </div>
</footer>
