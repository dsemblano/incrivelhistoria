<section id="mais">
<hr />

<div class="mais-extensao row">
    <section id="historia-do-brasil" class="col-sm">
      <h2>História do Brasil</h2>
    <?php
      $args = new WP_Query( array( 'category_name' => 'historia-do-brasil', 'orderby' => 'rand', 'posts_per_page'=>3 ) );
      if ( $args->have_posts() ): while ( $args->have_posts() ) : $args->the_post();
    ?>
      <article>
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

    <section id="direitos-humanos" class="col-sm">
      <h2>Direitos Humanos</h2>
    <?php
      $args = new WP_Query( array( 'category_name' => 'direitos-humanos', 'orderby' => 'rand', 'posts_per_page'=>3 ) );
      if ( $args->have_posts() ): while ( $args->have_posts() ) : $args->the_post();
    ?>
      <article>
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
</div>

<hr />

<div class="mais-extensao row">
  <section id="batalhas-historicas" class="col-sm">
      <h2>Batalhas Históricas</h2>
    <?php
      $args = new WP_Query( array( 'category_name' => 'batalhas-historicas', 'orderby' => 'rand', 'posts_per_page'=>3 ) );
      if ( $args->have_posts() ): while ( $args->have_posts() ) : $args->the_post();
    ?>
      <article>
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

  <section id="crime-organizado" class="col-sm">
    <h2>Crime Organizado</h2>
  <?php
    $args = new WP_Query( array( 'category_name' => 'crime-organizado', 'orderby' => 'rand', 'posts_per_page'=>3 ) );
    if ( $args->have_posts() ): while ( $args->have_posts() ) : $args->the_post();
  ?>
    <article>
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
</div>
<h2>Mais</h2>
<div class="row">
<?php
  $args = new WP_Query( array( 'category_name' => 'mais', 'orderby' => 'rand', 'posts_per_page'=>3 ) );
  if ( $args->have_posts() ): while ( $args->have_posts() ) : $args->the_post();
?>
  <article class="col-sm">
    <a href="<?php the_permalink(); ?>">
      <?php echo (App\featured_image_url('mais')); ?>
      <h3><?php the_title(); ?></h3>
    </a>
  </article>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
  <?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
  <?php endif; ?>
</div>

<!-- <span class="text-center">
  <a class="button" href="/categorias">Demais Matérias</a>
</span> -->

</section>
