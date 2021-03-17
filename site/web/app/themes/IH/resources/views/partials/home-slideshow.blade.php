<section id="carousel" class="main-carousel" data-flickity='{ "cellAlign": "left", "contain": true, "wrapAround": true, "lazyLoad": true, "setGallerySize": false, "autoPlay": true, "dragThreshold": 20 }'>
  @if ($slideshow->have_posts())
    @while ($slideshow->have_posts()) @php $slideshow->the_post() @endphp
        <div class="carousel-cell">
            <a href={{ the_permalink() }}>
              {{ the_post_thumbnail('slideshow') }}
              <header>
                <h2>{{ the_title() }}</h2>
                <p>{{ FrontPage::slideshowExcerpt() }}</p>
              </header>
            </a>
        </div>
    @endwhile
  @else
    <div class="alert alert-warning">
      {{ __('Desculpe, nenhum resultado encontrado.', 'sage') }}
    </div>
  @endif

</section>
