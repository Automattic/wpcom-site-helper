<?php

/**
 * Podcasting administrative settings. Add new section to Media settings for podcast-specific features
 */


/**
 * Add options customization options for video playback element for VideoPress customers who are also VIPs.
 * Adds logo URL and bar color customizations, exposed through media settings
 */
function podcasting_customization_init() {
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
		return;

	add_settings_section( 'podcasting_customization', esc_html__( 'Podcasting' ), 'podcasting_customization_callback', 'media' );

	add_settings_field( 'podcasting_category_id', esc_html__( 'Category to set as feed' ), 'podcasting_category_id_callback', 'media', 'podcasting_customization' );
	register_setting( 'media', 'podcasting_category_id', 'esc_html' );

	if ( Automattic_Podcasting::podcasting_is_enabled() ) {
		add_settings_field( 'podcasting_title', esc_html__( 'Podcast title' ), 'podcasting_title_callback', 'media', 'podcasting_customization' );
		register_setting( 'media', 'podcasting_title', 'esc_attr' );

		add_settings_field( 'podcasting_talent_name', esc_html__( 'Podcast talent name' ), 'podcasting_talent_name_callback', 'media', 'podcasting_customization' );
		register_setting( 'media', 'podcasting_talent_name', 'esc_attr' );

		add_settings_field( 'podcasting_summary', esc_html__( 'Podcast summary' ), 'podcasting_summary_callback', 'media', 'podcasting_customization' );
		register_setting( 'media', 'podcasting_summary', 'esc_attr' );

		add_settings_field( 'podcasting_copyright', esc_html__( 'Podcast copyright' ), 'podcasting_copyright_callback', 'media', 'podcasting_customization' );
		register_setting( 'media', 'podcasting_copyright', 'esc_attr' );

		add_settings_field( 'podcasting_explicit', esc_html__( 'Mark as explicit' ), 'podcasting_explicit_callback', 'media', 'podcasting_customization' );
		register_setting( 'media', 'podcasting_explicit', 'esc_attr' );

		add_settings_field( 'podcasting_image', esc_html__( 'Podcast image' ), 'podcasting_image_callback', 'media', 'podcasting_customization' );
		register_setting( 'media', 'podcasting_image', 'esc_url_raw' );
		add_action( 'update_option_podcasting_image', 'podcasting_delete_image_id' );

		add_settings_field( 'podcasting_category_1', esc_html__( 'Podcast category 1' ), 'podcasting_category_callback', 'media', 'podcasting_customization', 1 );
		register_setting( 'media', 'podcasting_category_1', 'esc_attr' );

		add_settings_field( 'podcasting_category_2', esc_html__( 'Podcast category 2' ), 'podcasting_category_callback', 'media', 'podcasting_customization', 2 );
		register_setting( 'media', 'podcasting_category_2', 'esc_attr' );

		add_settings_field( 'podcasting_category_3', esc_html__( 'Podcast category 3' ), 'podcasting_category_callback', 'media', 'podcasting_customization', 3 );
		register_setting( 'media', 'podcasting_category_3', 'esc_attr' );
	}
}
add_action( 'admin_init', 'podcasting_customization_init' );

/**
 * Delete podcasting_image_id to avoid override the
 * new saved podcasting_image value
 */
function podcasting_delete_image_id() {
	delete_option( 'podcasting_image_id' );
}

/**
 * Fulfill the settings section callback requirement by returning nothing
 */
function podcasting_customization_callback() {
	return;
}

/**
 * Set the category to use for podcast archive
 */
function podcasting_category_id_callback() {
	$args = array( 'hide_empty' => 0 );
	$categories = get_categories( $args );
	$category_ID = Automattic_Podcasting::podcasting_get_podcasting_category_id();

	echo '<fieldset><legend class="screen-reader-text"><span>' . __('Blog category for podcasts') . '</span></legend>';
	echo '<select name="podcasting_category_id" id="podcasting_category_id">';
	if ( ! $category_ID ) {
		echo '<option value="0">' . __( 'Select podcast category:' ) . '</option>';
	} else {
		echo '<option value="0">' . __( 'None' ) . '</option>';
	}

	foreach ( $categories as $category ) {
		echo "<option value='" . esc_attr( $category->cat_ID ) . "' " . selected( $category_ID, $category->cat_ID, false ) . ">" . esc_html( $category->name ) . '</option>';
	}
	echo '</select>';

	if ( $category_ID ) {
		$url = false;
		$term = get_term_by( 'id', $category_ID, 'category' );
		if ( isset( $term->term_id ) ) {
			$url = get_category_feed_link( $term->term_id );
		}

		if ( $url ) {
			echo '<p class="howto">' . sprintf( __( 'Your podcast feed: %1$s' ), '<a href="' . esc_url( $url ) . '">' . esc_url( $url ) . '</a>' ) . '</p>';
			echo '<p class="howto">' . __( 'This is the URL you submit to iTunes or podcasting service.' ) . '</p>';
		}
	}

	echo '</fieldset>';
}

/**
 * Set the title of the podcast
 */
function podcasting_title_callback() {
	$title = get_option( 'podcasting_title', '' );
	if ( empty( $title ) ) {
		$title = get_bloginfo( 'name' );
		$category = get_category( Automattic_Podcasting::podcasting_get_podcasting_category_id() );
		$title = "$title &#187; {$category->name}";
	}

	echo '<fieldset><legend class="screen-reader-text"><span>' . __('Set podcast title') . '</span></legend>';
	echo '<div><input type="text" name="podcasting_title" id="podcasting_title" size="50" value="' . esc_attr( $title ) . '" /></div>';
	echo '</fieldset>';
}

/**
 * Set the talent name of the podcast
 */
function podcasting_talent_name_callback() {
	$author = get_option( 'podcasting_talent_name', '' );
	?>

	<fieldset>
		<legend class="screen-reader-text">
			<span><?php esc_html_e( 'Set podcast author' ); ?></span>
		</legend>
		<div>
			<input type="text" name="podcasting_talent_name" id="podcasting_talent_name" size="50" value="<?php echo esc_attr( $author ); ?>" />
		</div>
	</fieldset>

	<?php
}

/**
 * Set the summary of the podcast
 */
function podcasting_summary_callback() {
	?>

	<fieldset>
		<legend class="screen-reader-text">
			<span><?php echo esc_html__( 'Set podcast summary' ); ?>'</span>
		</legend>
		<div>
			<textarea name="podcasting_summary" id="podcasting_summary" rows="5" cols="50"><?php echo esc_attr( get_option( 'podcasting_summary', '' ) ); ?></textarea>
		</div>
	</fieldset>

	<?php
}

/**
 * Set the copyright of the podcast
 */
function podcasting_copyright_callback() {
	$copyright = get_option( 'podcasting_copyright', '' );
	echo '<fieldset><legend class="screen-reader-text"><span>' . __('Set podcast copyright') . '</span></legend>';
	echo '<div><input type="text" name="podcasting_copyright" id="podcasting_copyright" size="50" value="' . esc_attr( $copyright ) . '" /></div>';
	echo '</fieldset>';
}

/**
 * Set podcast as explicit
 */
function podcasting_explicit_callback() {
	$explicit = get_option( 'podcasting_explicit', 'no' );
	echo '<fieldset><legend class="screen-reader-text"><span>' . __('Set podcast as explicit') . '</span></legend>';
	echo '<div>';
	echo '<select id="podcasting_explicit" name="podcasting_explicit">';
	echo '<option value="no"' . selected( $explicit, 'no', false ) . '>' . __( 'No' ) . '</option>';
	echo '<option value="yes"' . selected( $explicit, 'yes', false ) . '>' . __( 'Yes' ) . '</option>';
	echo '<option value="clean"' . selected( $explicit, 'clean', false ) . '>' . __( 'Clean' ) . '</option>';
	echo '</select>';
	echo '</div>';
	echo '</fieldset>';
}

/**
 * Set the image of the podcast
 */
function podcasting_image_callback() {
	$image = Automattic_Podcasting::podcasting_get_image_url();
	echo '<fieldset><legend class="screen-reader-text"><span>' . __('Set podcast image') . '</span></legend>';
	if ( empty( $image ) ) {
		echo '<div id="podcasting-image"><img id="podcasting-image-preview" src="" alt="" /></div>';
	} else {
		echo '<div id="podcasting-image" class="podcasting-image-set"><img id="podcasting-image-preview" src="' . esc_url( $image ) . '" alt="" /></div>';
	}
	echo '<input type="text" id="podcasting-image-url" name="podcasting_image" size="50" value="' . esc_url( $image ) . '" /><br />';
	echo '<div><em>Minimum size: 1400px &times; 1400px &mdash; maximum size: 2048px &times; 2048px</em></div>';
	echo '</fieldset>';
}

/**
 * Set the category of the podcast
 */
function podcasting_category_callback( $catno ) {
	$catno = intval( $catno );
	$icategory = get_option( 'podcasting_category_' . $catno, '' );
	$categories = array(
		"Arts" => array(
			"Design",
			"Fashion &amp; Beauty",
			"Food",
			"Literature",
			"Performing Arts",
			"Visual Arts"
		),
		"Business" => array(
			"Business News",
			"Careers",
			"Investing",
			"Management &amp; Marketing",
			"Shopping"
		),
		"Comedy" => array(),
		"Education" => array(
			"Educational Technology",
			"Higher Education",
			"K-12",
			"Language Courses",
			"Training"
		),
		"Games &amp; Hobbies" => array(
			"Automotive",
			"Aviation",
			"Hobbies",
			"Other Games",
			"Video Games"
		),
		"Government &amp; Organizations" => array(
			"Local",
			"National",
			"Non-Profit",
			"Regional"
		),
		"Health" => array(
			"Alternative Health",
			"Fitness &amp; Nutrition",
			"Self-Help",
			"Sexuality"
		),
		"Kids &amp; Family" => array(),
		"Music" => array(),
		"News &amp; Politics" => array(),
		"Religion &amp; Spirituality" => array(
			"Buddhism",
			"Christianity",
			"Hinduism",
			"Islam",
			"Judaism",
			"Other",
			"Spirituality",
		),
		"Science &amp; Medicine" => array(
			"Medicine",
			"Natural Sciences",
			"Social Sciences"
		),
		"Society &amp; Culture" => array(
			"History",
			"Personal Journals",
			"Philosophy",
			"Places &amp; Travel"
		),
		"Sports &amp; Recreation" => array(
			"Amateur",
			"College &amp; High School",
			"Outdoor",
			"Professional",
		),
		"Technology" => array(
			"Gadgets",
			"Tech News",
			"Podcasting",
			"Software How-To",
		),
		"TV &amp; Film" => array()
	);

	echo '<fieldset><legend class="screen-reader-text"><span>' . __('Set podcast category') . '</span></legend>';
	echo '<select name="podcasting_category_' . $catno . '" id="podcasting_category_' . $catno . '">';
	if ( ! $icategory ) {
		echo '<option value="0">' . __( 'Select iTunes category:' ) . '</option>';
	} else {
		echo '<option value="0">' . __( 'None' ) . '</option>';
	}

	foreach ( $categories as $category => $subcategories ) {
		$category = esc_attr( $category );
		echo "<option value='$category' " . selected( $icategory, $category, false ) . ">$category</option>";
		foreach ( $subcategories as $subcat ) {
			$disp_cat = esc_attr( "$category &#187; $subcat" );
			$opt_cat = esc_attr( "$category,$subcat" );
			echo "<option value='$opt_cat' " . selected( $icategory, $opt_cat, false ) . ">$disp_cat</option>";
		}
	}
	echo '</select>';

	echo '</fieldset>';
	echo '</div>'; // div id="podcast-settings"
}

function podcasting_settings_media_screen() {
	add_action( 'admin_footer-options-media.php', 'podcasting_settings_scripts' );
	add_action( 'admin_enqueue_scripts', 'podcasting_settings_admin_enqueue_scripts' );
}
add_action( 'load-options-media.php', 'podcasting_settings_media_screen' );

function podcasting_settings_scripts() {
	?>
	<script>
	jQuery( document ).ready( function( $ ) {

		var isPodcastingImage = false;

		$( '#podcasting-image-button' ).click( function( e ) {
			isPodcastingImage = true;
			tb_show( '', 'media-upload.php?type=image&post_id=0&TB_iframe=true' );
			e.preventDefault();
		} );

		window.original_send_to_editor = window.send_to_editor;

		window.send_to_editor = function( html ) {
			var $html  = $( html );
				source = '';

			if ( isPodcastingImage ) {
				if ( $html.is( 'img' ) )
					source = $html.attr( 'src' );
				else if ( $html.is( 'a' ) )
					source = $html.find( 'img' ).attr( 'src' );

				$( '#podcasting-image-url' ).val( source );
				$( '#podcasting-image-preview' ).attr( 'src', source ).show();
				$( '#podcasting-image' ).show();
				isPodcastingImage = false;
				tb_remove();
			} else {
				window.original_send_to_editor( html );
			}
		}

	} );
	</script>
	<style>
	#podcasting-image {
		display: none;
		width: 200px;
		height: 200px;
		text-align: center;
	}
	#podcasting-image.podcasting-image-set {
		display: block;
	}
	#podcasting-image-preview {
		max-width: 100%;
		max-height: 100%;
	}
	</style>
	<?php
}

function podcasting_settings_admin_enqueue_scripts() {
	wp_enqueue_script( 'media-upload' );
	wp_enqueue_style( 'thickbox' );
}
