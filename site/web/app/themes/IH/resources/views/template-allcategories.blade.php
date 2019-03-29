{{--
  Template Name: All Categories Template
--}}

@extends('layouts.app')

@section('content')
  @php
    $args = array('orderby' => 'name', 'parent' => 0);
    $categories = get_categories( $args );
  @endphp

  {{-- Categorias pai --}}
  @foreach ($categories as $category)
    {{-- <h2>{{ $category->cat_name}}</h2> --}}
    @php
      $args_posts = array(
        'cat' => $category->term_id,
        'orderby' => 'name',
        'post_type' => 'post',
        'posts_per_page' => '1',
      );
      $query = new WP_Query( $args_posts );
    @endphp
    @php
      $args2 = array('orderby' => 'name', 'parent' => $category->cat_ID);
      $subcategories = get_categories( $args2 );
    @endphp

    @if ( $query->have_posts() )
    <div class="page-header">
      <h2>
        <a class="header-link" href={{ esc_url(get_category_link($category->cat_ID)) }}>
          {{ $category->name }}:
        </a>
      </h2>
    </div>
    <section id="{{ $category->slug }}-page" class="category-parent row">
        @while ( $query->have_posts() )
        @php $query->the_post() @endphp
          {{-- Sub categorias --}}
          @foreach ($subcategories as $subcategory)
            @php
              $sub_args_posts = array(
                'cat' => $subcategory->term_id,
                'orderby' => 'name',
                'post_type' => 'post',
                'posts_per_page' => '1',
              );
              $query_subcategory = new WP_Query( $sub_args_posts );
            @endphp

            @while ( $query_subcategory->have_posts() )
            @php $query_subcategory->the_post() @endphp
              {{-- <h3>{{ $category->name }}:</h3> --}}
              <article {{ post_class('col-sm') }} >
                <h3>
                  <a class="header-link" href={{ esc_url(get_category_link($subcategory->cat_ID)) }}>
                    {{ $subcategory->cat_name }}
                  </a>
                </h3>
                <figure>
                    <a class="header-link" href={{ esc_url(get_category_link($subcategory->cat_ID)) }}>
                      {{ the_post_thumbnail('curiosidades_small') }}
                    </a>
                </figure>
                {{-- <h4 class="entry-title">
                  <a class="header-link" href="{{ get_permalink() }}">
                    {{ get_the_title() }}
                  </a>
                </h4> --}}
                </article>
            @endwhile
          {{-- fim loop subcategorias --}}
          @endforeach
        @endwhile
    </section>
    @endif
  @endforeach
@endsection
