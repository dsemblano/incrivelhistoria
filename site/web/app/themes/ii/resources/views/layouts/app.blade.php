<!doctype html>
<html @php(language_attributes())>
  @include('partials.head')
  <body @php(body_class())>
    @include('partials.facebook')
    @php(do_action('get_header'))
    @include('partials.header')
    <div class="wrap container" role="document">
      <div class="content row">
        <main class="main col-12 col-sm-8 col-md-12 col-lg-8">
          @yield('content')
        </main>
        @if (App\display_sidebar())
          <aside id="sidebar" class="sidebar col-12 col-sm-4 col-md-12 col-lg-4">
            @include('partials.sidebar')
            {{-- {!! do_shortcode( '[tptn_list limit=5 disp_list_count=0]' ) !!} --}}
          </aside>
        @endif
      </div>
    </div>
    @php(do_action('get_footer'))
    @include('partials.footer')
    @php(wp_footer())
    @include('partials.analytics')
  </body>
</html>
