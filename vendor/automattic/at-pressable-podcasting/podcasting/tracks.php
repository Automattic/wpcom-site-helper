<?php
declare( strict_types = 1 );

/**
 * Tracks instrumentation for podcast publishing on WordPress.com.
 */

class Automattic_Podcasting_Tracks {

	/** @var \Automattic\Jetpack\Tracking|null */
	private $jetpack_tracking = null;

	public static function init() {
		static $done = false;
		if ( $done ) {
			return;
		}
		$done = true;

		$instance = new self();
		// wp_after_insert_post fires after post, terms, and meta are saved. Required for
		// Gutenberg/REST publishes where transition_post_status runs before terms are set.
		add_action( 'wp_after_insert_post', array( $instance, 'record_episode_published' ), 10, 4 );
		add_action( 'add_attachment', array( $instance, 'record_media_uploaded' ) );
	}

	public function record_episode_published( $post_id, $post, $update, $post_before ) {
		if ( ! $post instanceof WP_Post ) {
			return;
		}
		if ( 'publish' !== $post->post_status ) {
			return;
		}
		if ( $post_before && 'publish' === $post_before->post_status ) {
			return;
		}

		if ( defined( 'WP_IMPORTING' ) && WP_IMPORTING ) {
			return;
		}

		if ( function_exists( 'is_headstart_post' ) && is_headstart_post( $post ) ) {
			return;
		}

		if ( in_array( $post->post_type, array( 'attachment', 'revision', 'nav_menu_item' ), true ) ) {
			return;
		}

		$category_id = Automattic_Podcasting::podcasting_get_podcasting_category_id();
		if ( ! $category_id ) {
			return;
		}

		if ( ! in_category( $category_id, $post ) ) {
			return;
		}

		// Match the RSS feed's definition of an episode: must carry an audio or video enclosure.
		// Without this, a post merely categorized into the podcasting category would fire even
		// when it has no media — the top offenders pre-filter were posting 50+/day of non-podcast content.
		if ( ! $this->has_podcast_media( $post ) ) {
			return;
		}

		$is_first = $this->is_first_episode_for_site( $category_id, (int) $post->ID );
		$identity = $this->identity_for_post( $post );

		// blog_id is auto-attached by both tracks_record_event (Simple) and
		// \Automattic\Jetpack\Tracking (Atomic via Jetpack_Options::get_option('id')).
		// Passing it here would overwrite Jetpack's connected id with the local one on Atomic.
		$this->record_event(
			$identity,
			'wpcom_podcast_episode_published',
			array(
				'post_id'                   => (int) $post->ID,
				'is_first_episode_for_site' => (bool) $is_first,
			)
		);

		// add_option() is atomic — only one concurrent caller per site wins the INSERT,
		// so wpcom_podcast_show_launched fires exactly once per site.
		if ( $is_first && add_option( 'podcast_show_launched_tracked', time(), '', false ) ) {
			$this->record_event(
				$identity,
				'wpcom_podcast_show_launched',
				array(
					'post_id' => (int) $post->ID,
				)
			);
		}
	}

	public function record_media_uploaded( $attachment_id ) {
		if ( defined( 'WP_IMPORTING' ) && WP_IMPORTING ) {
			return;
		}

		$attachment = get_post( $attachment_id );
		if ( $attachment && function_exists( 'is_headstart_post' ) && is_headstart_post( $attachment ) ) {
			return;
		}

		if ( ! Automattic_Podcasting::podcasting_is_enabled() ) {
			return;
		}

		$mime_type = get_post_mime_type( $attachment_id );
		if ( ! $mime_type || ( 0 !== strpos( $mime_type, 'audio/' ) && 0 !== strpos( $mime_type, 'video/' ) ) ) {
			return;
		}

		$this->record_event(
			wp_get_current_user(),
			'wpcom_podcast_media_uploaded',
			array(
				'attachment_id' => (int) $attachment_id,
				'mime_type'     => (string) $mime_type,
			)
		);
	}

	private function identity_for_post( $post ) {
		// Scheduled/cron publishes have no logged-in user; attribute to the post author.
		if ( ! empty( $post->post_author ) ) {
			$user = get_userdata( (int) $post->post_author );
			if ( $user ) {
				return $user;
			}
		}
		return wp_get_current_user();
	}

	/**
	 * Dispatches via wpcom's global on Simple, Jetpack's Tracking class on Atomic.
	 * Returns silently if neither is available so the Atomic copy in at-pressable-podcasting cannot fatal.
	 */
	private function record_event( $user, $event_name, $props ) {
		// Jetpack's Tracking class dereferences $user->ID and $user->get() — normalize to WP_User.
		if ( is_numeric( $user ) ) {
			$user = get_userdata( (int) $user );
		}
		if ( ! $user instanceof WP_User ) {
			$user = wp_get_current_user();
		}

		if ( ! function_exists( 'tracks_record_event' ) && function_exists( 'require_lib' ) ) {
			require_lib( 'tracks/client' );
		}

		if ( function_exists( 'tracks_record_event' ) ) {
			return tracks_record_event( $user, $event_name, $props );
		}

		if ( class_exists( '\Automattic\Jetpack\Tracking' ) ) {
			if ( null === $this->jetpack_tracking ) {
				$this->jetpack_tracking = new \Automattic\Jetpack\Tracking();
			}
			return $this->jetpack_tracking->tracks_record_event( $user, $event_name, $props );
		}

		return null;
	}

	/**
	 * Requires the post to reference audio or video media.
	 * Matches the methods documented at wordpress.com/support/audio/podcasting/:
	 * Gutenberg blocks, Classic-editor attachments, or a bare media URL in content.
	 */
	private function has_podcast_media( $post ) {
		// Gutenberg blocks — cheap string scan, no parsing.
		if (
			has_block( 'core/audio', $post )
			|| has_block( 'core/video', $post )
			|| has_block( 'videopress/video', $post )
			|| has_block( 'jetpack/videopress', $post )
		) {
			return true;
		}

		// Classic editor: media attached directly to the post.
		$attached = new WP_Query(
			array(
				'post_parent'            => (int) $post->ID,
				'post_type'              => 'attachment',
				'post_mime_type'         => array( 'audio', 'video' ),
				'posts_per_page'         => 1,
				'fields'                 => 'ids',
				'no_found_rows'          => true,
				'update_post_meta_cache' => false,
				'update_post_term_cache' => false,
				'suppress_filters'       => true,
			)
		);
		if ( ! empty( $attached->posts ) ) {
			return true;
		}

		// Bare media URLs in content (common podcast formats).
		if ( preg_match( '#https?://\S+\.(mp3|m4a|ogg|wav|mp4|m4v|mov)\b#i', $post->post_content ) ) {
			return true;
		}

		return false;
	}

	private function is_first_episode_for_site( $category_id, $current_post_id ) {
		$existing = new WP_Query(
			array(
				'post_status'      => 'publish',
				'post_type'        => 'post',
				'cat'              => (int) $category_id,
				'post__not_in'     => array( (int) $current_post_id ),
				'posts_per_page'   => 1,
				'fields'           => 'ids',
				'no_found_rows'    => true,
				'suppress_filters' => true,
			)
		);

		return empty( $existing->posts );
	}
}
