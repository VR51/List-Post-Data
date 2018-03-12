<?php
/*
Plugin Name: List Post Data
Contributors: leehodson
Author: Lee Hodson
Author URI: https://vr51.com
Tags: post,posts,data,info,list
Donate link: https://paypal.me/vr51
Plugin URI: https://journalxtra.com/
Description: See and display information about all post types registered for a site. Information about post types is displayed in the admin Dashboard and in the List Post Data admin page (LPD). The shortcode [lpd] can be used to display post data in any page or post. Table rows can be clicked to make the deep data box sticky. Data boxes can be dragged around the screen.
Requires at least: 4.0.0
Tested up to: 4.9.4
Stable tag: 1.0.1
Version: 1.0.1
License: GPL3
*/
?>
<?php

if ( ! defined( 'ABSPATH' ) ) exit;


define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'PLUGIN_URL', plugins_url( '/', __FILE__ ) );


if ( is_admin() ) {
		require_once( PLUGIN_PATH . 'src/php/dashboard-widget-loader.php' );
} else {
	require_once( PLUGIN_PATH . 'src/php/front-shortcode-loader.php' );
}
