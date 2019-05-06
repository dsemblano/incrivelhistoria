<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class App extends Controller
{
    public function siteName()
    {
        return get_bloginfo('name');
    }

    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'sage');
        }
        if (is_archive()) {
            if (is_author()) {
                return get_the_author_meta('display_name');
            } else {
                // return get_the_archive_title();
                return single_term_title();
            }
        }
        if (is_search()) {
            // return sprintf(__('Search Results for %s', 'sage'), get_search_query());
            return sprintf(__('Resultados da busca por %s', 'sage'), get_search_query());
        }
        if (is_404()) {
            // return __('Not Found', 'sage');
            return __('404 erro - Página não encontrada', 'sage');
        }
        return get_the_title();
    }
}
