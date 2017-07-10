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

 ?>
