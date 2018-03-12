<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
* Register frontend only scripts and styles then request WordPress loads them.
**/

function vr51_lpd_enqueue_front_scripts_styles() {
		wp_register_style( 'vr51-lpd-shortcode', PLUGIN_URL . 'src/css/front-shortcode.css' );
		wp_enqueue_style( 'vr51-lpd-shortcode' );
    wp_enqueue_style( 'dashicons' );

		wp_register_script( 'vr51-lpd-shortcode', PLUGIN_URL . 'src/js/front-shortcode.js', array ('jquery'), '', true );
		wp_enqueue_script( 'vr51-lpd-shortcode' );
    wp_enqueue_script( 'jquery-ui-draggable' );
    wp_enqueue_script( 'jquery-ui-resizable' );
}
add_action( 'wp_enqueue_scripts', 'vr51_lpd_enqueue_front_scripts_styles', 100 );

/**
*	Load the template for the frontend shortcode
**/

function vr51_lpd_shortcode() {
	require_once( PLUGIN_PATH . 'src/templates/front-shortcode.php' );
}

/**
* Register the shortcode
**/

add_shortcode('lpd','vr51_lpd_shortcode');

