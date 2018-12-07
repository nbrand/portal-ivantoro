<?php

/**********CREATE ROOT PATHS*************/
define('THEMEROOT', get_stylesheet_directory_uri());
define('JAVASCRIPT', THEMEROOT . '/js');
define('CSS', THEMEROOT . '/css');
define('SRC', THEMEROOT . '/src');
define('IMG', THEMEROOT . '/img');

add_theme_support( 'post-thumbnails' );

//REMOVE VERSIONS
// remove wp version param from any enqueued scripts
function vc_remove_wp_ver_css_js( $src ) {
  if ( strpos( $src, 'ver=' ) )
  $src = remove_query_arg( 'ver', $src );
  return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
remove_action('wp_head', 'wp_generator');

//REMOVE EMOJI
function disable_wp_emojicons() {
  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
add_action( 'init', 'disable_wp_emojicons' );
function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}
////////////////////////////////////////


/***********REGISTER MENUS***************/
function register_my_menus() {
  register_nav_menus(
    array(
      'main_menu' => __( 'Menu Header' ),
      'footer_menu' => __( 'Menu Footer' ),
    )
  );
}
add_action( 'init', 'register_my_menus' );

//
add_action( 'wp_enqueue_scripts', 'enqueue_and_register_my_scripts' );
function enqueue_and_register_my_scripts(){
 $eventsScripts = array(
   'jquery-ui-draggable',
   'jquery-ui-position',
   'jquery-ui-widget',
   'jquery-ui-core',
   'jquery-ui-mouse',
   'jquery-ui-sortable',
   'jquery-ui-datepicker',
   'jquery-ui-autocomplete',
   'jquery-ui-resizable',
   'jquery-ui-button',
   'jquery-ui-dialogue'
   );
 wp_dequeue_script( $eventsScripts );
 wp_deregister_script( $eventsScripts );
}

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// CUSTOM POST TYPES
register_post_type('testemunhos',
  array(
    'labels' => array(
      'name' => __( 'Testemunhos' ),
      'singular_name' => __( 'Testemunhos' ),
      'add_new' => _x( 'Adicionar testemunho', 'testemunhos' ),
    ),
    'public' => true,
    'publicly_queryable' => true,
    'has_archive' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    'show_ui' => true,
    'query_var' => true,
    'hierarchical' => false,
    'capability_type' => 'post',
    'menu_icon'   => 'dashicons-groups',
    'supports' => array(
      'title',
      'editor',
      'thumbnail',
      'excerpt',
      'page-attributes'
    ),
  )
);


add_action('init', 'create_news_tax');
function create_news_tax() {
  register_taxonomy(
    'categorias-protocolo',
    'protocolos',
    array(
      'label' => __('Categorias'),
      'query_var' => true,
      'hierarchical' => true,
      'rewrite' => array('with_front' => false),
    )
  );
}


function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );


//remove comentarios from admin bar
function remove_links_menu() {
  remove_menu_page('edit.php'); // Posts
  remove_menu_page('edit-comments.php'); // Comentarios
}
add_action( 'admin_menu', 'remove_links_menu' );


if(function_exists('acf_add_options_page')){
  acf_add_options_page(array(
    'page_title'    => 'Opções Testemunhos',
    'menu_title'    => 'Opções Testemunhos',
    'menu_slug'     => 'opcoes_testemunhos',
    'capability'    => 'edit_posts',
    'parent_slug'   => 'edit.php?post_type=testemunhos',
    'position'      => false,
    'icon_url'      => 'dashicons-images-alt2',
    'redirect'      => false,
  ));
}
