<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              facebook.com/mrnotsocreative5278
 * @since             1.0.0
 * @package           No_Login_No_Price
 *
 * @wordpress-plugin
 * Plugin Name:       No Login No Price
 * Plugin URI:        https://github.com/shihab202/No-Login-No-Price-wp-Plugin
 * Description:       Hides price and add to cart button for logged out users and non users. Vistior can only purchase product once logged in. For any custom request contact me by clicking on my name below
 * Version:           1.0.0
 * Author:            Shihab M. Chowdhury
 * Author URI:        wa.me/+8801774295683
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       no-login-no-price
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'NO_LOGIN_NO_PRICE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-no-login-no-price-activator.php
 */
function activate_no_login_no_price() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-no-login-no-price-activator.php';
	No_Login_No_Price_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-no-login-no-price-deactivator.php
 */
function deactivate_no_login_no_price() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-no-login-no-price-deactivator.php';
	No_Login_No_Price_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_no_login_no_price' );
register_deactivation_hook( __FILE__, 'deactivate_no_login_no_price' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-no-login-no-price.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_no_login_no_price() {

	$plugin = new No_Login_No_Price();
	$plugin->run();

}
run_no_login_no_price();


//Function Starts

add_action('after_setup_theme','activate_filter') ; 
function activate_filter(){
add_filter('woocommerce_get_price_html', 'price_true');
}
function price_true($price){
if(is_user_logged_in() ){
return $price;
}
else
{
//Product Purchase False for non logged users
add_filter('woocommerce_is_purchasable', '__return_false');
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
return '<a href="' . get_permalink(woocommerce_get_page_id('myaccount')) . '">Login for Price</a>';
}
}


//This code hide prices for only shop page and product catalogue, not for the widgets

add_action( 'init', 'purchase_false_price_hidden' );

function purchase_false_price_hidden() {   
if ( ! is_user_logged_in() ) {     


	//Add to cart Replaces with something else if theme forces
add_filter('woocommerce_is_purchasable', '__return_false');

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );   
add_action( 'woocommerce_single_product_summary', 'print_Message', 31 );
}
}

function print_Message() {
echo '<a href="' . get_permalink(wc_get_page_id('myaccount')) . '">' . __('Login for Price', 'theme_name') . '</a>';
}