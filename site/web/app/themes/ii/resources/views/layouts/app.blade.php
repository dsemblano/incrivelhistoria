<!doctype html>
<html @php(language_attributes())>
  @include('partials.head')
  <body @php(body_class())>
    @include('partials.facebook')
    @php(do_action('get_header'))
    @include('partials.header')
    <div class="wrap container" role="document">
      <div class="content row">
        <main class="main col-sm-12 col-lg-8">
          @yield('content')
        </main>
        @if (App\display_sidebar())
          <aside class="sidebar col-sm-12 col-lg-4">
            <div>
              @include('partials.sidebar')
            </div>
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
