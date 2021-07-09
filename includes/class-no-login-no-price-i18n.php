<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       facebook.com/mrnotsocreative5278
 * @since      1.0.0
 *
 * @package    No_Login_No_Price
 * @subpackage No_Login_No_Price/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    No_Login_No_Price
 * @subpackage No_Login_No_Price/includes
 * @author     Shihab Mahmood <shhbmahmud13@gmail.com>
 */
class No_Login_No_Price_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'no-login-no-price',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
