<section id="mais">
  <h2>Mais</h2>
  <div class="row">
  <?php
    $args = new WP_Query( array( 'category_name' => 'mais', 'orderby' => 'rand', 'posts_per_page'=>3 ) );
    if ( $args->have_posts() ): while ( $args->have_posts() ) : $args->the_post();
  ?>
    <article class="col-md-4">
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
</section>

<section id="mais-extensao" class="row">
  <div class="mais_esquerda col-md-6">
    <section id="historia-do-brasil">
      <h2>História do Brasil</h2>
    <?php
      $args = new WP_Query( array( 'category_name' => 'historia-do-brasil', 'orderby' => 'rand', 'posts_per_page'=>4 ) );
      $row = 1;
      if ( $args->have_posts() ): while ( $args->have_posts() ) : $args->the_post();
    ?>
      <article>
        <a class="<?=$row; ?>" href="<?php the_permalink(); ?>">
          <?php if ($row == 1): ?>
            <?php echo (App\featured_image_url('mais_extendida')); ?>
          <?php endif; ++$row; ?>
          <h3><?php the_title(); ?></h3>
        </a>
      </article>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
      <?php else : ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
      <?php endif; ?>
    </section>

    <section id="batalhas-historicas">
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

  </div>

  <div class="mais_direita col-md-6">
    <section id="direitos-humanos">
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

    <section id="crime-organizado">
      <h2>Crime Organizado</h2>
    <?php
      $args = new WP_Query( array( 'category_name' => 'crime-organizado', 'orderby' => 'rand', 'posts_per_page'=>4 ) );
      $row = 1;
      if ( $args->have_posts() ): while ( $args->have_posts() ) : $args->the_post();
    ?>
      <article>
        <a class="<?=$row; ?>" href="<?php the_permalink(); ?>">
          <?php if ($row == 1): ?>
            <?php echo (App\featured_image_url('mais_extendida')); ?>
          <?php endif; ++$row; ?>
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
  <a class="button text-center" href="/categorias">Demais Matérias</a>
</section>
