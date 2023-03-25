<?php

/**
 * Fired during plugin activation.
 *
 * @since      1.0.0
 */

class Panel_Storm_Activator {

	public static function activate() {

		// This option added for redirect after activation
		add_option( 'panel_storm_do_activation_redirect', true );
	}
}
