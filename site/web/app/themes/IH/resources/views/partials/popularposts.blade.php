<section id="mais-acessadas">
<h3>Mais acessadas</h3>
  <ul>
  @php
    $popularpost = new WP_Query( array( 'posts_per_page' => 5, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
    while ( $popularpost->have_posts() ) : $popularpost->the_post();
  @endphp
    <li>
      <a href="<?php the_permalink(); ?>">
        <?php //echo (App\featured_image_url('top10')); 
        the_post_thumbnail('top10');
        ?>
      </a>
    </li>
  @php
    endwhile;
  @endphp
  </ul>

{{-- {!! wpb_set_post_views(get_the_ID()) !!} --}}

</section>
