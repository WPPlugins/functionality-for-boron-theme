<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    boron_func
 * @subpackage boron_func/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    boron_func
 * @subpackage boron_func/admin
 * @author     Your Name <email@example.com>
 */
class boron_func_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $boron_func    The ID of this plugin.
	 */
	private $boron_func;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $boron_func       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $boron_func, $version ) {

		$this->boron_func = $boron_func;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in boron_func_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The boron_func_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->boron_func, plugin_dir_url( __FILE__ ) . 'css/boron-functionality-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in boron_func_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The boron_func_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->boron_func, plugin_dir_url( __FILE__ ) . 'js/boron-functionality-admin.js', array( 'jquery' ), $this->version, false );

	}

}
