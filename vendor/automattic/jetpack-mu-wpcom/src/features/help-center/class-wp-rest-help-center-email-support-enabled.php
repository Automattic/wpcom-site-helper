<?php
/**
 * WP_REST_Help_Center_Email_Support_Enabled file.
 *
 * @package automattic/jetpack-mu-wpcom
 */

namespace A8C\FSE;

use Automattic\Jetpack\Connection\Client;

/**
 * Class WP_REST_Help_Center_Email_Support_Enabled.
 */
class WP_REST_Help_Center_Email_Support_Enabled extends \WP_REST_Controller {
	/**
	 * WP_REST_Help_Center_Email_Support_Enabled constructor.
	 */
	public function __construct() {
		$this->namespace = 'help-center';
		$this->rest_base = '/support-availability';
	}

	/**
	 * Register available routes.
	 */
	public function register_rest_route() {
		register_rest_route(
			$this->namespace,
			$this->rest_base . '/email',
			array(
				'methods'             => \WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_email_support_configuration' ),
				'permission_callback' => 'is_user_logged_in',
			)
		);
	}

	/**
	 * Should return if email contact is enabled for the user.
	 */
	public function get_email_support_configuration() {
		$body = Client::wpcom_json_api_request_as_user( 'help/eligibility/email/mine' );

		if ( is_wp_error( $body ) ) {
			return $body;
		}

		$response = json_decode( wp_remote_retrieve_body( $body ) );

		return rest_ensure_response( $response );
	}
}
