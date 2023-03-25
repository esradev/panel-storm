<?php
/**
 * Define the routes for this plugin for enable REST Routs for API.
 *
 * @since    1.0.0
 * @access   private
 */


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Panel_Storm_Routes.
 */
class Panel_Storm_Routes {
	/**
	 * Instance
	 *
	 * @access private
	 * @var object Class object.
	 * @since 1.0.0
	 */
	private static $instance;


	/**
	 * Initiator
	 *
	 * @return object Initialized object of class.
	 * @since 1.0.0
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'rest_api_init', [ $this, 'register_routes' ] );
	}

	/**
	 * Register the routes for the objects of the controller.
	 */
	public function register_routes() {
		$version   = '1';
		$namespace = 'panel_storm/v' . $version;

		//Register settings_options rest route
		register_rest_route( $namespace, '/' . 'settings_options', [
			[
				'methods'             => 'GET',
				'callback'            => [ $this, 'get_settings_options' ],
				'permission_callback' => [ $this, 'permissions_check' ],
			],
			[
				'methods'             => 'POST',
				'callback'            => [ $this, 'add_settings_options' ],
				'permission_callback' => [ $this, 'permissions_check' ],
			],
		] );
	}

	/**
	 * Get settings options.
	 */
	public function get_settings_options() {
		$panel_storm_settings_options = get_option( 'panel_storm_settings_options' );
		if ( empty( $panel_storm_settings_options ) ) {
			return new WP_Error( 'no_option', 'Invalid options', [ 'status' => 404 ] );
		}

		return $panel_storm_settings_options;
	}

	/**
	 * Add settings options.
	 */
	public function add_settings_options( $data ) {
		$option      = [
			'apikey'            => $data['apikey'],
			'username'          => $data['username'] ?: '',
			'password'          => $data['password'] ?: '',
			'admin_number'      => $data['admin_number'] ?: '',
			'from_number'       => $data['from_number'] ?: '3000505',
			'from_number_adver' => $data['from_number_adver'] ?: '+98club',
		];
		$option_json = wp_json_encode( $option );

		return update_option( 'panel_storm_settings_options', $option_json );
	}

	/**
	 * Check if a given request has permissions
	 *
	 * @return bool
	 */
	public function permissions_check( $request ) {
		//return true; <--use to make readable by all
		return true;
	}

}

Panel_Storm_Routes::get_instance();
