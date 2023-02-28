<?php

ini_set('display_errors', 1);

/**
 * Theme only works in WordPress 5.0 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '5.0', '<' ) ) {
	exit("Update Wordpress to 5.0 or later to use this theme.");
}

//-- use jQuery version 2 to be able to use the announcement.js
if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js', false, null);
   wp_enqueue_script('jquery');
} 

class Functions {
    function __construct() {
        add_action( 'admin_menu',                   array( $this, 'menu_organisation') );
        add_action( 'after_setup_theme',            array( $this, 'init' ) );
        add_action( 'init',                         array( $this, 'register'));
        add_action( 'init',                         array( $this, 'rewrite_rules'));
        add_action( 'wp_loaded',                    array( $this, 'define_geolocation') );
       // add_filter( 'script_loader_tag',            array( $this, 'script_attrs'), 10, 3 ); 
        add_action( 'template_redirect',            array( $this, 'change_search_url' ));
        add_action( 'wp_enqueue_scripts',           array( $this, 'scripts' ) );
        add_filter( 'query_vars',                   array( $this, 'custom_query_vars') );
        add_filter( 'post_type_link',               array( $this, 'custom_post_type_permalinks'), 10, 3 );
        add_filter( 'wp_unique_post_slug',          array( $this, 'prevent_slug_duplicates'), 10, 6 );

        add_action( 'wp_ajax_loadmore',             array( $this, 'loadmore' ) ); 
        add_action( 'wp_ajax_nopriv_loadmore',      array( $this, 'loadmore' ) ); 
        add_action( 'wp_ajax_filterposts',          array( $this, 'filterposts' ) ); 
        add_action( 'wp_ajax_nopriv_filterposts',   array( $this, 'filterposts' ) );
        add_action( 'wp_ajax_loadmoremedia',        array( $this, 'loadmoremedia' ) ); 
        add_action( 'wp_ajax_nopriv_loadmoremedia', array( $this, 'loadmoremedia' ) ); 
        add_action( 'wp_ajax_loadmoresearch',       array( $this, 'loadmoresearch' ) ); 
        add_action( 'wp_ajax_nopriv_loadmoresearch',array( $this, 'loadmoresearch' ) ); 

        // Job Adder
        add_action( 'rest_api_init', array( $this, 'jobAdderRoute') );
    }

    /***
     *  GEO
     */

    function define_geolocation() {
        if (!is_admin()) {
            if (class_exists('WPEngine\\GeoIp')) {
                $geo = WPEngine\GeoIp::instance();
                $geo->setup();
                define("GEO_COUNTRY", ($geo->country() ? $geo->country() : "AU"));
                define("GEO_REGION", ($geo->region() ? $geo->region() : "NSW"));
            }
        }
        return true;
    }

    static function get_locale_form_id($form_ids) {
        // $cc = GEO_COUNTRY;
        $cc = strtoupper(basename( get_the_permalink() ));
        if (strlen($cc) > 7) $cc = "AU";

        if ($cc === "KP") $cc = "KR"; // Handle both locations for Korea
        $key = array_search($cc, array_column($form_ids, 'location'));
        return $form_ids[$key]['form_id'];
    }

    /***
     *  CUSTOM QUERY VARS
     */

    function custom_query_vars($vars) {
        $vars[] .= 'tab'; // Investors page
        return $vars;
    }

    /***
     * REWRITE RULES
     */
    
    function rewrite_rules() {
        add_rewrite_rule('^search/([^/]*)/?', 'index.php?s=$matches[1]', 'top');
        add_rewrite_rule('^investors/([^/]*)/?', 'index.php?pagename=investors&tab=$matches[1]', 'top');

        /* Landing pages fix */
        add_rewrite_rule( '[^/]+/attachment/([^/]+)/?$', 'index.php?attachment=$matches[1]', 'bottom');
        add_rewrite_rule( '[^/]+/attachment/([^/]+)/trackback/?$', 'index.php?attachment=$matches[1]&tb=1', 'bottom');
        add_rewrite_rule( '[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$', 'index.php?attachment=$matches[1]&feed=$matches[2]', 'bottom');
        add_rewrite_rule( '[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$', 'index.php?attachment=$matches[1]&feed=$matches[2]', 'bottom');
        add_rewrite_rule( '[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$', 'index.php?attachment=$matches[1]&cpage=$matches[2]', 'bottom');
        add_rewrite_rule( '[^/]+/attachment/([^/]+)/embed/?$', 'index.php?attachment=$matches[1]&embed=true', 'bottom');
        add_rewrite_rule( '([^/]+)/embed/?$', 'index.php?landing-pages=$matches[1]&embed=true', 'bottom');
        add_rewrite_rule( '([^/]+)/trackback/?$', 'index.php?landing-pages=$matches[1]&tb=1', 'bottom');
        add_rewrite_rule( '([^/]+)/page/?([0-9]{1,})/?$', 'index.php?landing-pages=$matches[1]&paged=$matches[2]', 'bottom');
        add_rewrite_rule( '([^/]+)/comment-page-([0-9]{1,})/?$', 'index.php?landing-pages=$matches[1]&cpage=$matches[2]', 'bottom');
        add_rewrite_rule( '([^/]+)(?:/([0-9]+))?/?$', 'index.php?landing-pages=$matches[1]', 'bottom');
        add_rewrite_rule( '[^/]+/([^/]+)/?$', 'index.php?attachment=$matches[1]', 'bottom');
        add_rewrite_rule( '[^/]+/([^/]+)/trackback/?$', 'index.php?attachment=$matches[1]&tb=1', 'bottom');
        add_rewrite_rule( '[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$', 'index.php?attachment=$matches[1]&feed=$matches[2]', 'bottom');
        add_rewrite_rule( '[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$', 'index.php?attachment=$matches[1]&feed=$matches[2]', 'bottom');
        add_rewrite_rule( '[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$', 'index.php?attachment=$matches[1]&cpage=$matches[2]', 'bottom');
        add_rewrite_rule( '[^/]+/([^/]+)/embed/?$', 'index.php?attachment=$matches[1]&embed=true', 'bottom');
    }

    /***
     *  INIT THEME SETTINGS
     */
    
    public function init() {
        /*
         *  THEME SUPPORT
         */
        add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
        );

        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 1568, 9999 );
        
        add_theme_support( 'title-tag' );
        
        /*
         *  REGISTER MENUS
         */ 
        register_nav_menus(
			array(
                'mini-header' => __( 'Mini-Header Menu', 'isentia' ),
				'header' => __( 'Header Menu', 'isentia' ),
				'custom-header' => __( 'Custom-Header Menu', 'isentia' ),
                'footer-1' => __( 'Footer Column 1 Menu', 'isentia' ),
                'footer-2' => __( 'Footer Column 2 Menu', 'isentia' )
			)
        );
    }


    /***
     *  ENQUEUE SCRIPTS FOR SITE
     */

    public function scripts() {
        global $wp_query;

        /* FONTS */
        wp_enqueue_style( 'google-fonts', "https://fonts.googleapis.com/css?family=Roboto:400,900&display=swap", array(), wp_get_theme()->get( 'Version' ));
        
        /* STYLES */
        wp_enqueue_style( 'global-styles', get_theme_file_uri( '/css/global.css' ), array(), wp_get_theme()->get( 'Version' ) );
        if (defined("CUSTOM_CSS"))
            wp_enqueue_style( CUSTOM_CSS.'-style', get_theme_file_uri( '/css/'.CUSTOM_CSS.'.min.css'), array(), wp_get_theme()->get( 'Version' ) );
        else
            wp_enqueue_style( 'site-style', get_theme_file_uri( '/css/styles.min.css' ), array(), wp_get_theme()->get( 'Version' ) );
            wp_enqueue_style( 'site-style', get_theme_file_uri( '/css/body.min.css' ), array(), wp_get_theme()->get( 'Version' ) );

            wp_enqueue_style( 'jquery-modal', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css', array(), wp_get_theme()->get( 'Version' ) );

        if (defined("CUSTOM_CSS") && 'homepage' == CUSTOM_CSS) {
            wp_enqueue_style( 'ss-custom-homepage', get_theme_file_uri( '/css/ss-homepage.css' ), array(), wp_get_theme()->get( 'Version' ) );
        }
        if (defined("CUSTOM_CSS") && 'platform' == CUSTOM_CSS) {
            wp_enqueue_style( 'custom-font-montserrat', get_theme_file_uri( 'fonts/Montserrat/Montserrat.css' ), array(), wp_get_theme()->get( 'Version' ) );
            wp_enqueue_style( 'custom-font-arial', get_theme_file_uri( 'fonts/Arial/Arial.css' ), array(), wp_get_theme()->get( 'Version' ) );
        }
        wp_enqueue_style( 'ss-custom-styles', get_theme_file_uri( '/css/ss-styles.css' ), array(), wp_get_theme()->get( 'Version' ) );

        /* SCRIPTS */
        // External
        // wp_enqueue_script( 'custom-jquery', get_theme_file_uri( '/js/external/jquery.min.js' ), array(), '3.4.1', true );
        // Internal
        wp_enqueue_script( 'site-script', get_theme_file_uri( '/js/script.min.js' ), array(), wp_get_theme()->get( 'Version' ), true );
        wp_enqueue_script( 'modal-script', get_theme_file_uri( '/js/modal.min.js' ), array(), wp_get_theme()->get( 'Version' ), true );
        wp_enqueue_script( 'menumobile', get_theme_file_uri( '/js/menumobile.js' ), array(), wp_get_theme()->get( 'Version' ), true );
        wp_enqueue_script( 'global-script', get_theme_file_uri( '/js/global.js' ), array(), wp_get_theme()->get( 'Version' ), true );

        if (defined("CUSTOM_JS")) {
            wp_register_script( CUSTOM_JS.'-script', get_theme_file_uri( '/js/'.CUSTOM_JS.'.min.js' ), array(), wp_get_theme()->get( 'Version' ), true );
            wp_localize_script( CUSTOM_JS.'-script', str_replace('-', '_', CUSTOM_JS).'_params', array(
                'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
                'posts' => json_encode( $wp_query->query_vars ),
                'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
            ) );
            wp_enqueue_script(CUSTOM_JS.'-script');
        }

        wp_enqueue_script('sharelink', "https://app.sharelinktechnologies.com/widget/js", array('jquery'), '1.0', true);

        wp_enqueue_script('jquery-modal', "https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js", array('jquery'), '0.9.1', false);

        
    }

    
    /***
     *  ADD ATTRIBUTES TO ENQUEUED SCRIPTS
     */

     public function script_attrs($tag, $handle, $src) {
        $scripts = array(
            array(
                'name' => 'asx-announcements',
                'attrs' => 'id="ausstocks" code="isd" market="asx"'
            )
        );

        $script = array_search($handle, array_column($scripts, 'name'));

        if ( FALSE !== $script){
            $tag = '<script src="'.esc_url($src).'" type="text/javascript" '.$scripts[$script]['attrs'].'></script>';
        }
        return $tag;
     }


    /***
     * CUSTOM POST TYPES AND TAXONOMIES
     */
    
    function register() {
        /*
         * OFFICE LOCATIONS
         */
        
        register_post_type('offices', array(
            'labels' => array(
                'name'                  => _x('Offices', 'isentia'),
                'singular_name'         => _x('Office', 'isentia'),
                'add_new'               => _x('Add New', 'isentia'),
                'add_new_item'          => _x('Add New Office', 'isentia'),
                'edit_item'             => _x('Edit Office', 'isentia'),
                'new_item'              => _x('New Office', 'isentia'),
                'view_item'             => _x('View Office', 'isentia'),
                'search_items'          => _x('Search Offices', 'isentia'),
                'not_found'             => _x('No Offices found', 'isentia'),
                'not_found_in_trash'    => _x('No Offices found in Trash', 'isentia'),
                'parent_item_colon'     => _x('Parent Offices:', 'isentia'),
                'menu_name'             => _x('Offices', 'isentia'),
            ),
            'hierarchical'              => false,
            'supports'                  => array('title', 'editor'),
            'public'                    => false,
            'show_ui'                   => true,
            'show_in_menu'              => true,
            'show_in_nav_menus'         => true,
            'publicly_queryable'        => false,
            'exclude_from_search'       => true,
            'has_archive'               => false,
            'query_var'                 => true,
            'can_export'                => true,
            'menu_icon'                 => 'dashicons-building',
            'rewrite'                   => true,
            'capability_type'           => 'post'
        )); 
        
        register_taxonomy(
            'office-locations',
            'offices',
            array(
                'hierarchical'          => true,
                'label'                 => 'Office locations',
                'show_admin_column'     => true,
                'query_var'             => true,
                'publicly_queryable'    => false,
                'rewrite'               => array(
                    'slug'              => 'office-locations',
                    'with_front'        => false
                )
            )
        );


        /*
         * TEAM MEMBERS
         */
        
        register_post_type('team-members', array(
            'labels' => array(
                'name'                  => _x('Team members', 'isentia'),
                'singular_name'         => _x('Team member', 'isentia'),
                'add_new'               => _x('Add New', 'isentia'),
                'add_new_item'          => _x('Add New Team member', 'isentia'),
                'edit_item'             => _x('Edit Team member', 'isentia'),
                'new_item'              => _x('New Team member', 'isentia'),
                'view_item'             => _x('View Team member', 'isentia'),
                'search_items'          => _x('Search Team member', 'isentia'),
                'not_found'             => _x('No Team members found', 'isentia'),
                'not_found_in_trash'    => _x('No Team members found in Trash', 'isentia'),
                'parent_item_colon'     => _x('Parent Team members:', 'isentia'),
                'menu_name'             => _x('Team members', 'isentia'),
            ),
            'hierarchical'              => false,
            'supports'                  => array('title', 'editor', 'thumbnail'),
            'public'                    => false,
            'show_ui'                   => true,
            'show_in_menu'              => true,
            'show_in_nav_menus'         => true,
            'publicly_queryable'        => false,
            'exclude_from_search'       => true,
            'has_archive'               => false,
            'query_var'                 => true,
            'can_export'                => true,
            'menu_icon'                 => 'dashicons-groups',
            'rewrite'                   => true,
            'capability_type'           => 'post'
        )); 
        
        register_taxonomy(
            'team-departments',
            'team-members',
            array(
                'hierarchical'          => true,
                'label'                 => 'Departments',
                'show_admin_column'     => true,
                'query_var'             => true,
                'publicly_queryable'    => false,
                'rewrite'               => array(
                    'slug'              => 'team-departments',
                    'with_front'        => false
                )
            )
        );


        /*
         * INVESTOR FILES
         */
        
        register_post_type('investor-files', array(
            'labels' => array(
                'name'                  => _x('Investor files', 'isentia'),
                'singular_name'         => _x('Investor file', 'isentia'),
                'add_new'               => _x('Add New', 'isentia'),
                'add_new_item'          => _x('Add New Investor file', 'isentia'),
                'edit_item'             => _x('Edit Investor file', 'isentia'),
                'new_item'              => _x('New Investor file', 'isentia'),
                'view_item'             => _x('View Investor file', 'isentia'),
                'search_items'          => _x('Search Investor file', 'isentia'),
                'not_found'             => _x('No Investor files found', 'isentia'),
                'not_found_in_trash'    => _x('No Investor files found in Trash', 'isentia'),
                'parent_item_colon'     => _x('Parent Investor files:', 'isentia'),
                'menu_name'             => _x('Investor files', 'isentia'),
            ),
            'hierarchical'              => false,
            'supports'                  => array('title'),
            'public'                    => false,
            'show_ui'                   => true,
            'show_in_menu'              => true,
            'show_in_nav_menus'         => true,
            'publicly_queryable'        => false,
            'exclude_from_search'       => true,
            'has_archive'               => false,
            'query_var'                 => true,
            'can_export'                => true,
            'menu_icon'                 => 'dashicons-analytics',
            'rewrite'                   => true,
            'capability_type'           => 'post'
        )); 

        register_taxonomy(
            'investor-file-bucket',
            'investor-files',
            array(
                'hierarchical'          => true,
                'label'                 => 'Bucket',
                'show_admin_column'     => true,
                'query_var'             => true,
                'publicly_queryable'    => false,
                'rewrite'               => array(
                    'slug'              => 'investor-file-bucket',
                    'with_front'        => false
                )
            )
        );

        /*
         * LANDING PAGES
         */
        
        register_post_type('landing-pages', array(
            'labels' => array(
                'name'                  => _x('Landing pages', 'isentia'),
                'singular_name'         => _x('Landing page', 'isentia'),
                'add_new'               => _x('Add New', 'isentia'),
                'add_new_item'          => _x('Add New Landing page', 'isentia'),
                'edit_item'             => _x('Edit Landing page', 'isentia'),
                'new_item'              => _x('New Landing page', 'isentia'),
                'view_item'             => _x('View Landing page', 'isentia'),
                'search_items'          => _x('Search Landing pages', 'isentia'),
                'not_found'             => _x('No Landing pages found', 'isentia'),
                'not_found_in_trash'    => _x('No Landing pages found in Trash', 'isentia'),
                'parent_item_colon'     => _x('Parent Landing pages:', 'isentia'),
                'menu_name'             => _x('Landing pages', 'isentia'),
            ),
            'hierarchical'              => true,
            'supports'                  => array('title', 'editor', 'page-attributes'),
            'public'                    => true,
            'show_ui'                   => true,
            'show_in_menu'              => true,
            'show_in_nav_menus'         => true,
            'publicly_queryable'        => true,
            'exclude_from_search'       => false,
            'has_archive'               => false,
            'query_var'                 => true,
            'can_export'                => true,
            'menu_icon'                 => 'dashicons-pressthis',
            'rewrite'                   => false,
            'capability_type'           => 'post'
        )); 

        add_shortcode('show_media', array( $this, 'isentia_showmedia' ) ); 
    }

    function custom_post_type_permalinks( $post_link, $post, $leavename ) {
        if ( isset( $post->post_type ) && 'landing-pages' == $post->post_type ) {
            $post_link = home_url( $post->post_name."/" );
        }
    
        return $post_link;
    }

    function prevent_slug_duplicates( $slug, $post_ID, $post_status, $post_type, $post_parent, $original_slug ) {
        $check_post_types = array(
            'post',
            'page',
            'landing-pages'
        );
    
        if ( ! in_array( $post_type, $check_post_types ) ) {
            return $slug;
        }
    
        if ( 'landing-pages' == $post_type ) {
            // Saving a custom_post_type post, check for duplicates in POST or PAGE post types
            $post_match = get_page_by_path( $slug, 'OBJECT', 'post' );
            $page_match = get_page_by_path( $slug, 'OBJECT', 'page' );
    
            if ( $post_match || $page_match ) {
                $slug .= '-duplicate';
            }
        } else {
            // Saving a POST or PAGE, check for duplicates in custom_post_type post type
            $custom_post_type_match = get_page_by_path( $slug, 'OBJECT', 'landing-pages' );
    
            if ( $custom_post_type_match ) {
                $slug .= '-duplicate';
            }
        }
    
        return $slug;
    }

    /*** 
     *  ADMIN MENU ORGANISATION 
     */

    function menu_organisation() {
        global $menu;
        global $submenu;

        /* Rename posts */

        $menu[5][0] = "Latest Reads";
        $submenu['edit.php'][5][0] = "All Articles";
    }

    /***
     *  RESOURCES SEARCH URL CHANGE
     */
    
    function change_search_url() {
        if ( is_search() && ! empty( $_GET['s'] ) ) {
            wp_redirect( home_url( "/search/" ) . urlencode( strtolower( get_query_var( 's' ) ) ) . "/" );
            exit();
        }   
    }

    /***
     *  AJAX HANDLE - LOAD MORE POSTS
     */

    function loadmore() {
        //$args = json_decode( stripslashes( $_POST['query'] ), true );
        $args['paged'] = $_POST['page'] + 1;
        $args['post_status'] = 'publish';
        $args['meta_query']	= array(
            array(
                'key'		=> 'article_type',
                'value'		=> 'mediarelease',
                'compare'	=> '!='
            )
        );
        query_posts( $args );
     
        if( have_posts() ) :
            while( have_posts() ): the_post();
                get_template_part( 'templates/content', 'category-item' );
            endwhile;
     
        endif;
        die;
    }

    /***
     *  AJAX HANDLE - FILTER POSTS
     */

    function filterposts() {
        $args = json_decode( stripslashes( $_POST['query'] ), true );
        $args['paged'] = 1;
        $args['post_status'] = 'publish';
        if ($_POST['category'] !== 'all')
            $args['category_name'] = $_POST['category'];
        $args['meta_query']	= array(
            array(
                'key'		=> 'article_type',
                'value'		=> 'mediarelease',
                'compare'	=> '!='
            )
        );
        query_posts( $args );

        $output = array();
        ob_start();
        if( have_posts() ) :
            while( have_posts() ): the_post();
                get_template_part( 'templates/content', 'category-item' );
            endwhile;
        endif;
        
        $output['posts'] = ob_get_clean();
        global $wp_query;
        $output['max_pages'] = $wp_query->max_num_pages;
        $output['category'] = $_POST['category'];
        echo json_encode($output);
        die;
    }

    /***
     *  AJAX HANDLE - LOAD MORE MEDIA POSTS ON INVESTORS
     */

    function loadmoremedia() {
        $args = json_decode( stripslashes( $_POST['query'] ), true );
        $args['paged'] = $_POST['page'] + 1;
        $args['post_status'] = 'publish';
        $args['meta_query']	= array(
            array(
                'key'		=> 'article_type',
                'value'		=> 'mediarelease',
                'compare'	=> '='
            )
        );
        query_posts( $args );
     
        if( have_posts() ) :
            while( have_posts() ): the_post();
                get_template_part( 'templates/content', 'investor-media-item' );
            endwhile;
        endif;
        die;
    }

    /***
     *  AJAX HANDLE - LOAD MORE SEARCH POSTS
     */

    function loadmoresearch() {
        $args = json_decode( stripslashes( $_POST['query'] ), true );
        $args['paged'] = $_POST['page'] + 1;
        $args['post_status'] = 'publish';
        query_posts( $args );
     
        if( have_posts() ) :
            while( have_posts() ): the_post();
                get_template_part( 'templates/content', 'category-item' );
            endwhile;
     
        endif;
        die;
    }


    /***
     *  JOBADDER
     */
    function jobAdderRoute() {
        register_rest_route( 'jobadder/v1', '/jobs', array(
            'methods' => 'POST',
            'callback' => array($this, 'updatePostJobsMeta'),
            'permission_callback' => '__return_true',
        ) );
    }

    function updatePostJobsMeta($request) {
        ob_start();

        $post_id = 14;
        $user = get_user_by( 'id', 26 );

        $allHeaders = getallheaders();
        $authToken = $allHeaders['Authorization'];
        $userAuthToken = 'Basic ' . base64_encode( $user->user_login . ':' . $user->user_activation_key );


        // if ($authToken === $userAuthToken) {
            $data = $request->get_body();
            
            $xml = simplexml_load_string($data, null, LIBXML_NOCDATA);
            $list = $xml->Job;
            $data = [];

            for ($i = 0; $i < count($list); $i++) {
                $category = '';
                $subCategory = '';
                $location = '';
                $workType = '';

                $classification = $list[$i]->Classifications->Classification;

                for($j = 0; $j < count($classification); $j++){
                    $node = $classification[$j];
                    
                    if($node->attributes()->name == "Category"){
                        $category = json_decode(json_encode($node), True)[0];
                    }
                    if($node->attributes()->name == "Sub Category"){
                        $subCategory = json_decode(json_encode($node), True)[0];
                    }
                    if($node->attributes()->name == "Location"){
                        $location = json_decode(json_encode($node), True)[0];
                    }
                    if($node->attributes()->name == "Work Type"){
                        $workType = json_decode(json_encode($node), True)[0];
                    }
                }

                $bulletpoints = $list[$i]->BulletPoints;


                for($k = 0; $k < count($bulletpoints); $k++){
                    $node = $bulletpoints[$k];
                    $bullets = json_decode(json_encode($node), true);
                }

                $description = json_decode(json_encode($list[$i]->Description), True)[0];
				$summary = json_decode(json_encode($list[$i]->Summary), True)[0];

                $data[] = [
                    'jobID' => json_decode($list[$i]->attributes()->jid),
                    'Title' => json_decode(json_encode($list[$i]->Title), True)[0],
                    'Summary' =>  str_replace("\"", "'", $summary),
                    'Description' =>  str_replace("\"", "'", $description),
                    'Bulletpoints' => $bullets,
                    'Category' => $category,
                    'SubCategory' => $subCategory,
                    'Location' => $location,
                    'WorkType' => $workType,
                    'Apply' => [
                        'Url' => json_decode(json_encode($list[$i]->Apply->Url), True)[0],
                    ],
                ];
            }

            $json = addcslashes(json_encode($data), "'");
            
            update_post_meta( 14, 'jobs', $json );

        	print_r($json);
        // } else {
        // 	echo 'invalid_user';
        // }
        
    }

    function isentia_showmedia($atts) {
        extract(shortcode_atts(array(
            'id' => 1,
         ), $atts));
      
         $image = wp_get_attachment_image_src( $id, 'full' );
         $return_string = '<div class="article-picture">';
         if ($image[0]) {
            $return_string .= "<img src='" . $image[0] . "'>";
         } else {
            $return_string .= "<p>Image not found</p>";
         }
         $return_string .= '</div>';
      

         return $return_string;
    }
}

$isentia_func = new Functions();

function prefix_nav_description( $item_output, $item, $depth, $args ) {
    if ( !empty( $item->description ) ) {
        $item_output = str_replace( $args->link_after . '</a>', '<span class="menu-item-description">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
    }
 
    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'prefix_nav_description', 10, 4 );