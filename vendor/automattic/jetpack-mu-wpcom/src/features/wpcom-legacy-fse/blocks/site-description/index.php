<?php
/**
 * Render site description file.
 *
 * @package automattic/jetpack-mu-wpcom
 */

namespace Automattic\Jetpack\Jetpack_Mu_Wpcom\Wpcom_Legacy_FSE;

use Automattic\Jetpack\Jetpack_Mu_Wpcom\Common;

/**
 * Renders the site description (tagline) block.
 *
 * @param array $attributes Block attributes.
 * @return string
 */
function render_site_description_block( $attributes ) {
	Common\wpcom_record_tracks_event( 'wpcom_legacy_fse_render_block', array( 'block_name' => 'a8c/site-description' ) );

	ob_start();

	$styles = '';

	$class = 'site-description wp-block-a8c-site-description';
	if ( isset( $attributes['className'] ) ) {
		$class .= ' ' . $attributes['className'];
	}

	$align = ' alignwide';
	if ( isset( $attributes['align'] ) ) {
		$align = empty( $attributes['align'] ) ? '' : ' align' . $attributes['align'];
	}
	$class .= $align;

	if ( isset( $attributes['textAlign'] ) ) {
		$class .= ' has-text-align-' . $attributes['textAlign'];
	} else {
		$class .= ' has-text-align-center';
	}

	if ( isset( $attributes['textColor'] ) ) {
		$class .= ' has-text-color';
		$class .= ' has-' . $attributes['textColor'] . '-color';
	} elseif ( isset( $attributes['customTextColor'] ) ) {
		$class  .= ' has-text-color';
		$styles .= ' color: ' . $attributes['customTextColor'] . ';';
	}

	if ( isset( $attributes['backgroundColor'] ) ) {
		$class .= ' has-background';
		$class .= ' has-' . $attributes['backgroundColor'] . '-background-color';
	} elseif ( isset( $attributes['customBackgroundColor'] ) ) {
		$class  .= ' has-background';
		$styles .= ' background-color: ' . $attributes['customBackgroundColor'] . ';';
	}

	if ( isset( $attributes['fontSize'] ) ) {
		$class .= ' has-' . $attributes['fontSize'] . '-font-size';
	} elseif ( isset( $attributes['customFontSize'] ) ) {
		$styles .= ' font-size: ' . $attributes['customFontSize'] . 'px;';
	} else {
		$class .= ' has-small-font-size';
	}

	?>
	<p class="<?php echo esc_attr( $class ); ?>" style="<?php echo esc_attr( $styles ); ?>">
		<?php bloginfo( 'description' ); ?>
	</p>
	<?php
	return ob_get_clean();
}
