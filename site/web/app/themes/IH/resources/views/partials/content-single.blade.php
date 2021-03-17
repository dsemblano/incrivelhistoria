<article @php post_class() @endphp>
  <header>
    @include('partials/breadcrumbs')
    <h1 class="entry-title">{{ get_the_title() }}</h1>
    @include('partials/entry-meta')
  </header>
  <div class="entry-content">
    @php the_content() @endphp
  </div>
  <footer>
    {{-- {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!} --}}
    <div class="fb-comments" data-width="auto" data-numposts="10"></div>
  </footer>
  {{-- @php comments_template('/partials/comments.blade.php') @endphp --}}
</article>
