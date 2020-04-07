<?php

  /**
   * Load scripts and styles.
   */

  function supertoat_scripts() {

    // Theme styles
    wp_enqueue_style( 'supertoat-styles', get_stylesheet_directory_uri() .'/dist/site.css', '', '2.3' );

    // Theme scripts
    wp_enqueue_script( 'supertoat-scripts', get_stylesheet_directory_uri() .'/dist/site.js', '', '', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }

  }
  add_action( 'wp_enqueue_scripts', 'supertoat_scripts' );


  /**
   * Register the menus
   */
  function supertoat_menus() {
    register_nav_menu( 'primary_menu', __( 'Primary Menu', 'supertoat' ) );
    register_nav_menu( 'secondary_menu', __( 'Secondary Menu', 'supertoat' ) );
  }
  add_action( 'after_setup_theme', 'supertoat_menus' );

  /**
   * Create ACF Options Page
   */
  if( function_exists('acf_add_options_page') ) {
    $options = [
      'page_title' => 'Telltec',
      'position' => '30',
      'icon_url' => 'dashicons-smiley'
    ];
    acf_add_options_page($options);
  }

  /**
   * Enable Theme Features
   */
  add_theme_support( 'post-thumbnails' ); // support featured Images on Posts
  add_theme_support( 'align-wide' ); // support wide blocks in Gutenberg
  add_theme_support( 'title-tag' ); // let WP add <title> tag
  add_theme_support('editor-styles'); 
  // add_editor_style( 'dist/site.css' ); // Load our main CSS into Gutenberg


  /**
   * Load custom functioncs 
   */
  require get_template_directory() . '/src/php/template-tags.php';
  require get_template_directory() . '/src/php/helpers.php';


  /**
   * Add page slug to body class
   */
  function supertoat_add_page_slug_body_class( $classes ) {
    global $post;
    if ( isset( $post ) ) {
      $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
  }
  add_filter('body_class', 'supertoat_add_page_slug_body_class' );


  /**
  * Add telltec to body class
  * Used to increase specificity when needed
  */

  
  add_filter( 'body_class', function( $classes ) {
    return array_merge( $classes, array( 'telltec' ) );
  } );

  /**
   * Allow SVG uploads
   */
  function supertoat_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
   }
   add_filter('upload_mimes', 'supertoat_mime_types');

  
  /**
   * Register colors for Gutenberg color picker
   */
  add_theme_support( 'editor-color-palette', array(
    array(
      'name'  => __( 'Deep Grey', 'supertoat' ),
      'slug'  => 'deepgrey',
      'color'	=> '#262626',
    ),
    array(
      'name'  => __( 'Very Light Grey', 'supertoat' ),
      'slug'  => 'verylightgrey',
      'color' => '#f1f2f1',
    ),
    array(
      'name'  => __( 'Playful Red', 'supertoat' ),
      'slug'  => 'playfulred',
      'color' => '#FF5050',
    ),
    array(
      'name'	=> __( 'Black', 'supertoat' ),
      'slug'	=> 'black',
      'color'	=> '#000000',
    ),
    array(
      'name'	=> __( 'White', 'supertoat' ),
      'slug'	=> 'white',
      'color'	=> '#ffffff',
    ),
    array(
      'name'	=> __( 'Yellow Highlight', 'supertoat' ),
      'slug'	=> 'yellowhighlight',
      'color'	=> '#fff2a8',
    ),
  ) );

  
  /**
   * Remove jQuery
   */
  function supertoat_remove_jquery( &$scripts){
      if(!is_admin()){
          $scripts->remove( 'jquery');
          $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2' );
      }
  }
  add_filter( 'wp_default_scripts', 'supertoat_remove_jquery' );



 /**
  * Disable the emoji's
  */
function disable_emojis() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
  add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
 }
 add_action( 'init', 'disable_emojis' );
 
 /**
  * Filter function used to remove the tinymce emoji plugin.
  * 
  * @param array $plugins 
  * @return array Difference betwen the two arrays
  */
  function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
      return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
      return array();
    }
  }
 
 /**
  * Remove emoji CDN hostname from DNS prefetching hints.
  *
  * @param array $urls URLs to print for resource hints.
  * @param string $relation_type The relation type the URLs are printed for.
  * @return array Difference betwen the two arrays.
  */
 function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' == $relation_type ) {
      /** This filter is documented in wp-includes/formatting.php */
      $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
    
      $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }
  
    return $urls;
 }


/**
* Register Activites Custom Post Type
*/
function telltec_activities_cpt() {

	$labels = array(
		'name'                  => _x( 'Activities', 'Post Type General Name', 'supertoat' ),
		'singular_name'         => _x( 'Activity', 'Post Type Singular Name', 'supertoat' ),
		'menu_name'             => __( 'Activities', 'supertoat' ),
		'name_admin_bar'        => __( 'Activity', 'supertoat' ),
		'archives'              => __( 'Activity Archives', 'supertoat' ),
		'attributes'            => __( 'Activity Attributes', 'supertoat' ),
		'parent_item_colon'     => __( 'Parent Activity:', 'supertoat' ),
		'all_items'             => __( 'All Activities', 'supertoat' ),
		'add_new_item'          => __( 'Add New Activity', 'supertoat' ),
		'add_new'               => __( 'Add New', 'supertoat' ),
		'new_item'              => __( 'New Activity', 'supertoat' ),
		'edit_item'             => __( 'Edit Activity', 'supertoat' ),
		'update_item'           => __( 'Update Activity', 'supertoat' ),
		'view_item'             => __( 'View Activity', 'supertoat' ),
		'view_items'            => __( 'View Activities', 'supertoat' ),
		'search_items'          => __( 'Search Activity', 'supertoat' ),
		'not_found'             => __( 'Not found', 'supertoat' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'supertoat' ),
		'featured_image'        => __( 'Featured Image', 'supertoat' ),
		'set_featured_image'    => __( 'Set featured image', 'supertoat' ),
		'remove_featured_image' => __( 'Remove featured image', 'supertoat' ),
		'use_featured_image'    => __( 'Use as featured image', 'supertoat' ),
		'insert_into_item'      => __( 'Insert into item', 'supertoat' ),
		'uploaded_to_this_item' => __( 'Uploaded to this activity', 'supertoat' ),
		'items_list'            => __( 'Activity list', 'supertoat' ),
		'items_list_navigation' => __( 'Activity list navigation', 'supertoat' ),
		'filter_items_list'     => __( 'Filter activity list', 'supertoat' ),
	);
	$args = array(
		'label'                 => __( 'Activity', 'supertoat' ),
		'description'           => __( 'Collection of various activities', 'supertoat' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'revisions' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-buddicons-groups',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
		'rest_base'             => 'activities',
	);
	register_post_type( 'superactivities', $args );

}
add_action( 'init', 'telltec_activities_cpt', 0 );
