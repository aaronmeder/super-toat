<?php

  /**
   * Load scripts and styles.
   */

  function supertoat_scripts() {

    // Theme styles
    wp_enqueue_style( 'supertoat-styles', get_stylesheet_directory_uri() .'/dist/site.css', '', '2.2' );

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
