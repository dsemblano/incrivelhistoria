
<section id="curiosidades">
  <h2>Curiosidades e Listas</h2>
  <div class="row">
    <?php
        $args = new WP_Query( array( 'category_name' => 'curiosidades', 'posts_per_page'=>4 ) ); $i = 0;
        if ( $args->have_posts() ): while ( $args->have_posts() ) : $args->the_post(); $i++;
    ?>

    <?php if ($i == 1): ?>
    <div class="col-md-8">
      <article>
        <a href="<?php the_permalink(); ?>">
            <?php echo (App\featured_image_url('large')); ?>
            <h3><?php the_title(); ?></h3>
        </a>
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
      </article>
    </div>
      <div class="col-md-4">
      <?php else : ?>
        <article>
            <a href="<?php the_permalink(); ?>">
                <?php echo (App\featured_image_url('thumbnail_curiosidades')); ?>
                  <h4><?php the_title(); ?></h4>
            </a>
        </article>
      <?php endif; ?>
      <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>
      </div>
    <?php else : ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php endif; ?>
  </div>


</section>
