<section id="mais">
  <h2>Mais</h2>
  <div class="row">
  <?php
    $args = new WP_Query( array( 'category_name' => 'mais', 'orderby' => 'rand', 'posts_per_page'=>3 ) );
    if ( $args->have_posts() ): while ( $args->have_posts() ) : $args->the_post();
  ?>
    <article class="col-md-4">
      <a href="<?php the_permalink(); ?>">
        <?php echo (App\featured_image_url('thumb-mais')); ?>
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
      $args = new WP_Query( array( 'category_name' => 'historia-do-brasil', 'orderby' => 'rand', 'posts_per_page'=>1 ) );
      if ( $args->have_posts() ): while ( $args->have_posts() ) : $args->the_post();
    ?>
      <article>
        <a href="<?php the_permalink(); ?>">
          <?php echo (App\featured_image_url('thumb-mais')); ?>
          <h3><?php the_title(); ?></h3>
          <?php
              if (!has_excerpt()) {
              $content = apply_filters('get_the_content', get_the_content());
              $content = strip_tags($content);
              $content = mb_strimwidth($content, 0, 500, ' ...');
              echo '<p>' . $content . '</p>';
              } else {
              echo '<p>' . substr(get_the_excerpt(), 0, 450) . '...' . '</p>';
              }
          ?>
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
          <?php echo (App\featured_image_url('thumb-mais')); ?>
          <h3><?php the_title(); ?></h3>
          <?php
              if (!has_excerpt()) {
              $content = apply_filters('get_the_content', get_the_content());
              $content = strip_tags($content);
              $content = mb_strimwidth($content, 0, 500, ' ...');
              echo '<p>' . $content . '</p>';
              } else {
              echo '<p>' . substr(get_the_excerpt(), 0, 450) . '...' . '</p>';
              }
          ?>
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
          <?php echo (App\featured_image_url('thumb-mais')); ?>
          <h3><?php the_title(); ?></h3>
          <?php
              if (!has_excerpt()) {
              $content = apply_filters('get_the_content', get_the_content());
              $content = strip_tags($content);
              $content = mb_strimwidth($content, 0, 500, ' ...');
              echo '<p>' . $content . '</p>';
              } else {
              echo '<p>' . substr(get_the_excerpt(), 0, 450) . '...' . '</p>';
              }
          ?>
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
      $args = new WP_Query( array( 'category_name' => 'crime-organizado', 'orderby' => 'rand', 'posts_per_page'=>1 ) );
      if ( $args->have_posts() ): while ( $args->have_posts() ) : $args->the_post();
    ?>
      <article>
        <a href="<?php the_permalink(); ?>">
          <?php echo (App\featured_image_url('thumb-mais')); ?>
          <h3><?php the_title(); ?></h3>
          <?php
              if (!has_excerpt()) {
              $content = apply_filters('get_the_content', get_the_content());
              $content = strip_tags($content);
              $content = mb_strimwidth($content, 0, 500, ' ...');
              echo '<p>' . $content . '</p>';
              } else {
              echo '<p>' . substr(get_the_excerpt(), 0, 450) . '...' . '</p>';
              }
          ?>
        </a>
      </article>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
      <?php else : ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
      <?php endif; ?>
    </section>

  </div>

</section>
