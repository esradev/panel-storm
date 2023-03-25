<?php

/**
 * Panel Storm options.
 * Define the options for this plugin for save in DB.
 *
 * @package Panel_Storm
 * @since    1.0.0
 * @access   private
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Panel_Storm_Options.
 */
class Panel_Storm_Options {
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
		add_action( 'init', [ $this, 'register_settings_options' ] );
	}

	/**
	 * Register settings options.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function register_settings_options() {
		$panel_storm_settings_options = '';
		add_option( 'panel_storm_settings_options', $panel_storm_settings_options );
	}

}

Panel_Storm_Options::get_instance();
