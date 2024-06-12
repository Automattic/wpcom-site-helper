<?php
/**
 * Register the widget for use in Appearance -> Widgets
 */
add_action( 'widgets_init', 'podcasting_widget_init' );

function podcasting_widget_init() {
	register_widget( 'Podcast_Widget' );
}

class Podcast_Widget extends WP_Widget {
	function __construct() {
		parent::__construct( 'podcast', __( 'Podcast' ), array(
			'classname'   => 'widget-podcast',
			'description' => esc_html__( 'Display information about your Podcast and allow visitors to follow via iTunes' ),
		) );
	}

	function widget( $args, $instance ) {
		if ( ! Automattic_Podcasting::podcasting_is_enabled() ) {
			return;
		}

		$podcast_category = get_category( Automattic_Podcasting::podcasting_get_podcasting_category_id() );

		if ( empty( $podcast_category ) || empty( $podcast_category->slug ) ) {
			return;
		}

		echo $args['before_widget'];

		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$title = apply_filters( 'widget_title', $title );

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$podcast_title     = get_option( 'podcasting_title'     );
		$podcast_summary   = get_option( 'podcasting_summary'   );
		$podcast_copyright = get_option( 'podcasting_copyright' );
		$podcast_image     = Automattic_Podcasting::podcasting_get_image_url();

		if ( ! empty( $podcast_title ) ) {
			echo '<h3 class="podcast_title">' . esc_html( $podcast_title ) . '</h3>';
		}

		if ( ! empty( $podcast_image ) ) {
			$podcast_srcset = $podcast_image;
			if ( function_exists( 'jetpack_photon_url' ) ) {
				$podcast_image  = jetpack_photon_url( $podcast_image, array( 'fit' => '300,300' ), 'https' );
				$podcast_srcset =
					esc_url( jetpack_photon_url( $podcast_image, array( 'fit' => '150,150' ), 'https' ) ) . ', ' .
					esc_url( jetpack_photon_url( $podcast_image, array( 'fit' => '300,300' ), 'https' ) ) . ' 2x, ' .
					esc_url( jetpack_photon_url( $podcast_image, array( 'fit' => '450,450' ), 'https' ) ) . ' 3x';
			}
			echo '<p class="podcast_image_wrapper"><img class="podcast_image" src="' . esc_url( $podcast_image ) . '" srcset="' . $podcast_srcset . '" /></p>';
		}

		if ( ! empty( $podcast_summary ) ) {
			echo '<p class="podcast_summary">' . esc_html( $podcast_summary ) . '</p>';
		}

		if ( ! empty( $podcast_copyright ) ) {
			echo '<p class="podcast_copyright">' . esc_html( $podcast_copyright ) . '</p>';
		}

		echo '<ul class="podcast_subscribe-links">';

		// TODO use a fancy image?
		if ( ! empty( $instance['itunes_feed_id'] ) ) {
			$itunes_subscribe_url = 'https://podcasts.apple.com/podcast/id' . urlencode( $instance['itunes_feed_id'] );
			echo '<li><a href="' . esc_url( $itunes_subscribe_url ) . '">' . esc_html__( 'Listen on Apple Podcasts' ) . '</a></li>';
		}

		if ( ! empty( $instance['spotify_feed_id'] ) ) {
			$spotify_subscribe_url = 'https://open.spotify.com/show/' . urlencode( $instance['spotify_feed_id'] );
			echo '<li><a href="' . esc_url( $spotify_subscribe_url ) . '">' . esc_html__( 'Listen on Spotify' ) . '</a></li>';
		}

		echo '<li><a href="' . esc_url( get_category_feed_link( Automattic_Podcasting::podcasting_get_podcasting_category_id() ) ) . '">' . esc_html__( 'Podcast RSS Feed' ) . '</a></li>';

		echo '</ul>';

		echo $args['after_widget'];
		do_action( 'jetpack_stats_extra', 'widget_view', 'podcasting' );
	}

	function form( $instance ) {
		$title           = isset( $instance['title'] ) ? $instance['title'] : '';
		$itunes_feed_id  = isset( $instance['itunes_feed_id'] ) ? $instance['itunes_feed_id'] : '';
		$spotify_feed_id = isset( $instance['spotify_feed_id'] ) ? $instance['spotify_feed_id'] : '';
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_html_e( 'Title' ); ?> <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'itunes_feed_id' ) ); ?>">
				<?php esc_html_e( 'Apple Podcasts Feed ID' ); ?> (<a href="https://wordpress.com/support/audio/podcasting/#submit-to-apple-podcasts">?</a>) <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'itunes_feed_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'itunes_feed_id' ) ); ?>" type="text" value="<?php echo esc_attr( $itunes_feed_id ); ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'spotify_feed_id' ) ); ?>">
				<?php esc_html_e( 'Spotify Feed ID' ); ?> (<a href="https://wordpress.com/support/audio/podcasting/#submit-to-spotify">?</a>) <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'spotify_feed_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'spotify_feed_id' ) ); ?>" type="text" value="<?php echo esc_attr( $spotify_feed_id ); ?>" />
			</label>
		</p>

		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = isset( $new_instance['title'] ) ? wp_kses( $new_instance['title'], array() ) : '';

		// Strip Apple URL and sanitize ID
		$instance['itunes_feed_id']  = isset( $new_instance['itunes_feed_id'] ) ? sanitize_text_field( str_replace( 'https://podcasts.apple.com/podcast/id', '', $new_instance['itunes_feed_id'] ) ) : '';

		// Strip Spotify URL and sanitize ID
		$instance['spotify_feed_id'] = isset( $new_instance['spotify_feed_id'] ) ? sanitize_text_field( str_replace( 'https://open.spotify.com/show/', '', $new_instance['spotify_feed_id'] ) ) : '';

		return $instance;
	}
}
