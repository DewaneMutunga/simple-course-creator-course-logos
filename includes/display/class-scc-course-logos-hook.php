<?php
/**
 * SCC_Course_Logos_Hook class
 *
 * This class is responsible for hooking the course logos
 * into Simple Course Creator's post listing on the front-end.
 *
 * It uses SCC's "scc_container_top" hook to place the information
 * based on the plugin settings. 
 *
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // No accessing this file directly


class SCC_Course_Logos_Hook {

	/**
	 * constructor for SCC_Course_Logos_Hook class
	 */
	public function __construct() {

		// load course logos output information
		add_action( 'scc_container_top', array( $this, 'before_title_course_logos' ) );
	}

	/**
	 * output course logos above course titles
	 *
	 * The information output in this method is applied 
	 * to whatever course it's assigned to.
	 */
	public function before_title_course_logos( $post_id ) {
		echo "";
	}
}
new SCC_Course_Logos_Hook();