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

    <ul>
      @if ( $query->have_posts() )
      <div class="page-header {{ $category->slug }}">
        <a href={{ esc_url(get_category_link($category->cat_ID)) }}>
          <h2>{{ $category->name }}:</h2>
        </a>
        <hr />
      </div>
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
              <a href={{ esc_url(get_category_link($subcategory->cat_ID)) }}>
                <h3> {{ $subcategory->cat_name }}</h3>
              </a>
              @include('partials.content')
            @endwhile
          {{-- fim loop subcategorias --}}
          @endforeach
        @endwhile
      @endif
    </ul>
  @endforeach
@endsection
