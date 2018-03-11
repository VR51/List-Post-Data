<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function vr51_lpd_enqueue_dashboard_scripts_styles() {
	wp_register_style( 'vr51-lpd-dashboard-widget', PLUGIN_URL . 'src/css/dashboard-widget.css' );
	wp_enqueue_style( 'vr51-lpd-dashboard-widget' );
	wp_enqueue_style( 'dashicons' );

	wp_register_script( 'vr51-lpd-dashboard-widget', PLUGIN_URL . 'src/js/dashboard-widget.js', array ('jquery'), '', true );
	wp_enqueue_script( 'vr51-lpd-dashboard-widget' );
	wp_enqueue_script( 'jquery-ui-draggable' );
	wp_enqueue_script( 'jquery-ui-resizable' );
}
add_action( 'admin_enqueue_scripts', 'vr51_lpd_enqueue_dashboard_scripts_styles', 100 );

require_once( PLUGIN_PATH . 'src/templates/dashboard-widget.php' );

function vr51_lpd_dasboard_widget() {
	wp_add_dashboard_widget(
		'vr51_lpd',									// Widget slug.
		'List Post Data',						// Title.
		'vr51_lpd_dashboard_widget'	// What to display?
	);
}
add_action( 'wp_dashboard_setup', 'vr51_lpd_dasboard_widget' );