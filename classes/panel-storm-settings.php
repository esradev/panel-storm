<?php

/**
 * Panel Storm settings.
 *
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Panel_Storm_Settings {
	public static $actual_link;
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
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_scripts' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_styles' ] );
		add_action( 'admin_menu', [ $this, 'init_menu' ] );

		add_filter( 'plugin_action_links_' . PANEL_STORM_BASE, [ $this, 'settings_link' ] );
		add_action( 'wp_dashboard_setup', [ $this, 'rss_meta_box' ] );
		self::$actual_link = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http' ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since 1.0.0
	 */
	public function admin_enqueue_styles() {
		if ( self::$actual_link === PANEL_STORM_SETTINGS_LINK ) {
			wp_enqueue_style( 'panel-storm-style', PANEL_STORM_URL . 'build/index.css' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since 1.0.0
	 */
	public function admin_enqueue_scripts() {
		wp_enqueue_script(
			'panel-storm-script',
			PANEL_STORM_URL . 'build/index.js',
			[
				'wp-element',
				'wp-i18n',
			],
			'1.0.0',
			true
		);

		/*
		 * Add a localization object ,The base rest api url and a security nonce
		 * @see https://since1979.dev/snippet-014-setup-axios-for-the-wordpress-rest-api/
		 * */
		wp_localize_script(
			'panel-storm-script',
			'panelStormJsObj',
			[
				'rootapiurl'  => esc_url_raw( rest_url() ),
				'nonce'       => wp_create_nonce( 'wp_rest' ),
				'settingsUrl' => PANEL_STORM_SETTINGS_LINK,
			]
		);

		// Load Panel_Storm languages for JavaScript files.
		wp_set_script_translations( 'panel-storm-script', 'panel-storm', PANEL_STORM_PATH . '/languages' );
	}

	/**
	 * Add Admin Menu.
	 *
	 * @return void
	 */
	public function init_menu() {
		add_menu_page(
			__( 'Panel_Storm', 'panel-storm' ),
			__( 'Panel_Storm', 'panel-storm' ),
			'manage_options',
			PANEL_STORM_SLUG,
			[
				$this,
				'admin_page',
			],
			'dashicons-testimonial',
			100
		);
		add_submenu_page(
			PANEL_STORM_SLUG,
			__( 'Panel_Storm', 'panel-storm' ),
			__( 'Settings', 'panel-storm' ),
			'manage_options',
			PANEL_STORM_SLUG,
			[
				$this,
				'admin_page',
			]
		);
	}

	/**
	 * Init Admin Page.
	 *
	 * @return void
	 */
	public function admin_page() {
		include_once PANEL_STORM_MODULES_PATH . 'core/panel-storm-admin-page.php';
	}


	/**
	 * Plugin settings link on all plugins page.
	 *
	 * @since 1.0.0
	 */
	public function settings_link( $links ) {
		// Add settings link
		$settings_link = '<a href="' . PANEL_STORM_SETTINGS_LINK . '">Settings</a>';

		// Add document link
		$doc_link = '<a href="' . PANEL_STORM_WEB_MAIN_DOC . '" target="_blank" rel="noopener noreferrer">Docs</a>';
		array_push( $links, $settings_link, $doc_link );

		return $links;

	}

	/**
	 * Show the latest posts from https://wpstorm.ir/ on dashboard widget
	 *
	 * @since 1.0.0
	 */
	public function rss_meta_box() {
		if ( get_option( 'panel_storm_rss_meta_box', '1' ) == '1' ) {
			add_meta_box(
				'Panel_Storm_Rss',
				__( 'Panel_Storm latest news', 'panel-storm' ),
				[
					$this,
					'rss_postbox_container',
				],
				'dashboard',
				'side',
				'low'
			);
		}

	}

	public function rss_postbox_container() {
		?>
        <div class="panel-storm-rss-widget">
			<?php
			wp_widget_rss_output(
				'https://wpstorm.ir/feed/',
				[
					'items'        => 3,
					'show_summary' => 1,
					'show_author'  => 1,
					'show_date'    => 1,
				]
			);
			?>
        </div>
		<?php

	}
}

Panel_Storm_Settings::get_instance();
