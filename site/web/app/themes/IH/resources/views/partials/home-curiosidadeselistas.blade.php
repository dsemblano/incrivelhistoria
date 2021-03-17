<section id="curiosidades">
  <h2>Curiosidades e Listas</h2>
  <div class="row">
    @if ($curiosidades->have_posts())
      @while ($curiosidades->have_posts()) @php $curiosidades->the_post() @endphp
    <article class="col-12 col-sm-6">
      <a href={{ the_permalink() }}>
        {{ the_post_thumbnail('mais_extendida') }}
        <h3>{{ the_title() }}</h3>
      </a>
    </article>
      @endwhile
    @else
      <div class="alert alert-warning">
        {{ __('Desculpe, nenhum resultado encontrado.', 'sage') }}
      </div>
    @endif
</section>

<section id="mais">
<hr />

<div class="mais-extensao row">
    <section id="historia-do-brasil" class="col-12 col-sm">
      <h2>História do Brasil</h2>
      @if ($historia->have_posts())
        @while ($historia->have_posts()) @php $historia->the_post() @endphp
        <article>
          <a href={{ the_permalink() }}>
            {{ the_post_thumbnail('mais_extendida') }}
            <h3>{{ the_title() }}</h3>
          </a>
        </article>
          @endwhile
      @else
        <div class="alert alert-warning">
          {{ __('Desculpe, nenhum resultado encontrado.', 'sage') }}
        </div>
      @endif
    </section>

    <section id="direitos-humanos" class="col-12 col-sm">
      <h2>Direitos Humanos</h2>
      @if ($direitos->have_posts())
        @while ($direitos->have_posts()) @php $direitos->the_post() @endphp
        <article>
          <a href={{ the_permalink() }}>
            {{ the_post_thumbnail('mais_extendida') }}
            <h3>{{ the_title() }}</h3>
          </a>
        </article>
        @endwhile
      @else
        <div class="alert alert-warning">
          {{ __('Desculpe, nenhum resultado encontrado.', 'sage') }}
        </div>
      @endif
    </section>
</div>

<hr />

<div class="mais-extensao row">
  <section id="batalhas-historicas" class="col-12 col-sm">
      <h2>Batalhas Históricas</h2>
      @if ($batalhas->have_posts())
        @while ($batalhas->have_posts()) @php $batalhas->the_post() @endphp
        <article>
          <a href={{ the_permalink() }}>
            {{ the_post_thumbnail('mais_extendida') }}
            <h3>{{ the_title() }}</h3>
          </a>
        </article>
        @endwhile
      @else
        <div class="alert alert-warning">
          {{ __('Desculpe, nenhum resultado encontrado.', 'sage') }}
        </div>
      @endif
    </section>

  <section id="crime-organizado" class="col-12 col-sm">
    <h2>Crime Organizado</h2>
      @if ($crime->have_posts())
        @while ($crime->have_posts()) @php $crime->the_post() @endphp
        <article>
          <a href={{ the_permalink() }}>
            {{ the_post_thumbnail('mais_extendida') }}
            <h3>{{ the_title() }}</h3>
          </a>
        </article>
        @endwhile
      @else
        <div class="alert alert-warning">
          {{ __('Desculpe, nenhum resultado encontrado.', 'sage') }}
        </div>
      @endif
  </section>
</div>
</section>
