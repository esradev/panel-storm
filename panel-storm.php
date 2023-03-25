<?php

/**
 * @wordpress-plugin
 * Plugin Name: Panel Storm
 * Plugin URI: https://wpstorm.ir/
 * Description: Customize the login and dashboard page.
 * Version: 1.0.0
 * Requires at least: 5.5
 * Requires PHP: 7.1
 * Author: wpstormdev
 * Text Domain: panel-storm
 * Domain Path: /languages
 *
 * WC requires at least: 3.0
 * WC tested up to: 7.1
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Panel_Storm.
 */
class Panel_Storm {
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
		$this->define_constants();
		$this->panel_storm_loader();

		register_activation_hook( __FILE__, [ $this, 'activate' ] );
		add_action( 'activated_plugin', [ $this, 'activation_redirect' ] );
	}

	/**
	 * Defines all constants
	 *
	 * @since 1.0.0
	 */
	public function define_constants() {

		/**
		 * Defines all constants
		 *
		 * @since 1.0.0
		 */
		define( 'PANEL_STORM_VERSION', '1.0.0' );
		define( 'PANEL_STORM_FILE', __FILE__ );
		define( 'PANEL_STORM_PATH', plugin_dir_path( PANEL_STORM_FILE ) );
		define( 'PANEL_STORM_BASE', plugin_basename( PANEL_STORM_FILE ) );
		define( 'PANEL_STORM_SLUG', 'panel_storm_settings' );
		define( 'PANEL_STORM_SETTINGS_LINK', admin_url( 'admin.php?page=' . PANEL_STORM_SLUG ) );
		define( 'PANEL_STORM_CLASSES_PATH', PANEL_STORM_PATH . 'classes/' );
		define( 'PANEL_STORM_MODULES_PATH', PANEL_STORM_PATH . 'modules/' );
		define( 'PANEL_STORM_URL', plugins_url( '/', PANEL_STORM_FILE ) );
		define( 'PANEL_STORM_WEB_MAIN', 'https://wpstorm.ir/' );
		define( 'PANEL_STORM_WEB_MAIN_DOC', PANEL_STORM_WEB_MAIN . 'panel-storm-wordpress-plugin/' );
	}

	/**
	 * Require loader panel storm class.
	 *
	 * @return void
	 */
	public function panel_storm_loader() {
		require PANEL_STORM_CLASSES_PATH . 'panel-storm-loader.php';
	}

	/**
	 * Require panel storm activator class.
	 *
	 * @return void
	 */
	public function activate() {
		require_once PANEL_STORM_CLASSES_PATH . 'panel-storm-activator.php';
		Panel_Storm_Activator::activate();
	}


	/**
	 * Redirect user to plugin settings page after plugin activated.
	 *
	 * @return void
	 */
	public function activation_redirect() {
		if ( get_option( 'panel_storm_do_activation_redirect', false ) ) {
			delete_option( 'panel_storm_do_activation_redirect' );
			exit( wp_redirect( PANEL_STORM_SETTINGS_LINK ) );
		}
	}
}

Panel_Storm::get_instance();
