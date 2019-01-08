<?php

namespace App;

use Roots\Sage\Container;

/**
 * Get the sage container.
 *
 * @param string $abstract
 * @param array  $parameters
 * @param Container $container
 * @return Container|mixed
 */
function sage($abstract = null, $parameters = [], Container $container = null)
{
    $container = $container ?: Container::getInstance();
    if (!$abstract) {
        return $container;
    }
    return $container->bound($abstract)
        ? $container->makeWith($abstract, $parameters)
        : $container->makeWith("sage.{$abstract}", $parameters);
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
    if (!is_admin() && remove_action('wp_head', 'wp_enqueue_scripts', 1)) {
        wp_enqueue_scripts();
    }

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
 * @param string|string[] $templates Possible template files
 * @return array
 */
function filter_templates($templates)
{
    $paths = apply_filters('sage/filter_templates/paths', [
        'views',
        'resources/views'
    ]);
    $paths_pattern = "#^(" . implode('|', $paths) . ")/#";

    return collect($templates)
        ->map(function ($template) use ($paths_pattern) {
            /** Remove .blade.php/.blade/.php from template names */
            $template = preg_replace('#\.(blade\.?)?(php)?$#', '', ltrim($template));

            /** Remove partial $paths from the beginning of template names */
            if (strpos($template, '/')) {
                $template = preg_replace($paths_pattern, '', $template);
            }

            return $template;
        })
        ->flatMap(function ($template) use ($paths) {
            return collect($paths)
                ->flatMap(function ($path) use ($template) {
                    return [
                        "{$path}/{$template}.blade.php",
                        "{$path}/{$template}.php",
                    ];
                })
                ->concat([
                    "{$template}.blade.php",
                    "{$template}.php",
                ]);
        })
        ->filter()
        ->unique()
        ->all();
}

/**
 * @param string|string[] $templates Relative path to possible template files
 * @return string Location of the template
 */
function locate_template($templates)
{
    return \locate_template(filter_templates($templates));
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


// Check if post thumbnail exists using wp_get_attachment_url istead of has_post_thumbnail - by Daniel Semblano
function featured_image_url($size) {
    // Pega primeira imagem do body do post
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    if (!empty($output)) {
      $first_img = $matches [1] [0];
    }
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
