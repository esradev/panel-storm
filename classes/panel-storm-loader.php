<?php

/**
 * The loader plugin class
 *
 * @since      1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Panel_Storm_Loader.
 */
class Panel_Storm_Loader {

	/**
	 * Instance
	 *
	 * @access private
	 * @var object Class object.
	 * @since 2.0.0
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
		$this->load_dependencies();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		require_once PANEL_STORM_CLASSES_PATH . 'panel-storm-base.php';

		// The class responsible for the settings page
		require_once PANEL_STORM_CLASSES_PATH . 'panel-storm-settings.php';

		// The class responsible for defining internationalization functionality of the plugin.
		require_once PANEL_STORM_CLASSES_PATH . 'panel-storm-i18n.php';

		// The class responsible for defining main options of the plugin.
		require_once PANEL_STORM_CLASSES_PATH . 'panel-storm-options.php';

		// The class responsible for defining REST Routs API of the plugin.
		require_once PANEL_STORM_CLASSES_PATH . 'panel-storm-routes.php';
	}

}

Panel_Storm_Loader::get_instance();


