<?php

function podcasting_xmlns() {
	echo "\n\t" . 'xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd"' . "\n";
	echo "\t" . 'xmlns:googleplay="http://www.google.com/schemas/play-podcasts/1.0"' . "\n";
}

add_action( 'rss2_ns', 'podcasting_xmlns' );

function podcasting_bloginfo_rss_name( $output ) {
	$title = get_option( 'podcasting_title' );
	if ( empty( $title ) ) {
		$title = get_bloginfo( 'name' );
		$category = get_category( Automattic_Podcasting::podcasting_get_podcasting_category_id() );
		$output = "$title &#187; {$category->name}";
	} else {
		$output = $title;
	}

	return $output;
}

add_filter( 'wp_title_rss', 'podcasting_bloginfo_rss_name' );

function podcasting_modify_default_feed_description( $value, $field ) {
	if ( $field === 'description' ) {
		return get_option( 'podcasting_summary', '' );
	}
	return $value;
}
add_filter( 'bloginfo_rss', 'podcasting_modify_default_feed_description', 10, 2 );

function podcasting_feed_head() {
	$summary = get_option( 'podcasting_summary' );
	if ( ! empty( $summary ) ) {
		echo '<itunes:summary>' . esc_html( strip_tags( $summary ) ) . "</itunes:summary>\n";
		echo '<googleplay:description>' . esc_html( strip_tags( $summary ) ) . "</googleplay:description>\n";
	}

	$author = get_option( 'podcasting_talent_name' );
	if ( ! empty( $author ) ) {
		echo '<itunes:author>' . esc_html( strip_tags( $author ) ) . "</itunes:author>\n";
		echo '<googleplay:author>' . esc_html( strip_tags( $author ) ) . "</googleplay:author>\n";
	}

	$email = get_option( 'podcasting_email' );
	if ( ! empty( $email ) ) {
		echo '<itunes:owner>';
		echo '<itunes:email>' . esc_html( strip_tags( $email ) ) . "</itunes:email>\n";
		echo '</itunes:owner>';
		echo '<googleplay:owner>' . esc_html( strip_tags( $email ) ) . "</googleplay:owner>\n";
		echo '<googleplay:email>' . esc_html( strip_tags( $email ) ) . "</googleplay:email>\n";
	}

	$copyright = get_option( 'podcasting_copyright' );
	if ( !empty( $copyright ) ) {
		echo '<copyright>' . esc_html( strip_tags( $copyright ) ) . "</copyright>\n";
	}

	// Checking against 'yes' because the other two possible values (no and clean) both indicate not explicit content.
	$explicit = get_option( 'podcasting_explicit', 'no' ) === 'yes' ? 'true' : 'false';
	echo '<itunes:explicit>' . esc_html( $explicit ) . "</itunes:explicit>\n";
	echo '<googleplay:explicit>' . esc_html( $explicit ) . "</googleplay:explicit>\n";

	$image = Automattic_Podcasting::podcasting_get_image_url();
	if ( ! empty( $image ) ) {
		if ( function_exists( 'jetpack_photon_url' ) ) {
			$image = jetpack_photon_url( $image, array( 'fit' => '3000,3000' ), 'https' );
		}

		echo "<itunes:image href='" . esc_url( $image ) . "' />\n";
		echo "<googleplay:image href='" . esc_url( $image ) . "' />\n";
	}

	$category_1 = podcasting_generate_category( 'podcasting_category_1' );
	if ( ! empty( $category_1 ) ) {
		echo $category_1;
	}

	$category_2 = podcasting_generate_category( 'podcasting_category_2' );
	if ( ! empty( $category_2 ) ) {
		echo $category_2;
	}

	$category_3 = podcasting_generate_category( 'podcasting_category_3' );
	if ( ! empty( $category_3 ) ) {
		echo $category_3;
	}
}
add_action( 'rss2_head', 'podcasting_feed_head' );

function podcasting_feed_item() {
	global $post;

	$author = get_the_author();
	if ( empty( $author ) ) {
		$author = get_option( 'podcasting_talent_name' );
	}
	echo '<itunes:author>' . esc_html( strip_tags( $author ) ) . "</itunes:author>\n";
	echo '<googleplay:author>' . esc_html( strip_tags( $author ) ) . "</googleplay:author>\n";

	$explicit = get_option( 'podcasting_explicit', 'no' ) === 'yes' ? 'true' : 'false';
	echo '<itunes:explicit>' . esc_html( $explicit ) . "</itunes:explicit>\n";
	echo '<googleplay:explicit>' . esc_html( $explicit ) . "</googleplay:explicit>\n";

	if ( has_post_thumbnail( $post->ID ) ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' );
		if ( ! empty( $image ) ) {
			if ( is_array( $image ) ) {
				$image = $image[0];
			}
			echo "<itunes:image href='" . esc_url( $image ) . "' />\n";
			echo "<googleplay:image href='" . esc_url( $image ) . "' />\n";
		}
	}

	// Summary fallback order: custom excerpt > auto-generated post excerpt > empty string.
	$excerpt = apply_filters( 'the_excerpt_rss', get_the_excerpt() );
	echo '<itunes:summary>' . esc_html( strip_tags( $excerpt ) ) . "</itunes:summary>\n";
	echo '<googleplay:description>' . esc_html( strip_tags( $excerpt ) ) . "</googleplay:description>\n";
}
add_action( 'rss2_item', 'podcasting_feed_item' );

/**
 * Adds the `<itunes:duration>` tag to each RSS enclosure.
 * @return string The supplied enclosure or the supplied enclosure with appended duration
 */
function podcasting_rss_enclosure( $enclosure ) {
	preg_match( '/url="([^"]*)"/i', $enclosure, $result );

	if ( $result ) {
		$attachment_id = attachment_url_to_postid( $result[1] );

		if ( 0 === $attachment_id ) {
			return $enclosure;
		}

		$metadata = wp_get_attachment_metadata( $attachment_id );
		$duration = absint( $metadata['length'] );

		if ( 0 !== $duration ) {
			return $enclosure . '<itunes:duration>' . $duration . "</itunes:duration>\n";
		}
	}

	return $enclosure;
}
add_filter( 'rss_enclosure', 'podcasting_rss_enclosure' );

/**
 * Generate the category elements from the given option (e.g. podcasting_category_1)
 * @param  string $option option to retrieve via get_option
 * @return string The category tag that can be echoed into the feed
 */
function podcasting_generate_category( $option ) {
	$category = get_option( $option );
	$strcat = '';
	switch ( $category ) {
		case 'Education,Education' :
			$category = 'Education';
			break;
		case 'Education,Education Technology' :
			$category = 'Education, Educational Technology';
			break;
		case 'Tech News' :
			$category = 'Technology,Tech News';
			break;
		case 'Sports &amp; Recreation,Technology' :
			$category = 'Technology';
			break;
		case 'Sports &amp; Recreation,Gadgets' :
			$category = 'Technology,Gadgets';
			break;
	}

	if ( ! empty( $category ) ) {
		$splits = explode( ',', $category );
		if ( 2 == count( $splits ) ) {
			$strcat .= "<itunes:category text='" . esc_html( $splits[0] ) . "'>\n";
			$strcat .= "\t<itunes:category text='" . esc_html( $splits[1] ) . "' />\n";
			$strcat .= "</itunes:category>\n";
		} else {
			$strcat .= "<itunes:category text='" . esc_html( $category ) . "' />\n";
		}
	}

	return $strcat;
}

function podcasting_empty_rss_excerpt( $output ) {
	$excerpt = get_the_excerpt();

	if ( empty( $excerpt ) ) {
		return '';
	}

	return $output;
}
add_filter( 'the_excerpt_rss', 'podcasting_empty_rss_excerpt', 1000 ); // Run it super late after any other filters may have inserted something
