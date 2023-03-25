<?php

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Panel_Storm_i18n.
 */
class Panel_Storm_i18n {
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
		add_action( 'plugins_loaded', [$this, 'load_plugin_textdomain'] );
	}

	/**
	 * Load Panel_Storm Text Domain for translation..
	 *
	 * @since  1.0.0
	 * @return void
	 */

	public function load_plugin_textdomain()
	{
		// Default languages directory for Panel_Storm.
		$lang_dir = dirname(PANEL_STORM_BASE) . '/languages';

		//Load Panel_Storm languages for PHP files.
		load_plugin_textdomain('panel-storm', false, $lang_dir);
	}
}

Panel_Storm_i18n::get_instance();

