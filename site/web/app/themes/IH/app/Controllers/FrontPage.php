<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class FrontPage extends Controller
{
    public function slideshow()
    {
        if (is_front_page()) {
            $array = [
                'category__not_in' => '24, 52',
                'post_type'=>'post',
                'post_status'=>'publish',
                'posts_per_page'=>4,
            ];

            return $query = new \WP_Query($array);
        }
    }

    public static function slideshowExcerpt()
    {
        $slideshow = (new self)->slideshow();
        while ($slideshow->have_posts()) {
            if (has_excerpt()) {
                return substr(get_the_excerpt(), 0, 450);
            } else {
                $content = apply_filters('get_the_content', get_the_content());
                $content = strip_tags($content);
                $content = mb_strimwidth($content, 0, 500, ' ...');
                $content = strip_shortcodes($content);
                return $content;
            }
            wp_reset_postdata();
        }
    }

    public function curiosidades()
    {
        if (is_front_page()) {
            $array = [
                'category_name' => 'curiosidades',
                'orderby' => 'rand',
                'posts_per_page'=>4
            ];

            return $query = new \WP_Query($array);
        }
    }

    public function historia()
    {
        if (is_front_page()) {
            $array = [
                'category_name' => 'historia-do-brasil',
                'orderby' => 'rand',
                'posts_per_page'=>3
            ];

            return $query = new \WP_Query($array);
        }
    }

    public function direitos()
    {
        if (is_front_page()) {
            $array = [
                'category_name' => 'direitos-humanos',
                'orderby' => 'rand',
                'posts_per_page'=>3
            ];

            return $query = new \WP_Query($array);
        }
    }

    public function batalhas()
    {
        if (is_front_page()) {
            $array = [
                'category_name' => 'batalhas-historicas',
                'orderby' => 'rand',
                'posts_per_page'=>3
            ];

            return $query = new \WP_Query($array);
        }
    }

    public function crime()
    {
        if (is_front_page()) {
            $array = [
                'category_name' => 'crime-organizado',
                'orderby' => 'rand',
                'posts_per_page'=>3
            ];

            return $query = new \WP_Query($array);
        }
    }
}
