<article @php(post_class())>
  <header>
    <h1 class="entry-title">{{ get_the_title() }}</h1>
    @include('partials/entry-meta')
  </header>
  <div class="entry-content">
    {{-- @php (App\featured_image_url('thumbnail')) --}}
    {{-- @php (the_post_thumbnail('thumbnail')) --}}
    {{-- {!! (App\featured_image_url('thumbnail')) !!} --}}
    @php(the_content())
  </div>
  <footer>
    {!! wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
  </footer>
  @php(comments_template('/templates/partials/comments.blade.php'))
</article>
