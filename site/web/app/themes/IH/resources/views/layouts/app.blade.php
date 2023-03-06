<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('partials.head')
   <body @php body_class() @endphp>
    @include('partials.gtagbody')
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
    {{-- @include('partials.yesirads') --}}
    {{-- @include('partials.bet365') --}}
    {{-- @include('partials.edugram') --}}
  </body>
</html>
