<?php
/*
  Plugin Name: plugin load filter [plf-filter]
  Description: Dynamically activated only plugins that you have selected in each page. [Note] plf-filter has been automatically installed / deleted by Activate / Deactivate of "load filter plugin".
  Version: 2.5.1
  Plugin URI: http://celtislab.net/wp_plugin_load_filter
  Author: enomoto@celtislab
  Author URI: http://celtislab.net/
  License: GPLv2
*/
defined( 'ABSPATH' ) || exit;

/***************************************************************************
 * pluggable.php defined function overwrite 
 * pluggable.php read before the query_posts () is processed by the current user undetermined
 **************************************************************************/
if ( !function_exists('wp_get_current_user') ) :
/**
 * Retrieve the current user object.
 * @return WP_User Current user WP_User object
 */
function wp_get_current_user() {
	if ( ! function_exists( 'wp_set_current_user' ) )
		return 0;
    //get_currentuserinfo is deprecated since version 4.5
    if ( version_compare( $GLOBALS['wp_version'], '4.5', '<' ) ){
        global $current_user;
        get_currentuserinfo();
        return $current_user;
    }
    else {
        return _wp_get_current_user();
    }
}
endif;

if ( !function_exists('get_userdata') ) :
/**
 * Retrieve user info by user ID.
 * @param int $user_id User ID
 * @return WP_User|bool WP_User object on success, false on failure.
 */
function get_userdata( $user_id ) {
	return get_user_by( 'id', $user_id );
}
endif;

if ( !function_exists('get_user_by') ) :
/**
 * Retrieve user info by a given field
 * @param string $field The field to retrieve the user with. id | slug | email | login
 * @param int|string $value A value for $field. A user ID, slug, email address, or login name.
 * @return WP_User|bool WP_User object on success, false on failure.
 */
function get_user_by( $field, $value ) {
	$userdata = WP_User::get_data_by( $field, $value );

	if ( !$userdata )
		return false;

	$user = new WP_User;
	$user->init( $userdata );

	return $user;
}
endif;

if ( !function_exists('is_user_logged_in') ) :
/**
 * Checks if the current visitor is a logged in user.
 * @return bool True if user is logged in, false if not logged in.
 */
function is_user_logged_in() {
	if ( ! function_exists( 'wp_set_current_user' ) )
		return false;
        
	$user = wp_get_current_user();

	if ( ! $user->exists() )
		return false;

	return true;
}
endif;

/***************************************************************************
 * Plugin Load Filter( Admin, Desktop, Mobile, Page 4types filter) 
 **************************************************************************/

if(in_array( 'plugin-load-filter/plugin-load-filter.php', (array) get_option( 'active_plugins', array() ) )){
    $plugin_load_filter = new Plf_filter();
}
elseif ( is_multisite() ) {            
	$plugins = get_site_option( 'active_sitewide_plugins');
	if ( isset($plugins['plugin-load-filter/plugin-load-filter.php']) ){
        $plugin_load_filter = new Plf_filter();
    }
}

class Plf_filter {
    
    private $filter = array();  //Plugin Load Filter Setting option data
    private $cache;

    function __construct() {    
        $this->filter = get_option('plf_option');
        //v2.3.0 option change
        if(empty($this->filter['optver']) || $this->filter['optver'] < '2'){
            //For ver2.2.0 compatibility, set '_pagefilter' data to 'desktop' and 'mobile'
            if(empty($this->filter['group']['desktop']) && empty($this->filter['group']['mobile'])){
                if(!empty($this->filter['_pagefilter'])){
                    $this->filter['group']['desktop'] = $this->filter['_pagefilter'];
                    $this->filter['group']['mobile']  = $this->filter['_pagefilter'];
                }
            }
        }
        
        $this->cache  = null;
        if(!empty($this->filter)){
            if ( is_multisite() ) {
                add_filter('pre_site_option_active_sitewide_plugins', array(&$this, 'active_sitewide_plugins'));
            }
            add_filter('pre_option_active_plugins', array(&$this, 'active_plugins'));
            add_filter('pre_option_jetpack_active_modules', array(&$this, 'active_jetmodules'));
            add_filter('pre_option_celtispack_active_modules', array(&$this, 'active_celtismodules'));
            add_action('wp_loaded', array(&$this, 'cache_post_type'), 1);
        }
    }
    
    //active_sitewide plugins Filter add ver2.4.0
    function active_sitewide_plugins( $default = false) {
        return $this->plf_filter( 'active_sitewide_plugins', $default);
    }

    //active plugins Filter
    function active_plugins( $default = false) {
        return $this->plf_filter( 'active_plugins', $default);
    }

    //Jetpack module Filter
    function active_jetmodules( $default = false) {
        return $this->plf_filter( 'jetpack_active_modules', $default);
    }

    //Celtispack module Filter
    function active_celtismodules( $default = false) {
        return $this->plf_filter( 'celtispack_active_modules', $default);
    }

    //Make taxonomies and posts available to 'plugin load filter'.
    //force register_taxonomy (category, post_tag, post_format) 
    function force_initial_taxonomies(){
        global $wp_actions;
        $wp_actions[ 'init' ] = 1;
        create_initial_taxonomies();
        create_initial_post_types();
        unset($wp_actions[ 'init' ]);
    }
    
    //Post Format Type, Custom Post Type Data Cache for parse request
    function cache_post_type() {  
        if (!is_admin() || ( defined('DOING_AJAX') && DOING_AJAX ) || (defined('DOING_CRON') && DOING_CRON))
            return;    

        global $wp;
        global $wp_post_statuses;
        $public_query_vars = (!empty($wp->public_query_vars))? $wp->public_query_vars : array();;
        $post_type_query_vars = array();
        foreach ( get_post_types( array(), 'objects' ) as $post_type => $t ){
            if ( $t->query_var )
                $post_type_query_vars[$t->query_var] = $post_type;
        }
        $queryable_post_types = get_post_types( array('publicly_queryable' => true) );

        $data = get_option('plf_queryvars');
        if(!empty($post_type_query_vars) && !empty($queryable_post_types)){
            $data['public_query_vars']    = $public_query_vars;
            $data['post_type_query_vars'] = $post_type_query_vars;
            $data['queryable_post_types'] = $queryable_post_types;
            $data['wp_post_statuses']     = $wp_post_statuses;
            update_option('plf_queryvars', $data);
        }
        else if(!empty($data['post_type_query_vars']) || !empty($data['queryable_post_types'])){
            //delete_option('plf_queryvars');
            $data['public_query_vars']    = '';
            $data['post_type_query_vars'] = '';
            $data['queryable_post_types'] = '';
            $data['wp_post_statuses']     = '';
            update_option('plf_queryvars', $data);
        }
    }

    //parse_request Action Hook for Custom Post Type query add 
    function parse_request( &$args ) {
        if (did_action( 'plugins_loaded' ) === 0 ) {
            $data = get_option('plf_queryvars');
            if(!empty($data['post_type_query_vars']) && !empty($data['queryable_post_types'])){
                global $wp_post_statuses;
                $post_type_query_vars = $data['post_type_query_vars'];
                $queryable_post_types = $data['queryable_post_types'];
                $wp_post_statuses     = $data['wp_post_statuses'];

                $args->public_query_vars = $data['public_query_vars'];
                if ( isset( $args->matched_query ) ) {
                    parse_str($args->matched_query, $perma_query_vars);
                }
                foreach ( $args->public_query_vars as $wpvar ) {
                    if ( isset( $args->extra_query_vars[$wpvar] ) )
                        $args->query_vars[$wpvar] = $args->extra_query_vars[$wpvar];
                    elseif ( isset( $_POST[$wpvar] ) )
                        $args->query_vars[$wpvar] = $_POST[$wpvar];
                    elseif ( isset( $_GET[$wpvar] ) )
                        $args->query_vars[$wpvar] = $_GET[$wpvar];
                    elseif ( isset( $perma_query_vars[$wpvar] ) )
                        $args->query_vars[$wpvar] = $perma_query_vars[$wpvar];

                    if ( !empty( $args->query_vars[$wpvar] ) ) {
                        if ( ! is_array( $args->query_vars[$wpvar] ) ) {
                            $args->query_vars[$wpvar] = (string) $args->query_vars[$wpvar];
                        } else {
                            foreach ( $args->query_vars[$wpvar] as $vkey => $v ) {
                                if ( !is_object( $v ) ) {
                                    $args->query_vars[$wpvar][$vkey] = (string) $v;
                                }
                            }
                        }
                        if ( isset($post_type_query_vars[$wpvar] ) ) {
                            $args->query_vars['post_type'] = $post_type_query_vars[$wpvar];
                            $args->query_vars['name'] = $args->query_vars[$wpvar];
                        }
                    }
                }

                // Limit publicly queried post_types to those that are publicly_queryable
                if ( isset( $args->query_vars['post_type']) ) {
                    if ( ! is_array( $args->query_vars['post_type'] ) ) {
                        if ( ! in_array( $args->query_vars['post_type'], $queryable_post_types ) )
                            unset( $args->query_vars['post_type'] );
                    } else {
                        $args->query_vars['post_type'] = array_intersect( $args->query_vars['post_type'], $queryable_post_types );
                    }
                }
            }
        }
    }

    
    //Plugin Load Filter Main (active plugins/modules filtering)
    function plf_filter( $option, $default = false) {    
        if ( defined( 'WP_SETUP_CONFIG' ) )
            return false;

        if ( ! defined( 'WP_INSTALLING' ) ) {
        	global $wpdb, $current_site;
        	// if ( ! wp_installing() ) { // WP4.4 
        	if ( is_multisite() && $option === 'active_sitewide_plugins' ) {
                //get_network_option() current site ID 
                $network_id = $current_site->id;

                // prevent non-existent options from triggering multiple queries
                $notoptions_key = "$network_id:notoptions";
                $notoptions = wp_cache_get( $notoptions_key, 'site-options' );
                if ( isset( $notoptions[ $option ] ) ) {
                    return apply_filters( 'default_site_option_' . $option, $default, $option );
                }

                $cache_key = "$network_id:$option";
                $value = wp_cache_get( $cache_key, 'site-options' );

                if ( ! isset( $value ) || false === $value ) {
                    $row = $wpdb->get_row( $wpdb->prepare( "SELECT meta_value FROM $wpdb->sitemeta WHERE meta_key = %s AND site_id = %d", $option, $network_id ) );

                    // Has to be get_row instead of get_var because of funkiness with 0, false, null values
                    if ( is_object( $row ) ) {
                        $value = $row->meta_value;
                        $value = maybe_unserialize( $value );
                        wp_cache_set( $cache_key, $value, 'site-options' );
                    } else {
                        if ( ! is_array( $notoptions ) ) {
                            $notoptions = array();
                        }
                        $notoptions[ $option ] = true;
                        wp_cache_set( $notoptions_key, $notoptions, 'site-options' );

                        /** This filter is documented in wp-includes/option.php */
                        $value = apply_filters( 'default_site_option_' . $option, $default, $option );
                    }
                }
            }
            else {
                // prevent non-existent options from triggering multiple queries
                $notoptions = wp_cache_get( 'notoptions', 'options' );
                if ( isset( $notoptions[$option] ) )
                    return apply_filters( 'default_option_' . $option, $default );

                $alloptions = wp_load_alloptions();
                if ( isset( $alloptions[$option] ) ) {
                    $value = $alloptions[$option];
                } else {
                    $value = wp_cache_get( $option, 'options' );

                    if ( false === $value ) {
                        $row = $wpdb->get_row( $wpdb->prepare( "SELECT option_value FROM $wpdb->options WHERE option_name = %s LIMIT 1", $option ) );

                        // Has to be get_row instead of get_var because of funkiness with 0, false, null values
                        if ( is_object( $row ) ) {
                            $value = $row->option_value;
                            wp_cache_add( $option, $value, 'options' );
                        } else { // option does not exist, so we must cache its non-existence
                            if ( ! is_array( $notoptions ) ) {
                                 $notoptions = array();
                            }
                            $notoptions[$option] = true;
                            wp_cache_set( 'notoptions', $notoptions, 'options' );

                            /** This filter is documented in wp-includes/option.php */
                            return apply_filters( 'default_option_' . $option, $default, $option );
                        }
                    }
                }
            }
        } else {
            return false;
        }

        $filter = $this->filter;
        //URL page filter
        $url_page = false;
        if(!empty($_SERVER['REQUEST_URI']) && ! empty($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'GET'){
            $items = array( 'amp', 'url_1', 'url_2' );
            foreach ($items as $key) {
                if(! empty($filter[$key])){
                    if( preg_match("#(/|&|\.|\?){$filter[$key]}(/|&|=|\.|$)#u", $_SERVER['REQUEST_URI'])) {
                        $url_page = $key;
                        if($key === 'amp'){
                            if(!defined('PLF_IS_AMP'))
                                define('PLF_IS_AMP', true);
                        }
                        break;
                    }
                }
            }
        }
        //Admin mode exclude
        if(is_admin() && $url_page === false)
            return false;

        
        //Equal treatment for when the wp_is_mobile is not yet available（wp-include/vars.php wp_is_mobile)
        if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
            $is_mobile = false;
        } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false // many mobile devices (all iPhone, iPad, etc.)
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
                $is_mobile = true;
        } else {
            $is_mobile = false;
        }
        $is_mobile = apply_filters( 'custom_is_mobile' , $is_mobile );

        //get_option is called many times, intermediate processing data to cache
        $keyid = md5('plf_'. (string)$is_mobile . $_SERVER['REQUEST_URI']);
        if(!empty($this->cache[$keyid][$option])){
            return $this->cache[$keyid][$option];
        }

        //Before plugins loaded, it does not use conditional branch such as is_home, to set wp_query, wp in temporary query
        if(empty($GLOBALS['wp_the_query'])){
            // プラグイン無効化時等で rewrite_rule がクリアされると rewrite_rule が更新されるまでカスタムポストタイプを判定できない
            // この時はカスタムポストタイプのページはホームへ飛ばされてしまうので、結局 rewrite_rule を更新できない状態から抜け出せなくなる
            // 対応する為に rewrite_rule を監視して変更された場合はプラグインのフィルタリングをスキップさせる
    		$rewrite_rules = get_option('rewrite_rules');
            $data = get_option('plf_queryvars');
            if(empty($rewrite_rules) || empty($data['rewrite_rules']) || $rewrite_rules !== $data['rewrite_rules']){
                $data['rewrite_rules'] = (empty($rewrite_rules))? '': $rewrite_rules;
                update_option('plf_queryvars', $data);
                return false;
            }

            $GLOBALS['wp_the_query'] = new WP_Query();
            $GLOBALS['wp_query'] = $GLOBALS['wp_the_query'];
            $GLOBALS['wp_rewrite'] = new WP_Rewrite();
            $GLOBALS['wp'] = new WP();
            //register_taxonomy(category, post_tag, post_format) support for is_archive 
            $this->force_initial_taxonomies();
            //Post Format, Custom Post Type support
            add_action('parse_request', array(&$this, 'parse_request'));
            $GLOBALS['wp']->parse_request('');
            $GLOBALS['wp']->query_posts();
            
        }
        //Only available display pages (login, cron, ajax request ... excluded)
        //downloadmanager plugin downloadlink request [home]/?wpdmact=XXXXXX  exclude home GET query
        //bbPress users page requests are treated the same as is_home
        global $wp_query;
        if(!(function_exists('is_embed') && is_embed()) && ($url_page === false) ){
            if((is_home() || is_front_page() || is_archive() || is_search() || is_singular()) == false 
                || (is_home() && !empty($_GET))
                || (is_singular() && empty($wp_query->post))){
                return false;
            }
        }
        
        $us_value  = ($option === 'active_sitewide_plugins')? array_keys( (array)$value ) : maybe_unserialize( $value );
        $new_value = array();
        foreach ( $us_value as $item ) {
            $unload = false;
            //Jetpack module slug / Celtiapack module slug /  Plugin php file name
            if($option === 'jetpack_active_modules'){
                $p_key = 'jetpack_module/' . $item;
            }
            elseif($option === 'celtispack_active_modules'){
                $p_key = 'celtispack_module/' . str_replace( '.php', '', basename( $item) );        
            }
            else {
                $p_key = $item;
            }
            //admin mode filter
            if(!empty($filter['_admin']['plugins'])){
                if(in_array($p_key, array_map("trim", explode(',', $filter['_admin']['plugins']))))
                    $unload = true;
            }
            //page filter
            if(!$unload){
                if(!empty($filter['_pagefilter']['plugins'])){
                    if(in_array($p_key, array_map("trim", explode(',', $filter['_pagefilter']['plugins'])))){
                        $unload = true;
                    
                        //desktop/mobile device disable filter
                        $single_opt = false;
                        $dis_dev = true; 
                        $devtype = ($is_mobile)? 'mobile' : 'desktop';
                        if(is_singular() && is_object($wp_query->post)){
                            $myfilter = get_post_meta( $wp_query->post->ID, '_plugin_load_filter', true );
                            //For ver2.2.0 compatibility, set 'plugins' data to 'desktop' and 'mobile'
                            if(!empty($myfilter['plugins'])){
                                $myfilter['desktop'] = $myfilter['plugins'];
                                $myfilter['mobile']  = $myfilter['plugins'];
                                unset($myfilter['plugins']);
                            }
                            $default = array( 'filter' => 'default', 'desktop' => '', 'mobile' => '');
                            $single_opt = (!empty($myfilter))? $myfilter : $default;
                            $single_opt = wp_parse_args( $single_opt, $default);
                            if($single_opt['filter'] === 'include'){
                                if(false !== strpos($single_opt[$devtype], $p_key))
                                    $dis_dev = false; 
                                else if(strpos($p_key, 'jetpack/') !== false && strpos($single_opt[$devtype], 'jetpack_module/') !== false)
                                    $dis_dev = false; 
                                else if(strpos($p_key, 'celtispack/') !== false && strpos($single_opt[$devtype], 'celtispack_module/') !== false)
                                    $dis_dev = false; 
                            }
                        }
                        if(empty($single_opt) || $single_opt['filter'] === 'default'){
                            if(!empty($filter['group'][$devtype]['plugins'])){
                                if(false !== strpos($filter['group'][$devtype]['plugins'], $p_key))
                                    $dis_dev = false;
                                else if(strpos($p_key, 'jetpack/') !== false && strpos($filter['group'][$devtype]['plugins'], 'jetpack_module/') !== false)
                                    $dis_dev = false; 
                                else if(strpos($p_key, 'celtispack/') !== false && strpos($filter['group'][$devtype]['plugins'], 'celtispack_module/') !== false)
                                    $dis_dev = false; 
                            }
                        }
                        if(!$dis_dev){
                            //oEmbed Content API or AMP/URL page request
                            if((function_exists('is_embed') && is_embed()) || $url_page !== false){
                                $type = ($url_page === false)? 'content-card' : $url_page;
                                if(!empty($filter['group'][$type]['plugins'])){
                                    if(false !== strpos($filter['group'][$type]['plugins'], $p_key))
                                        $unload = false;
                                    else if(strpos($p_key, 'jetpack/') !== false && strpos($filter['group'][$type]['plugins'], 'jetpack_module/') !== false)
                                        $unload = false;
                                    else if(strpos($p_key, 'celtispack/') !== false && strpos($filter['group'][$type]['plugins'], 'celtispack_module/') !== false)
                                        $unload = false;
                                }
                            }
                            else {
                                $pgfopt = false;
                                if(is_singular()){
                                    if(!empty($single_opt) && $single_opt['filter'] === 'include'){
                                        $pgfopt = true;
                                        if(false !== strpos($single_opt[$devtype], $p_key)){
                                            $unload = false; 
                                        }
                                        else {
                                            //Enable plugin because plugin module is selected
                                            if(strpos($p_key, 'jetpack/') !== false && strpos($single_opt[$devtype], 'jetpack_module/') !== false)
                                                $unload = false;
                                            else if(strpos($p_key, 'celtispack/') !== false && strpos($single_opt[$devtype], 'celtispack_module/') !== false)
                                                $unload = false;
                                            
                                        }
                                    }
                                }
                                if($pgfopt === false){
                                    $type = false;
                                    if(is_home() || is_front_page())
                                        $type = 'home';
                                    elseif(is_archive())
                                        $type = 'archive';
                                    elseif(is_search())
                                        $type = 'search';
                                    elseif(is_attachment())
                                        $type = 'attachment';
                                    elseif(is_page())
                                        $type = 'page';
                                    elseif(is_single()){ //Post & Custom Post
                                        $type = get_post_type( $wp_query->post);
                                        if($type === 'post'){
                                            $fmt = get_post_format( $wp_query->post);
                                            $type = ($fmt === 'standard' || $fmt == false)? 'post' : "post-$fmt";
                                        }
                                    }
                                    if($type !== false && !empty($filter['group'][$type]['plugins'])){
                                        if(in_array($p_key, array_map("trim", explode(',', $filter['group'][$type]['plugins']))))
                                            $unload = false;
                                        else {
                                            if(strpos($p_key, 'jetpack/') !== false && strpos($filter['group'][$type]['plugins'], 'jetpack_module/') !== false)
                                                $unload = false;
                                            else if(strpos($p_key, 'celtispack/') !== false && strpos($filter['group'][$type]['plugins'], 'celtispack_module/') !== false)
                                                $unload = false;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if(!$unload) {
                if($option === 'active_sitewide_plugins')
                    $new_value[$item] = $value[$item];
                else
                    $new_value[] = $item;
            }
        }
        $this->cache[$keyid][$option] = $new_value;
        return $new_value;
    }
}
