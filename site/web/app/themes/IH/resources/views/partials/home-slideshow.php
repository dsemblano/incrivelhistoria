<section id="carousel" class="main-carousel" data-flickity='{ "cellAlign": "left", "contain": true, "wrapAround": true, "lazyLoad": true, "setGallerySize": false, "autoPlay": true, "dragThreshold": 20 }'>
    <?php $wpb_all_query = new WP_Query(array('category__not_in' => array( 24, 52 ), 'post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>4)); ?>
    <?php if ( $wpb_all_query->have_posts() ) : ?>
        <?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
            <div class="carousel-cell">
                <a href="<?php the_permalink(); ?>">
                    <?php //the_post_thumbnail('slideshow2'); ?>
                    <?php echo (App\featured_image_url('slideshow')); ?>
                    <header>
                      <h2><?php the_title(); ?></h2>
                      <?php
                          if (!has_excerpt()) {
                          $content = apply_filters('get_the_content', get_the_content());
                          $content = strip_tags($content);
                          $content = mb_strimwidth($content, 0, 500, '...');
                          echo '<p>' . $content . '</p>';
                          } else {
                              echo '<p>' . substr(get_the_excerpt(), 0,450) . '...' . '</p>';
                          }
                      ?>
                    </header>
                </a>
            </div>
        <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>

    <?php else : ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
    <?php endif; ?>

</section>
