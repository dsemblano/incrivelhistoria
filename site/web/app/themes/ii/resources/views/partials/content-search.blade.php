<article @php(post_class('row no-gutters'))>
  <figure class="col-sm">
    <a href="{{ get_permalink() }}"><?php echo (App\featured_image_url('mais_extendida')); ?></a>
  </figure>
  <header class="col-sm">
    @include('partials/entry-meta')
    <h2 class="entry-title"><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h2>
  </header>
</article>
