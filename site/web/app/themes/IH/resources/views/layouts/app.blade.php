<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('partials.head')
   <body @php body_class() @endphp>
    @include('partials.facebook')
    @php do_action('get_header') @endphp
    @include('partials.header')
    <div class="wrap container" role="document">
      <div class="content row">
        <main class="main col-12 col-sm-8 col-md-12 col-lg-8">
          @yield('content')
          @if (! is_404())
          {!! get_the_posts_pagination(array('prev_text' => '« Anterior' , 'next_text' => 'Próximo »' )) !!}
          @endif
        </main>
        @if (App\display_sidebar())
          <aside id="sidebar" class="sidebar col-12 col-sm-4 col-md-12 col-lg-4">
            @include('partials.sidebar')
          </aside>
        @endif
      </div>
    </div>
    @php do_action('get_footer') @endphp
    @include('partials.footer')
    @php wp_footer() @endphp
    <script>
      jQuery(document).ready(function($){
        // browser window scroll (in pixels) after which the "back to top" link is shown
        var offset = 300,
          //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
          offset_opacity = 1200,
          //duration of the top scrolling animation (in ms)
          scroll_top_duration = 700,
          //grab the "back to top" link
          $back_to_top = $('.cd-top');

        //hide or show the "back to top" link
        $(window).scroll(function(){
          ( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
          if( $(this).scrollTop() > offset_opacity ) {
            $back_to_top.addClass('cd-fade-out');
          }
        });

        //smooth scroll to top
        $back_to_top.on('click', function(event){
          event.preventDefault();
          $('body,html').animate({
            scrollTop: 0 ,
            }, scroll_top_duration
          );
        });

      });
    </script>
    <a href="#0" class="cd-top">Top</a>
    {{-- @include('partials.yesirads') --}}
    @include('partials.bet365')
    @include('partials.edugram')
  </body>
</html>
