<?php
/**
 * Plugin Name: Sweet Builder Modules
 * Plugin URI: https://github.com/aadiityaak/sweet-builder
 * Description: Speed up your project with sweet module.
 * Version: 2.0.1
 * Author: Velocity Developer
 * Author URI: https://velocitydeveloper.com
 */

define( 'FL_SWEET_DIR', plugin_dir_path( __FILE__ ) );
define( 'FL_SWEET_URL', plugins_url( '/', __FILE__ ) );

require_once FL_SWEET_DIR . 'classes/aq_resizer.php';
require_once FL_SWEET_DIR . 'classes/class-fl-sweet-builder-loader.php';
require_once FL_SWEET_DIR . 'classes/postview.php';

$postview       = new PostView;

// if single post
function justg_in_single() {

    global $postview, $post;
    if ( is_single() ) {
        $postview->set_post_view($post->ID);
    }

}
add_action('wp_head', 'justg_in_single');

// Fix beaver builder frontend js php
function refresh_bb_cache()
{
  if ( FLBuilderModel::is_builder_enabled() ) {
     FLBuilder::render_js();
     FLBuilder::render_css(); // You can also do this to flush the CSS.
  }
}
// add_action( 'wp', 'refresh_bb_cache' );