<?php

// Retirar css e js da home do pĺugin sassy-social-share
function heateor_sss_dequeue_scripts_and_styles() {
	if ( ! is_single() ) {
		wp_dequeue_script( 'heateor_sss_sharing_js' );
		wp_dequeue_style( 'heateor_sss_frontend_css' );
		wp_dequeue_style( 'heateor_sss_sharing_svg' );
		wp_dequeue_style( 'heateor_sss_sharing_svg_hover' );
		wp_dequeue_style( 'heateor_sss_vertical_sharing_svg' );
		wp_dequeue_style( 'heateor_sss_vertical_sharing_svg_hover' );
		wp_dequeue_style( 'heateor_sss_sharing_default_svg' );
	}
}

function heateor_sss_dequeue_javascript() {
		add_action( 'wp_enqueue_scripts', 'heateor_sss_dequeue_scripts_and_styles' );
}

add_action( 'init', 'heateor_sss_dequeue_javascript' );



// Contact Form 7
add_action( 'wp_print_scripts', 'deregister_cf7_javascript', 100 );
function deregister_cf7_javascript() {
    if ( !is_page('contato') ) {
        wp_deregister_script( 'contact-form-7' );
    }
}

add_action( 'wp_print_styles', 'deregister_cf7_styles', 100 );
function deregister_cf7_styles() {
    if ( !is_page('contato') ) {
        wp_deregister_style( 'contact-form-7' );
    }
}

// Classe para menu page
add_filter( 'nav_menu_css_class', 'special_nav_class', 10, 3 );
function special_nav_class( $classes, $item, $args ) {
    if ( ('primary_navigation' === $args->theme_location) && ('menu-page' === $args->menu_id) ) {
        $classes[] = 'col-3';
    }

    return $classes;
}

// defer async
function jquery_async_defer_attribute($tag, $handle){
  if ( 'jquery' !== $handle )
  return $tag;
  return str_replace( ' src', ' async defer src', $tag );
}
add_filter('script_loader_tag', 'jquery_async_defer_attribute', 10, 2);

function top10_async_defer_attribute($tag, $handle){
  if ( 'tptn_tracker' !== $handle )
  return $tag;
  return str_replace( ' src', ' async defer src', $tag );
}
add_filter('script_loader_tag', 'top10_async_defer_attribute', 10, 2);
