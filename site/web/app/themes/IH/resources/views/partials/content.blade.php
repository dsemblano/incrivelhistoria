<article @php post_class('row no-gutters') @endphp>
  <figure class="col-sm">
    <a href="{{ get_permalink() }}">{{ the_post_thumbnail('mais_extendida') }}</a>
  </figure>
  <header class="col-sm">
    @if (get_post_type() === 'post')
      @include('partials/entry-meta')
    @endif
    <h2 class="entry-title"><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h2>
  </header>
</article>
