<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Render comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );

    $data = collect(get_body_class())->reduce(function ($data, $class) use ($comments_template) {
        return apply_filters("sage/template/{$class}/data", $data, $comments_template);
    }, []);

    $theme_template = locate_template(["views/{$comments_template}", $comments_template]);

    if ($theme_template) {
        echo template($theme_template, $data);
        return get_stylesheet_directory().'/index.php';
    }

    return $comments_template;
}, 100);

// Mostrando sidebar - by Daniel Semblano
add_filter('sage/display_sidebar', function ($display) {
  static $display;

  isset($display) || $display = in_array(true, [
    // The sidebar will be displayed if any of the following return true
    is_single(),
    is_404(),
    is_front_page(),
    is_category(),
    is_page('categorias'),
    is_search(),
    is_tag(),
    is_page(),
    is_archive(),
    is_page_template('template-custom.php')
  ]);

  return $display;
});

// Custom search form
add_filter('get_search_form', function(){
$form = '';
// echo template(realpath(config('dir.template') . '/views/partials/searchform.blade.php'), []);
$path = get_template_directory(). '/views/partials/searchform.blade.php';
echo template(realpath($path), []);
return $form;
});

/**
 * Async load CSS
 */

 //echo env('WP_ENV');

if (env('WP_ENV') === 'development') {
  add_filter('style_loader_tag', function ($html, $handle, $href) {
      if (is_admin()) {
          return $html;
      }

      $dom = new \DOMDocument();
      $dom->loadHTML($html);
      $tag = $dom->getElementById($handle . '-css');
      $tag->setAttribute('rel', 'preload');
      $tag->setAttribute('as', 'style');
      $tag->setAttribute('onload', "this.onload=null;this.rel='stylesheet'");
      $tag->removeAttribute('type');
      $html = $dom->saveHTML($tag);

      return $html;
  }, 999, 3);
}

if (env('WP_ENV') === 'development') {
  add_action('wp_head', function () {
      $preload_script = get_theme_file_path() . '/resources/assets/scripts/cssrelpreload.js';

      if (fopen($preload_script, 'r')) {
          echo '<script>' . file_get_contents($preload_script) . '</script>';
      }
  }, 101);
}

/**
 * Inject critical assets in head as early as possible
 */
if (env('WP_ENV') === 'development') {
  add_action('wp_head', function () {
    $critical_CSS = asset_path('styles/critical.css');

    if (fopen($critical_CSS, 'r')) {
        echo '<style>' . file_get_contents($critical_CSS) . '</style>';
    }
  }, 1);
}

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
