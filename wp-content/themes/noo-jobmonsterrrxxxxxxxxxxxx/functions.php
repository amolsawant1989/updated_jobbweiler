<?php

/**

 * Theme functions for NOO Framework.

 * This file include the framework functions, it should remain intact between themes.

 * For theme specified functions, see file functions-<theme name>.php

 *

 * @package    NOO Framework

 * @version    1.0.0

 * @author     NooTheme Team

 * @copyright  Copyright (c) 2014, NooTheme

 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later

 * @link       https://www.nootheme.com

 */



// Set global constance

define( 'NOO_FRAMEWORK', get_template_directory() . '/framework' );

define( 'NOO_FRAMEWORK_ADMIN', NOO_FRAMEWORK . '/admin' );

define( 'NOO_FRAMEWORK_FUNCTION', NOO_FRAMEWORK . '/functions' );



define( 'NOO_FRAMEWORK_URI', get_template_directory_uri() . '/framework' );

define( 'NOO_FRAMEWORK_ADMIN_URI', NOO_FRAMEWORK_URI . '/admin' );

define( 'NOO_FRAMEWORK_FUNCTION_URI', NOO_FRAMEWORK_URI . '/functions' );



if ( !defined( 'NOO_ASSETS' ) ) {

	define( 'NOO_ASSETS', get_template_directory() . '/assets' );

}



if ( !defined( 'NOO_ASSETS_URI' ) ) {

	define( 'NOO_ASSETS_URI', get_template_directory_uri() . '/assets' );

}



if ( !defined( 'NOO_TEXT_DOMAIN' ) ) {

	define( 'NOO_TEXT_DOMAIN', 'noo' );

}



define( 'NOO_WOOCOMMERCE_EXIST', class_exists( 'WC_API' ) );

define( 'NOO_SUPPORT_PORTFOLIO', false );



// Functions for specific theme

$theme_name = 'custom';

if ( file_exists( get_template_directory() . '/functions_' . $theme_name . '.php' ) ) {

	require_once get_template_directory() . '/functions_' . $theme_name . '.php';

}



if( !function_exists( 'is_plugin_active') ) {

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

}



//

// Helper functions.

//



require_once NOO_FRAMEWORK_FUNCTION . '/noo-theme.php';

require_once NOO_FRAMEWORK_FUNCTION . '/noo-rtl.php';

require_once NOO_FRAMEWORK_FUNCTION . '/noo-utilities.php';

require_once NOO_FRAMEWORK_FUNCTION . '/noo-html.php';

require_once NOO_FRAMEWORK_FUNCTION . '/noo-style.php';

require_once NOO_FRAMEWORK_FUNCTION . '/noo-wp-style.php';

require_once NOO_FRAMEWORK_FUNCTION . '/noo-schema.php';

require_once NOO_FRAMEWORK_FUNCTION . '/noo-css.php';

if(defined('WOOCOMMERCE_VERSION'))

	require_once NOO_FRAMEWORK_FUNCTION . '/woocommerce.php';

require_once NOO_FRAMEWORK_FUNCTION . '/noo-user.php';

require_once NOO_FRAMEWORK_ADMIN . '/noo-setup-install.php';



require_once NOO_FRAMEWORK_FUNCTION . '/noo-ajax-upload.php';

require_once NOO_FRAMEWORK_FUNCTION . '/noo-mailchimp.php';



//Email template

require_once NOO_FRAMEWORK . '/email/loader.php';



//

// Enqueue assets

//

require_once NOO_FRAMEWORK_FUNCTION . '/noo-enqueue-css.php';

require_once NOO_FRAMEWORK_FUNCTION . '/noo-enqueue-js.php';



//

// Admin panel

//



// Initialize theme

require_once NOO_FRAMEWORK_ADMIN . '/_init.php';



// Initialize NOO Customizer

require_once NOO_FRAMEWORK_ADMIN . '/customizer/_init.php';



require_once NOO_FRAMEWORK_ADMIN . '/noo_message.php';

require_once NOO_FRAMEWORK . '/common/loader.php';

require_once NOO_FRAMEWORK . '/job/loader.php';

require_once NOO_FRAMEWORK . '/resume/loader.php';

require_once NOO_FRAMEWORK . '/member/loader.php';

require_once NOO_FRAMEWORK . '/application/loader.php';



require_once NOO_FRAMEWORK_ADMIN . '/noo_job_package.php';

require_once NOO_FRAMEWORK_ADMIN . '/noo_resume_package.php';



require_once NOO_FRAMEWORK_ADMIN . '/noo_job_alert.php';

require_once NOO_FRAMEWORK_ADMIN . '/noo_testimonial.php';



require_once NOO_FRAMEWORK_ADMIN . '/noo_form_handler.php';



// Meta Boxes

require_once NOO_FRAMEWORK_ADMIN . '/meta-boxes/_init.php';



// Mega Menu

require_once NOO_FRAMEWORK_ADMIN . '/mega-menu.php';



if( defined( 'MC4WP_VERSION' ) ) {

	require_once NOO_FRAMEWORK . '/add-ons/class-mc4wp.php';

	mc4wp_register_integration( 'jobmonster-registration-form', 'NOO_JobMonster_MC4WP_Integration' );

}



require_once NOO_FRAMEWORK . '/add-ons/class-fep.php';

require_once NOO_FRAMEWORK . '/add-ons/class-email-confirmation.php';

require_once NOO_FRAMEWORK . '/add-ons/social-login/class-social-login.php';

require_once NOO_FRAMEWORK . '/add-ons/wp-spamshield.php';

require_once NOO_FRAMEWORK . '/add-ons/delete-me.php';

require_once NOO_FRAMEWORK . '/add-ons/wp-social-login.php';



//Job CareerJet

require_once NOO_FRAMEWORK . '/add-ons/careerjet/class-job-careerjet.php';



// SMK Sidebar Generator

if ( !defined( 'SMK_SBG_PATH' ) ) define( 'SMK_SBG_PATH', NOO_FRAMEWORK_ADMIN . '/smk-sidebar-generator/' );

if ( !defined( 'SMK_SBG_URI' ) ) define( 'SMK_SBG_URI', NOO_FRAMEWORK_ADMIN_URI . '/smk-sidebar-generator/' );

require_once SMK_SBG_PATH . 'smk-sidebar-generator.php';



// Visual Composer

require_once NOO_FRAMEWORK_ADMIN . '/visual-composer.php';



//

// Widgets

//

$widget_path = get_template_directory() . '/widgets';



if ( file_exists( $widget_path . '/widgets_init.php' ) ) {

	require_once $widget_path . '/widgets_init.php';

	require_once $widget_path . '/widgets.php';

}



//

// Plugins

// First we'll check if there's any plugins inluded

//

$plugin_path = get_template_directory() . '/plugins';

if ( file_exists( $plugin_path . '/tgmpa_register.php' ) ) {

	require_once NOO_FRAMEWORK_ADMIN . '/class-tgm-plugin-activation.php';

	require_once $plugin_path . '/tgmpa_register.php';

}



//Add ons



require_once NOO_FRAMEWORK . '/add-ons/package-addon/init.php';



//remove emoticons javascript



remove_action('wp_head', 'print_emoji_detection_script', 7);

remove_action('wp_print_styles', 'print_emoji_styles');




//wibbss social media points


add_shortcode( 'mycred_share_this', 'mycred_render_shortcode_share_this' );
function mycred_render_shortcode_share_this( $attr, $link_title )
{
	// Get URL (we assume you only use this shortcode inside the loop)
	$url = get_permalink();

	// Add affiliate link (requires myCRED 1.5.3 or higher)
	$url = mycred_render_affiliate_link( array( 'url' => $url ) );
	// Append social media share urls
	if ( $attr['href'] == 'facebook' )
		$attr['href'] = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode( $url );
	elseif ( $attr['href'] == 'twitter' )
		$attr['href'] = 'http://twitter.com/home?status=' . urlencode( $url );
	elseif ( $attr['href'] == 'google' )
		$attr['href'] = 'http://plus.google.com/share?url=' . urlencode( $url );
	elseif ( $attr['href'] == 'pinterest' )
		$attr['href'] = 'http://pinterest.com/pin/create/button/?url=' . urlencode( $url );

	// Always make links open in a new window
	$attr['target'] = '_blank';

	// Pass it on
	return mycred_render_shortcode_link( $attr, $link_title );
}

