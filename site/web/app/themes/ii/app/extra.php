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

// Menu responsivo
// function prefix_scripts() {
//
// 	// Enqueue responsive navigation.
// 	// wp_enqueue_script( 'prefix-navigation', get_template_directory_uri() . '/js/responsive-nav.js', array(), '1.38', true );
// 	wp_enqueue_script('prefix-navigation', asset_path('scripts/responsive-nav.js'), array(), '1.38', true);
//
// 	// Enqueue JS functions.
// 	wp_enqueue_script( 'prefix-script', get_template_directory_uri() . '/js/functions.js', array( 'prefix-navigation' ), '1.38', true );
// 	wp_localize_script( 'prefix-script', 'navSettings', array(
// 		'expand'    => '<span class="screen-reader-text">' . esc_html__( 'Expand child menu', 'textdomain' ) . '</span>',
// 		'collapse'  => '<span class="screen-reader-text">' . esc_html__( 'Collapse child menu', 'textdomain' ) . '</span>',
// 		'closeMenu' => esc_html__( 'Close menu', 'textdomain' ),
// 		'openMenu'  => esc_html__( 'Open menu', 'textdomain' ),
// 	) );
//
// }
// add_action( 'wp_enqueue_scripts', 'prefix_scripts' );
//
// /* == Navigation section == */
//
// 	// Add the navigation section.
// 	$wp_customize->add_section(
// 		'prefix-navigation',
// 		array(
// 			'title'    => esc_html__( 'Navigation settings', 'textdomain' ),
// 			'priority' => 10,
// 			'panel'    => 'theme'
// 		)
// 	);
//
// 	$wp_customize->add_setting(
// 		'disable_dropdown',
// 		array(
// 			'default'           => '',
// 			'sanitize_callback' => 'prefix_sanitize_checkbox'
// 		)
// 	);
//
// 	$wp_customize->add_control(
// 		'disable_dropdown',
// 		array(
// 			'label'       => esc_html__( 'Disable multi-level menu', 'textdomain' ),
// 			'description' => esc_html__( 'Check this if you want to disable multi-level dropdown in Primary menu.', 'textdomain' ),
// 			'section'     => 'prefix-navigation',
// 			'priority'    => 10,
// 			'type'        => 'checkbox'
// 		)
// 	);

 ?>
