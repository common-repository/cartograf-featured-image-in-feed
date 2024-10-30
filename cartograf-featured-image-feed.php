<?php
/*
Plugin Name: Cartograf Featured Image in Feed
Description: Add the featured image to your WordPress site feeds, so that you can enhance the reading experience of your subscribers.
Version: 1.2.1
License: GPL
Author: Jose Alcántara
Author URI: http://www.versvs.net
*/

// including settings page for dashboard
require_once('settings.php');

register_activation_hook( __FILE__, 'cg_fi_activate' );
function cg_fi_activate(){
	if (get_option('cg_fi_backlink_active')===FALSE){
		update_option('cg_fi_backlink_active', true);
		}
}

// Add settings link on plugin page
function cg_fi_settings_link($links) {
	$settings_link = '<a href="options-general.php?page=cg_featured_image_feed">Settings</a>';
	array_unshift($links, $settings_link);
	return $links;
}

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_{$plugin}", 'cg_fi_settings_link' );


// thumbnail para newsletter
add_image_size( 'newsletter', 550, 412, false );


function rss_post_thumbnail($content) {
  global $post;
  //$content = preg_replace( '/<iframe(.*)\/iframe>/is', '', $content );
  if(has_post_thumbnail($post->ID)) {
    $backlink_active = get_option('cg_fi_backlink_active');
    $precontent = '<div style="display: block; margin-right: 10px; text-align:left;">';
    if ( $backlink_active ) {
      $precontent .= '<a title="See content in ' . get_bloginfo("name") . '" href="'.get_permalink($post->ID).'">';
    }
    $precontent .= get_the_post_thumbnail($post->ID, 'newsletter');
    if ( $backlink_active ) {
      $precontent .= '</a>';
    }
    $precontent .= '</div>';

    $content = $precontent . $content;
    }
  return $content;
  }

add_filter('the_excerpt_rss', 'rss_post_thumbnail');
add_filter('the_content_feed', 'rss_post_thumbnail');


?>
