<article @php(post_class())>
  <header>
    @if ( function_exists('yoast_breadcrumb') )
      {!! yoast_breadcrumb('<p id="breadcrumbs">','</p>', false)  !!}
    @endif
    <h1 class="entry-title">{{ get_the_title() }}</h1>
    @include('partials/entry-meta')
  </header>
  <div class="entry-content">
    @php(the_content())
  </div>
  <footer>
    {{-- {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!} --}}
    <div class="fb-comments" data-href="https://incrivelhistoria.com.br" data-numposts="10"></div>
  </footer>
  {{-- @php(comments_template('/partials/comments.blade.php')) --}}
</article>
