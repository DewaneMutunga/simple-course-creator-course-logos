<?php
/**
 * Plugin Name: SCC - Course Logos
 * Plugin URI: http://buildwpyourself.com/downloads/scc-course-logos/
 * Description: Upload a logo to a course.
 * Version: 1.0.0
 * Author: Dewane Mutunga
 * Author URI: http://dewanemutunga.com
 * License: GPL2
 * Requires at least: 3.8
 * Tested up to: 3.8
 * Text Domain: scccl
 * Domain Path: /languages/
 * 
 * This plugin is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as 
 * published by the Free Software Foundation.
 * 
 * This plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, see http://www.gnu.org/licenses/.
 *
 * @package Simple Course Creator
 * @category Output
 * @author Dewane Mutunga
 * @license GNU GENERAL PUBLIC LICENSE Version 2 - /license.txt
 */


// No accessing this file directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * primary class for Simple Course Creator Course Logos
 *
 * @since 1.0.0
 */
 class Simple_Course_Creator_Course_Logos {

	 /**
	 * constructor for Simple_Course_Creator_Course_Logos class
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// define plugin name
		define( 'SCCCL_NAME', 'Simple Course Creator Course Logos' );

		// define plugin version
		define( 'SCCCL_VERSION', '1.0.0' );

		// define plugin directory
		define( 'SCCCL_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

		// define plugin root file
		define( 'SCCCL_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );

		// load text domain
		add_action( 'init', array( $this, 'load_textdomain' ) );

		// require additional plugin files
		$this->includes();
		
		// load plugin styles and scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'course_logos_register_script' ) );
	}

	/**
	 * load Simple Course Creator Logos text domain
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'scccl', false, SCCCL_DIR . "languages" );
	}

	/**
	 * require additional plugin files
	 *
	 * @since 1.0.0
	 */
	private function includes() {
		require_once( SCCCL_DIR . 'includes/display/class-scc-course-logos-hook.php' );		// hooks output class
		require_once( SCCCL_DIR . 'includes/admin/class-scc-course-logos-settings.php' );		// settings class
	}
	
	/**
	 * register plugin styles and scripts
	 *
	 * @since 1.0.0
	 */
	public function course_logos_register_script() {
		wp_enqueue_script( 'course-logos-js', SCCCL_URL . 'assets/js/scc-course-logos.js' );
	}
 }
 new Simple_Course_Creator_Course_Logos(); 
