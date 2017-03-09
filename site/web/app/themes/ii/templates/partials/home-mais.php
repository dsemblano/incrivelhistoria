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

    <?php else : ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php endif; ?>
  </div>


</section>

<?php
    $categories = get_categories();
    $count = 0;
    echo '<div class=row>';
    foreach ( $categories as $category ) {
      $args = array(
        'cat' => $category->term_id,
        'post_type' => 'post',
        'posts_per_page' => '3',
      );

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) { ?>

      <section class="col-md-6 cat-<?php echo $category->slug; echo (++$count%2 ? " odd" : " even"); ?>">
          <h2><?php echo $category->name; ?>:</h2>

          <?php while ( $query->have_posts() ) {

              $query->the_post();
              ?>

              <article id="post-<?php the_ID(); ?>" <?php post_class( 'category-listing' ); ?>>
                  <?php echo (App\featured_image_url('thumbnail')) ?>

                  <h3 class="entry-title">
                      <a href="<?php the_permalink(); ?>">
                          <?php the_title(); ?>
                      </a>
                  </h3>

                  <?php the_excerpt( __( 'Continue Reading <span class="meta-nav">&rarr;</span>', 'twentyfourteen' ) ); ?>

              </article>

          <?php } // end while ?>

      </section>
      <?php echo ($count%2 ? "" : "</div><div class=row>"); ?>

      <?php } // end if
      // Use reset to restore original query.
      wp_reset_postdata();
    }
 ?>
