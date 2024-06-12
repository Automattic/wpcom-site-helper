<?php
class Automattic_Podcasting_Settings_REST_API {
	public static function handle_get( $settings ) {
		$settings['podcasting_category_id']  = (int) Automattic_Podcasting::podcasting_get_podcasting_category_id();
		$settings['podcasting_title']        = (string) get_option( 'podcasting_title', '' );
		$settings['podcasting_talent_name']  = (string) get_option( 'podcasting_talent_name', '' );
		$settings['podcasting_summary']      = (string) get_option( 'podcasting_summary', '' );
		$settings['podcasting_copyright']    = (string) get_option( 'podcasting_copyright', '' );
		$settings['podcasting_explicit']     = (string) get_option( 'podcasting_explicit', 'no' );
		$settings['podcasting_image']        = (string) Automattic_Podcasting::podcasting_get_image_url();
		$settings['podcasting_category_1']   = (string) get_option( 'podcasting_category_1', '' );
		$settings['podcasting_category_2']   = (string) get_option( 'podcasting_category_2', '' );
		$settings['podcasting_category_3']   = (string) get_option( 'podcasting_category_3', '' );
		$settings['podcasting_email']        = (string) get_option( 'podcasting_email', '' );
		$settings['podcasting_image_id']     = (int) get_option( 'podcasting_image_id', 0 );

		return $settings;
	}

	public static function filter_input_for_update( $original_input, $unfiltered_input ) {
		$output = (array) $original_input;

		$cast_map = array(
			'podcasting_category_id' => 'int',
			'podcasting_title'       => 'string',
			'podcasting_talent_name' => 'string',
			'podcasting_summary'     => 'string',
			'podcasting_copyright'   => 'string',
			'podcasting_explicit'    => 'string',
			'podcasting_image'       => 'string',
			'podcasting_category_1'  => 'string',
			'podcasting_category_2'  => 'string',
			'podcasting_category_3'  => 'string',
			'podcasting_email'       => 'string',
			'podcasting_image_id'    => 'int',
		);

		foreach( $cast_map as $key => $type ) {
			if ( isset( $unfiltered_input[ $key ] ) ) {
				switch ( $type ) {
					case 'int':
						$output[ $key ] = (int) $unfiltered_input[ $key ];
						break;
					case 'string':
						$output[ $key ] = (string) $unfiltered_input[ $key ];
						break;
				}
			}
		}

		return $output;
	}
}

add_filter( 'site_settings_endpoint_get', array( 'Automattic_Podcasting_Settings_REST_API', 'handle_get' ) );
add_filter( 'rest_api_update_site_settings', array( 'Automattic_Podcasting_Settings_REST_API', 'filter_input_for_update' ), 10, 2 );
