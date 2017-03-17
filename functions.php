<?php

define('DEBUG', true);

function dg_scripts() {
  if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
    if (DEBUG) {
     wp_register_script('dev', get_template_directory_uri() . '/js/main.js');
     wp_enqueue_script('dev');
    }
  }
}

function dg_styles() {
  if (DEBUG) {
    wp_register_style('dev', get_template_directory_uri() . '/css/style.css');
    wp_enqueue_style('dev');
  }
}

function remove_admin_bar() {
  return false;
}
add_filter('show_admin_bar', 'remove_admin_bar');

// Remove 'text/css' from our enqueued stylesheet
function dg_style_remove($tag) {
  return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}
add_filter('style_loader_tag', 'dg_style_remove');

function remove_wp_ver_css_js( $src ) {
  if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
    $src = remove_query_arg( 'ver', $src );
  return $src;
}

add_filter('style_loader_src', 'remove_wp_ver_css_js', 9999);
add_filter('script_loader_src', 'remove_wp_ver_css_js', 9999);


function remove_head_scripts() {
  remove_action('wp_head', 'wp_print_scripts');
  remove_action('wp_head', 'wp_print_head_scripts', 9);
  remove_action('wp_head', 'wp_enqueue_scripts', 1);

  add_action('wp_footer', 'wp_print_scripts', 5);
  add_action('wp_footer', 'wp_enqueue_scripts', 5);
  add_action('wp_footer', 'wp_print_head_scripts', 5);
}

// Actions
add_action('init', 'dg_scripts');
add_action('wp_enqueue_scripts', 'dg_styles');
add_action('wp_enqueue_scripts', 'remove_head_scripts');
// Remove the REST API endpoint.
remove_action('rest_api_init', 'wp_oembed_register_route');
// Turn off oEmbed auto discovery.
// Don't filter oEmbed results.
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
// Remove oEmbed discovery links.
remove_action('wp_head', 'wp_oembed_add_discovery_links');
// Remove oEmbed-specific JavaScript from the front-end and back-end.
remove_action('wp_head', 'wp_oembed_add_host_js');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_resource_hints', 2);
remove_action('wp_head', 'rest_output_link_wp_head');

// disable emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

?>
