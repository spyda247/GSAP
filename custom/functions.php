<?php
/**
 * Functions.php
 *
 * @package  Gsap_Customisations
 * @author   Spyda247
 * @since    1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * functions.php
 * Add PHP snippets here
 */

 /* Load GSAP Scripts From CDN */

 function gsap_enqueue_scripts() {
	wp_register_script('gsap-js-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TweenMax.min.js', array(), '2.1.2', true);
	wp_register_script('gsap-js-css-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/plugins/CSSPlugin.min.js', array(), '2.1.2', true);

	wp_enqueue_script('gsap-js-cdn');
	wp_enqueue_script('gsap-js-css-cdn');

 }

 add_action('wp_enqueue_scripts', 'gsap_enqueue_scripts');

 /* End Load GSAP Scripts From CDN  */