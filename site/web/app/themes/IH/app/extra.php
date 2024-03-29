<?php

// Retirando css pop-up maker já que é carregado pelo Sage
function popupmaker_dequeue_style()
{
    wp_dequeue_style('popup-maker-site');
}

function action_popupmaker_dequeue_style()
{
    add_action('wp_enqueue_scripts', 'popupmaker_dequeue_style', 999);
}

add_action('init', 'action_popupmaker_dequeue_style');

// Retirar css e js da home do pĺugin sassy-social-share
function heateor_sss_dequeue_scripts_and_styles()
{
    if (! is_single()) {
        wp_dequeue_script('heateor_sss_sharing_js');
        wp_dequeue_style('heateor_sss_frontend_css');
        wp_dequeue_style('heateor_sss_sharing_svg');
        wp_dequeue_style('heateor_sss_sharing_svg_hover');
        wp_dequeue_style('heateor_sss_vertical_sharing_svg');
        wp_dequeue_style('heateor_sss_vertical_sharing_svg_hover');
        wp_dequeue_style('heateor_sss_sharing_default_svg');
    }
}

function heateor_sss_dequeue_javascript()
{
    add_action('wp_enqueue_scripts', 'heateor_sss_dequeue_scripts_and_styles', 999);
}

add_action('init', 'heateor_sss_dequeue_javascript');

// Classe para menu page
add_filter('nav_menu_css_class', 'special_nav_class', 10, 3);
function special_nav_class($classes, $item, $args)
{
    if (('primary_navigation' === $args->theme_location) && ('menu-page' === $args->menu_id)) {
        $classes[] = 'col-4';
    }

    return $classes;
}

// print handler names
// add_action('wp_print_scripts', 'wsds_detect_enqueued_scripts');
// function wsds_detect_enqueued_scripts()
// {
//     global $wp_scripts;
//     foreach ($wp_scripts->queue as $handle) :
//         echo "AQUI: ". $handle . ' | ';
//     endforeach;
// }

// add_filter('script_loader_tag', 'cameronjonesweb_add_script_handle', 10, 3);
// function cameronjonesweb_add_script_handle($tag, $handle, $src)
// {
//     return str_replace('<script', sprintf(
//         '<script data-handle="%1$s"',
//         esc_attr($handle)
//     ), $tag);
// }

add_filter('script_loader_tag', 'cameronjonesweb_add_script_handle', 10, 3);
function cameronjonesweb_add_script_handle($tag, $handle, $src)
{
    return str_replace('<script', sprintf(
        '<script',
        esc_attr($handle)
    ), $tag);
}

// defer async
// function jquery_async_defer_attribute($tag, $handle)
// {
//     if ('jquery-core' !== $handle) {
//         return $tag;
//     }
//     return str_replace(' src', ' async src', $tag);
// }
// add_filter('script_loader_tag', 'jquery_async_defer_attribute', 10, 2);

// function top10_async_defer_attribute($tag, $handle){
//   if ( 'tptn_tracker' !== $handle )
//   return $tag;
//   return str_replace( ' src', ' async defer src', $tag );
// }
// add_filter('script_loader_tag', 'top10_async_defer_attribute', 10, 2);

function wpb_author_info_box($content)
{
    global $post;

    // Detect if it is a single post with a post author
    if (is_single() && isset($post->post_author)) {
        // Get author's display name
        $display_name = get_the_author_meta('display_name', $post->post_author);

        // If display name is not available then use nickname as display name
        if (empty($display_name)) {
            $display_name = get_the_author_meta('nickname', $post->post_author);
        }

        // Get author's biographical information or description
        $user_description = get_the_author_meta('user_description', $post->post_author);

        // Get author's website URL
        $user_website = get_the_author_meta('url', $post->post_author);

        // Get link to the author archive page
        $user_posts = get_author_posts_url(get_the_author_meta('ID', $post->post_author));

        if (! empty($display_name)) {
            $author_details = '<h6 class="author_name">Autor: ' . $display_name . '</h6>';
        }

        if (! empty($user_description)) {
            // Author avatar and bio

            $author_details .= '<div class="author_details row"">' . '<figure class="col-sm-2 col-md-2 col-lg-2">' . get_avatar(get_the_author_meta('user_email'), 90) . '<a href="https://www.facebook.com/eudes.bezerra.37" target="_blank" rel="noopener"><img id="facebook_author" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjE2cHgiIGhlaWdodD0iMTZweCIgdmlld0JveD0iMCAwIDYwLjczNCA2MC43MzMiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDYwLjczNCA2MC43MzM7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8cGF0aCBkPSJNNTcuMzc4LDAuMDAxSDMuMzUyQzEuNTAyLDAuMDAxLDAsMS41LDAsMy4zNTN2NTQuMDI2YzAsMS44NTMsMS41MDIsMy4zNTQsMy4zNTIsMy4zNTRoMjkuMDg2VjM3LjIxNGgtNy45MTR2LTkuMTY3aDcuOTE0ICAgdi02Ljc2YzAtNy44NDMsNC43ODktMTIuMTE2LDExLjc4Ny0xMi4xMTZjMy4zNTUsMCw2LjIzMiwwLjI1MSw3LjA3MSwwLjM2djguMTk4bC00Ljg1NCwwLjAwMmMtMy44MDUsMC00LjUzOSwxLjgwOS00LjUzOSw0LjQ2MiAgIHY1Ljg1MWg5LjA3OGwtMS4xODcsOS4xNjZoLTcuODkydjIzLjUyaDE1LjQ3NWMxLjg1MiwwLDMuMzU1LTEuNTAzLDMuMzU1LTMuMzUxVjMuMzUxQzYwLjczMSwxLjUsNTkuMjMsMC4wMDEsNTcuMzc4LDAuMDAxeiIgZmlsbD0iIzAwNkRGMCIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" /></a>' . '</figure>' . '<p class="col-sm-10 col-md-10 col-lg-10">' . ($user_description) . '</p>'. '<a class="author_links offset-md-2" href="'. $user_posts .'">Publicações de ' . $display_name . '</a>';
        }

        // $author_details .= '<div class="author_links row""><a class="col-sm-8 col-md-8 col-lg-8" href="'. $user_posts .'">Publicações de ' . $display_name . '</a>';

        // Check if author has a website in their profile
        if (! empty($user_website)) {
            // Display author website link
            $author_details .= ' | <a href="' . $user_website .'" target="_blank" rel="nofollow noopener">Website</a></div>';
        } else {
            // if there is no author website then just close the paragraph
            $author_details .= '</div>';
        }

        // Pass all this info to post content
        $content = $content . '<footer class="author_bio_section container" >' . $author_details . '</footer>';
    }
    return $content;
}

  // Add our function to the post content filter
  add_action('the_content', 'wpb_author_info_box');

  // Allow HTML in author bio section
  remove_filter('pre_user_description', 'wp_filter_kses');

  // function my_deregister_styles() {
  //   //wp_deregister_style( 'amethyst-dashicons-style' );
  //   wp_deregister_style( 'dashicons' );
  // }

// remove dashicons
// function wpdocs_dequeue_dashicon() {
// 	if (current_user_can( 'update_core' )) {
// 	    return;
// 	}
// 	wp_deregister_style('dashicons');
// }
// add_action( 'wp_enqueue_scripts', 'wpdocs_dequeue_dashicon' );

  //
//   function remove_head_scripts() {
//     remove_action('wp_head', 'wp_print_scripts');
//     remove_action('wp_head', 'wp_print_head_scripts', 9);
//     remove_action('wp_head', 'wp_enqueue_scripts', 1);
//     add_action('wp_footer', 'wp_print_scripts', 5);
//     add_action('wp_footer', 'wp_enqueue_scripts', 5);
//     add_action('wp_footer', 'wp_print_head_scripts', 5);
//  }
//  add_action( 'wp_enqueue_scripts', 'remove_head_scripts' );

//Contact Form 7
// add_action( 'wp_print_scripts', 'deregister_cf7_javascript', 100 );
// function deregister_cf7_javascript() {
//     if ( !is_page('contato') ) {
//         wp_deregister_script( 'contact-form-7' );
//     }
// }

// add_action( 'wp_print_styles', 'deregister_cf7_styles', 100 );
// function deregister_cf7_styles() {
//     if ( !is_page('contato') ) {
//         wp_deregister_style( 'contact-form-7' );
//     }
// }

// lazy load plugins desregistrando pois os js já estão no main.js
// add_action( 'wp_print_scripts', 'deregister_tptn_tracker_javascript', 100 );
//   function deregister_tptn_tracker_javascript() {
// wp_deregister_script( 'tptn_tracker' );
// }

// add_action( 'wp_print_styles', 'deregister_lazyloadxt_styles', 100 );
// function deregister_lazyloadxt_styles() {
//   wp_deregister_style( 'jquery-lazyloadxt-spinner-css' );
// }

function my_login_logo_one()
{
    $imgpath = \App\asset_path('images/IHlogo.png');
    $img_custom = <<<HTML
  <style type="text/css">
    body.login div#login h1 a {
    background-image:url($imgpath);
    width: 100%;
    padding: 0;
    background-size: cover;
    height: 150px;
    }
  </style>
HTML;
    echo $img_custom;
} add_action('login_enqueue_scripts', 'my_login_logo_one');

function the_url($url)
{
    return get_bloginfo('url');
}
add_filter('login_headerurl', 'the_url');

// remove yoast comments
// add_action('template_redirect', function () {
//     if (! class_exists('WPSEO_Frontend')) {
//         return;
//     }

//     $instance = WPSEO_Frontend::get_instance();

//     // make sure, future version of the plugin does not break our site.
//     if (! method_exists($instance, 'debug_mark')) {
//         return ;
//     }

//     // ok, let us remove the love letter.
//     remove_action('wpseo_head', array( $instance, 'debug_mark' ), 2);
// }, 9999);

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

//Remove JQuery migrate
function remove_jquery_migrate($scripts)
{
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];

        if ($script->deps) { // Check whether the script has any dependencies
            $script->deps = array_diff($script->deps, array(
                'jquery-migrate'
            ));
        }
    }
}

add_action('wp_default_scripts', 'remove_jquery_migrate');

//Disable gutenberg style in Front
// function wps_deregister_styles()
// {
//     wp_dequeue_style('wp-block-library');
// }
// add_action('wp_print_styles', 'wps_deregister_styles', 100);

// Disable wp-embed.js
function my_deregister_scripts()
{
    wp_deregister_script('wp-embed');
}
add_action('wp_footer', 'my_deregister_scripts');

// popular posts without using plugins
function wpb_set_post_views($postID)
{
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count=='') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function wpb_track_post_views($post_id)
{
    if (!is_single()) {
        return;
    }
    if (empty($post_id)) {
        global $post;
        $post_id = $post->ID;
    }
    wpb_set_post_views($post_id);
}
add_action('wp_head', 'wpb_track_post_views');

//removing WP version
remove_action('wp_head', 'wp_generator');

// removing WP version from RSS
function remove_wp_version_rss()
{
    return'';
}
add_filter('the_generator', 'remove_wp_version_rss');
