<?php

namespace App;

use Roots\Sage\Container;
use Illuminate\Contracts\Container\Container as ContainerContract;

/**
 * Get the sage container.
 *
 * @param string $abstract
 * @param array  $parameters
 * @param ContainerContract $container
 * @return ContainerContract|mixed
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
function sage($abstract = null, $parameters = [], ContainerContract $container = null)
{
    $container = $container ?: Container::getInstance();
    if (!$abstract) {
        return $container;
    }
    return $container->bound($abstract)
        ? $container->make($abstract, $parameters)
        : $container->make("sage.{$abstract}", $parameters);
}

/**
 * Get / set the specified configuration value.
 *
 * If an array is passed as the key, we will assume you want to set an array of values.
 *
 * @param array|string $key
 * @param mixed $default
 * @return mixed|\Roots\Sage\Config
 * @copyright Taylor Otwell
 * @link https://github.com/laravel/framework/blob/c0970285/src/Illuminate/Foundation/helpers.php#L254-L265
 */
function config($key = null, $default = null)
{
    if (is_null($key)) {
        return sage('config');
    }
    if (is_array($key)) {
        return sage('config')->set($key);
    }
    return sage('config')->get($key, $default);
}

/**
 * @param string $file
 * @param array $data
 * @return string
 */
function template($file, $data = [])
{
    return sage('blade')->render($file, $data);
}

/**
 * Retrieve path to a compiled blade view
 * @param $file
 * @param array $data
 * @return string
 */
function template_path($file, $data = [])
{
    return sage('blade')->compiledPath($file, $data);
}

/**
 * @param $asset
 * @return string
 */
function asset_path($asset)
{
    return sage('assets')->getUri($asset);
}

/**
 * Determine whether to show the sidebar
 * @return bool
 */
function display_sidebar()
{
    static $display;
    isset($display) || $display = apply_filters('sage/display_sidebar', false);
    return $display;
}

/**
 * Page titles
 * @return string
 */
function title()
{
    if (is_home()) {
        if ($home = get_option('page_for_posts', true)) {
            return get_the_title($home);
        }
        return __('Latest Posts', 'sage');
    }
    if (is_archive()) {
        return get_the_archive_title();
    }
    if (is_search()) {
        return sprintf(__('Search Results for %s', 'sage'), get_search_query());
    }
    if (is_404()) {
        return __('Not Found', 'sage');
    }
    return get_the_title();
}

// Check if post thumbnail exists using wp_get_attachment_url istead of has_post_thumbnail - by Daniel Semblano
function featured_image_url($size) {
    // Pega primeira imagem do body do post
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];
    // Pega imagem destacada
    $image_url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

    // Quando houver de fato uma imagem destacada ou quando o post tinha uma
    // imagem destacada antes mas foi apagada via Wordpress, ficando vazia mas
    // sendo substituída pelo plugin "Default featured image"
    if ( ! empty( $image_url ) ) {
        return the_post_thumbnail($size);
    }
    // Caso para os posts que tinham imagem destacada em outro banco mas as imagens
    // não estão no servidor, ficando sem imagem destacada no wordpress mas no
    // banco ainda aparece como tendo. Nesse caso, echoar a primeira imagem do
    // body do texto, onde ela vai ser a destacada
    elseif ( ! empty($first_img)) {
      global $_wp_additional_image_sizes;
      $height =  $_wp_additional_image_sizes[$size]['height'];
      $width = $_wp_additional_image_sizes[$size]['width'];
      echo '<img class="attachment-'.$size.' size-'.$size.' wp-post-image" width='.$width.' height='.$height.' src="' . $first_img . '" />';
          // $first_img = "/images/default.jpg";
          // return $first_img;
    }
    // Quando nenhum dos casos se aplica (ex post sem imagem no body e como ex acima ),
    // a imagem destacada será a default do plugin "Default featured image"
    else {
        $dfi= wp_get_attachment_image( get_option( 'dfi_image_id' ), $size, false, '' );
        echo $dfi;
    }
  // else {
  //   function dfi_posttype_wiki ( $dfi_id, $post_id ) {
  //     $post = get_post($post_id);
  //     return $dfi_id; // the image set in the media settings
  //     }
  //   add_filter( 'dfi_thumbnail_id', 'dfi_posttype_wiki', 10, 2 );
  // }
}
