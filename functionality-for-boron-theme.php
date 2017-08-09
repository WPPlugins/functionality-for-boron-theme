<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://cohhe.com
 * @since             1.0
 * @package           boron_func
 *
 * @wordpress-plugin
 * Plugin Name:       Functionality for Boron theme
 * Plugin URI:        http://cohhe.com/
 * Description:       This plugin contains Boron theme core functionality
 * Version:           1.2
 * Author:            Cohhe
 * Author URI:        http://cohhe.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       functionality-for-boron-theme
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-boron-functionality-activator.php
 */
function boron_activate_boron_func() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-boron-functionality-activator.php';
	boron_func_Activator::boron_activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-boron-functionality-deactivator.php
 */
function boron_deactivate_boron_func() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-boron-functionality-deactivator.php';
	boron_func_Deactivator::boron_deactivate();
}

register_activation_hook( __FILE__, 'boron_activate_boron_func' );
register_deactivation_hook( __FILE__, 'boron_deactivate_boron_func' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
define('SKYCLEANERS_PLUGIN', plugin_dir_path( __FILE__ ));
require plugin_dir_path( __FILE__ ) . 'includes/class-boron-functionality.php';

require_once plugin_dir_path( __FILE__ ) . 'includes/widgets/widget-about-author.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/widgets/widget-recent-posts-plus.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/widgets/widget-fast-flickr.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/widgets/widget-followers.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_boron_func() {

	$plugin = new boron_func();
	$plugin->boron_run();

}
run_boron_func();

function boron_get_share_icons( $post_id ) {
	return '<div class="single-post-share">
				<a href="http://twitter.com/share?url=' . urlencode( get_the_permalink( $post_id ) ) . '&amp;text=' . urlencode( get_the_title( $post_id ) ) . '" class="social-icon icon-twitter" target="_blank"></a>
				<a href="http://www.facebook.com/sharer.php?u=' . urlencode( get_the_permalink( $post_id ) ) . '" class="social-icon icon-facebook" target="_blank"></a>
				<a href="https://plus.google.com/share?url=' . urlencode( get_the_permalink( $post_id ) ) . '" class="social-icon icon-gplus" target="_blank"></a>
			</div>';
}

function boron_navigation_social() {
	$button1 = boron_navigation_link( get_theme_mod('boron_nav_button1_text'), esc_url(get_theme_mod('boron_nav_button1_link')) );
	$button2 = boron_navigation_link( get_theme_mod('boron_nav_button2_text'), esc_url(get_theme_mod('boron_nav_button2_link')) );
	$button3 = boron_navigation_link( get_theme_mod('boron_nav_button3_text'), esc_url(get_theme_mod('boron_nav_button3_link')) );
	$button4 = boron_navigation_link( get_theme_mod('boron_nav_button4_text'), esc_url(get_theme_mod('boron_nav_button4_link')) );
	$social = '';

	if ( $button1 || $button2 || $button3 || $button4 ) {
		$social .= '<div class="navigation-social"><h6>'.__('Follow us', 'boron') . ':</h6>';
			if ( $button1 ) {
				$social .= $button1;
			}
			if ( $button2 ) {
				$social .= $button2;
			}
			if ( $button3 ) {
				$social .= $button3;
			}
			if ( $button4 ) {
				$social .= $button4;
			}
		$social .= '</div>';
	}

	return $social;
}

function boron_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'boron_remove_more_link_scroll' );

function boron_allowed_tags() {
	global $allowedposttags;
	$allowedposttags['script'] = array(
		'type' => true,
		'src' => true
	);
}
add_action( 'init', 'boron_allowed_tags' );

function boron_customizer_register( $wp_customize ) {

	// Button #1
	$wp_customize->add_section( 'boron_navigation_button1', array(
		'priority'       => 50,
		'capability'     => 'edit_theme_options',
		'title'          => __( 'Button #1' , 'boron'),
		'description'    => __( 'Settings for your button.' , 'boron'),
		'panel'          => 'boron_navigation_panel'
	) );

	$wp_customize->add_setting( 'boron_nav_button1_text', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control(
		'boron_nav_button1_text',
		array(
			'label'      => __( 'Button #1 text', 'boron' ),
			'section'    => 'boron_navigation_button1',
			'type'       => 'text',
		)
	);

	$wp_customize->add_setting( 'boron_nav_button1_link', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control(
		'boron_nav_button1_link',
		array(
			'label'      => __( 'Button #1 link', 'boron' ),
			'section'    => 'boron_navigation_button1',
			'type'       => 'text',
		)
	);

	// Button #2
	$wp_customize->add_section( 'boron_navigation_button2', array(
		'priority'       => 60,
		'capability'     => 'edit_theme_options',
		'title'          => __( 'Button #2' , 'boron'),
		'description'    => __( 'Settings for your button.' , 'boron'),
		'panel'          => 'boron_navigation_panel'
	) );

	$wp_customize->add_setting( 'boron_nav_button2_text', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control(
		'boron_nav_button2_text',
		array(
			'label'      => __( 'Button #2 text', 'boron' ),
			'section'    => 'boron_navigation_button2',
			'type'       => 'text',
		)
	);

	$wp_customize->add_setting( 'boron_nav_button2_link', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control(
		'boron_nav_button2_link',
		array(
			'label'      => __( 'Button #2 link', 'boron' ),
			'section'    => 'boron_navigation_button2',
			'type'       => 'text',
		)
	);

	// Button #3
	$wp_customize->add_section( 'boron_navigation_button3', array(
		'priority'       => 70,
		'capability'     => 'edit_theme_options',
		'title'          => __( 'Button #3' , 'boron'),
		'description'    => __( 'Settings for your button.' , 'boron'),
		'panel'          => 'boron_navigation_panel'
	) );

	$wp_customize->add_setting( 'boron_nav_button3_text', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control(
		'boron_nav_button3_text',
		array(
			'label'      => __( 'Button #3 text', 'boron' ),
			'section'    => 'boron_navigation_button3',
			'type'       => 'text',
		)
	);

	$wp_customize->add_setting( 'boron_nav_button3_link', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control(
		'boron_nav_button3_link',
		array(
			'label'      => __( 'Button #3 link', 'boron' ),
			'section'    => 'boron_navigation_button3',
			'type'       => 'text',
		)
	);

	// Button #4
	$wp_customize->add_section( 'boron_navigation_button4', array(
		'priority'       => 80,
		'capability'     => 'edit_theme_options',
		'title'          => __( 'Button #4' , 'boron'),
		'description'    => __( 'Settings for your button.' , 'boron'),
		'panel'          => 'boron_navigation_panel'
	) );

	$wp_customize->add_setting( 'boron_nav_button4_text', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control(
		'boron_nav_button4_text',
		array(
			'label'      => __( 'Button #4 text', 'boron' ),
			'section'    => 'boron_navigation_button4',
			'type'       => 'text',
		)
	);

	$wp_customize->add_setting( 'boron_nav_button4_link', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control(
		'boron_nav_button4_link',
		array(
			'label'      => __( 'Button #4 link', 'boron' ),
			'section'    => 'boron_navigation_button4',
			'type'       => 'text',
		)
	);

}
add_action( 'customize_register', 'boron_customizer_register' );