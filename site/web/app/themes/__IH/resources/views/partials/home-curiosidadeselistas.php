
<section id="curiosidades">
  <h2>Curiosidades e Listas</h2>
  <div class="row">
    <?php
        $args = new WP_Query( array( 'category_name' => 'curiosidades', 'orderby' => 'rand', 'posts_per_page'=>4 ) );
        if ( $args->have_posts() ): while ( $args->have_posts() ) : $args->the_post();
    ?>

    <article class="col-sm-6">
      <a href="<?php the_permalink(); ?>">
          <?php echo (App\featured_image_url('mais_extendida')); ?>
        <h3><?php the_title(); ?></h3>
      </a>
    </article>
  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>
    <?php else : ?>
      <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php endif; ?>


</section>
