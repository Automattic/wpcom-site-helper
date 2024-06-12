<?php
/**
 * Text and Media Widget Styles
 *
 * Global styles for the new text and media widgets introduced in WordPress 4.8.
 *
 * Plugin Name: Text and Media Widget Styles
 * Description: Global styles for the new text and media widgets introduced in WordPress 4.8. Help prevent common display issues in themes.
 * Version: 2.0.1
 * Text Domain: text-media-widget-styles
 */

/* Video Widget */
function wpcom_media_video_styles( $instance ) {
	echo '<style>.widget.widget_media_video iframe { margin: 0; }</style>';
	return $instance;
}
add_filter( 'widget_media_video_instance', 'wpcom_media_video_styles' );

/* Audio Widget */
function wpcom_media_audio_styles( $instance ) {
	echo '<style>';
	echo '.widget.widget_media_audio button { background-color: transparent; box-shadow: none; border: 0; outline: 0; }';
	echo '.widget.widget_media_audio .wp-audio-shortcode { max-width: 100%; }';
	echo '.widget.widget_media_audio .wp-audio-shortcode a { border: 0; }';
	echo '</style>';
	return $instance;
}
add_filter( 'widget_media_audio_instance', 'wpcom_media_audio_styles' );

/* Image Widget */
function wpcom_media_image_styles( $instance ) {
	echo '<style>';
	echo '.widget.widget_media_image { overflow: hidden; }';
	echo '.widget.widget_media_image img { height: auto; max-width: 100%; }';
	echo '</style>';
	return $instance;
}
add_filter( 'widget_media_image_instance', 'wpcom_media_image_styles' );

/* Text Widget */
function wpcom_text_widget_styles() {
	if ( is_rtl() ) {
		wp_enqueue_style( 'wpcom-text-widget-styles-rtl', plugins_url( 'css/widget-text-rtl.css', __FILE__ ), array(), '20170607' );
	} else {
		wp_enqueue_style( 'wpcom-text-widget-styles', plugins_url( 'css/widget-text.css', __FILE__ ), array(), '20170607' );
	}
}
if ( is_active_widget( '', '', 'text' ) ) {
	add_action( 'wp_enqueue_scripts', 'wpcom_text_widget_styles' );
}
