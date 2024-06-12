<?php
/**
 * Podcasting for WordPress
 *
 */

add_action( 'plugins_loaded', 'automattic_podcasting_init' );

function automattic_podcasting_init() {
	$automattic_podcasting_init = new Automattic_Podcasting();
}

class Automattic_Podcasting {
	function __construct() {
		if ( is_admin() ) {
			require_once plugin_dir_path( __FILE__ ) . 'podcasting/settings.php';
		}

		require_once plugin_dir_path( __FILE__ ) . 'podcasting/settings-rest-api.php';

		if ( self::podcasting_is_enabled() ) {
			add_action( 'after_setup_theme', array( 'Automattic_Podcasting', 'podcasting_add_post_thumbnail_support' ), 20 ); // Later then themes normally do.
			remove_action( 'rss2_head', 'rss2_blavatar' );
			remove_action( 'rss2_head', 'rss2_site_icon' );
			remove_filter( 'the_excerpt_rss', 'add_bug_to_feed', 100 );
			remove_action( 'rss2_head', 'rsscloud_add_rss_cloud_element' );

			if ( ! is_admin() ) {
				add_action( 'wp', array( 'Automattic_Podcasting', 'podcasting_custom_feed' ) );
			}

			require_once plugin_dir_path( __FILE__ ) . 'podcasting/widget.php';
		}
	}

	/**
	 * Load the file containing iTunes specific feed hooks.
	 *
	 * @uses podcasting/customize-feed.php
	 */
	static function podcasting_custom_feed() {
		if ( is_feed() && is_category( self::podcasting_get_podcasting_category_id() ) ) {
			require_once plugin_dir_path( __FILE__ ) . 'podcasting/customize-feed.php';
		}
	}

	/**
	 * Ensure that theme support for post thumbnails exists.
	 * We will be using these for episode-level feed images.
	 */
	static function podcasting_add_post_thumbnail_support() {
		add_theme_support( 'post-thumbnails' );
	}

	/**
	 * Returns the URL of the image used for podcasting (if any).
	 */
	static function podcasting_get_image_url() {
		$image_id = get_option( 'podcasting_image_id', false );
		if ( $image_id && is_numeric( $image_id ) && wp_attachment_is_image( $image_id ) ) {
			return wp_get_attachment_url( $image_id );
		} else {
			return get_option( 'podcasting_image', '' );
		}
	}

	/**
	 * Returns the ID of the category used for podcasting (if any).
	 */
	static function podcasting_get_podcasting_category_id() {
		$cat_ID = get_option( 'podcasting_category_id', false );

		if ( false !== $cat_ID ) {
			$category = get_category( $cat_ID );
			if ( ! $category || ! isset( $category->term_id ) ) {
				return false;
			}
			return (int) $category->term_id;
		}

		$category_archive = get_option( 'podcasting_archive', false );

		if ( false === $category_archive ) {
			return false;
		}

		$category = get_term_by( 'slug', $category_archive, 'category' );

		if ( ! $category || ! isset( $category->term_id ) ) {
			return false;
		}

		return (int) $category->term_id;
	}

	/**
	 * Is podcasting enabled?
	 *
	 * If the user has chosen a category for their podcast feed
	 * this function will return true. If not, then false.
	 *
	 * @return bool
	 */
	static function podcasting_is_enabled() {
		return (bool) self::podcasting_get_podcasting_category_id();
	}
}
