<?php
/**
 * Plugin Name:       GSAP
 * Description:       A Customised plugin for Loading GSAP adapted from WooThemes Themes Customisation Plugin - https://github.com/woocommerce/theme-customisations.
 * Plugin URI:        http://github.com/spyda247/gsap
 * Version:           1.0.0
 * Author:            Spyda247
 * Author URI:        http://github.com/spyda247
 * Requires at least: 3.0.0
 * Tested up to:      4.4.2
 *
 * @package Gsap_Customisations
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main Gsap_Customisations Class
 *
 * @class Gsap_Customisations
 * @version	1.0.0
 * @since 1.0.0
 * @package	Gsap_Customisations
 */
final class Gsap_Customisations {

	/**
	 * Set up the plugin
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'gsap_customisations_setup' ), -1 );
		require_once( 'custom/functions.php' );
	}

	/**
	 * Setup all the things
	 */
	public function gsap_customisations_setup() {
		add_action( 'wp_enqueue_scripts', array( $this, 'gsap_customisations_css' ), 999 );
		add_action( 'wp_enqueue_scripts', array( $this, 'gsap_customisations_js' ) );
		add_filter( 'template_include',   array( $this, 'gsap_customisations_template' ), 11 );
		add_filter( 'wc_get_template',    array( $this, 'gsap_customisations_wc_get_template' ), 11, 5 );
	}

	/**
	 * Enqueue the CSS
	 *
	 * @return void
	 */
	public function gsap_customisations_css() {
		wp_enqueue_style( 'custom-css', plugins_url( '/custom/style.css', __FILE__ ) );
	}

	/**
	 * Enqueue the Javascript
	 *
	 * @return void
	 */
	public function gsap_customisations_js() {
		wp_enqueue_script( 'custom-js', plugins_url( '/custom/custom.js', __FILE__ ), array( 'jquery' ) );
	}

	/**
	 * Look in this plugin for template files first.
	 * This works for the top level templates (IE single.php, page.php etc). However, it doesn't work for
	 * template parts yet (content.php, header.php etc).
	 *
	 * Relevant trac ticket; https://core.trac.wordpress.org/ticket/13239
	 *
	 * @param  string $template template string.
	 * @return string $template new template string.
	 */
	public function gsap_customisations_template( $template ) {
		if ( file_exists( untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/custom/templates/' . basename( $template ) ) ) {
			$template = untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/custom/templates/' . basename( $template );
		}

		return $template;
	}

	/**
	 * Look in this plugin for WooCommerce template overrides.
	 *
	 * For example, if you want to override woocommerce/templates/cart/cart.php, you
	 * can place the modified template in <plugindir>/custom/templates/woocommerce/cart/cart.php
	 *
	 * @param string $located is the currently located template, if any was found so far.
	 * @param string $template_name is the name of the template (ex: cart/cart.php).
	 * @return string $located is the newly located template if one was found, otherwise
	 *                         it is the previously found template.
	 */
	public function gsap_customisations_wc_get_template( $located, $template_name, $args, $template_path, $default_path ) {
		$plugin_template_path = untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/custom/templates/woocommerce/' . $template_name;

		if ( file_exists( $plugin_template_path ) ) {
			$located = $plugin_template_path;
		}

		return $located;
	}
} // End Class

/**
 * The 'main' function
 *
 * @return void
 */
function gsap_customisations_main() {
	new Gsap_Customisations();
}

/**
 * Initialise the plugin
 */
add_action( 'plugins_loaded', 'gsap_customisations_main' );
