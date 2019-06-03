<section id="mais-acessadas">
  <h3>Mais acessadas</h3>
  <ul>
    @if (! $popular_post->have_posts())
    <div class="alert alert-warning">
      {{ __('Desculpe, nenhum resultado encontrado.', 'sage') }}
    </div>
    @endif

    @while ($popular_post->have_posts()) @php $popular_post->the_post() @endphp
    <li>
      <a href={{ the_permalink() }}>{{ the_post_thumbnail('top10') }}</a>
    </li>
    @endwhile
  </ul>
  {{-- {!! wpb_set_post_views(get_the_ID()) !!} --}}
</section>
