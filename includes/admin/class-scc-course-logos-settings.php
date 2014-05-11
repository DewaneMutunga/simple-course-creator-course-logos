<?php
/**
 * SCC Course Logos settings class
 *
 * This class adds new settings to the Simple Course Creator
 * settings page.
 *
 * It does not use add_settings_section() from WordPress Settings API
 * because it uses the settings section already created by SCC. 
 *
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // No accessing this file directly


class SCC_Course_Logos_Settings {


	/**
	 * constructor for SCC_Course_Logos_Settings class
	 */
	public function __construct() {

		// add custom meta fields to new term
		add_action( 'course_add_form_fields', array( $this, 'course_meta_logo' ), 20, 2 );
		add_action( 'course_edit_form_fields', array( $this, 'edit_course_meta_logo' ), 20, 2 );

		// save the term custom meta field inputs
		add_action( 'edited_course', array( $this, 'save_course_meta_logo' ), 20, 2 );  
		add_action( 'create_course', array( $this, 'save_course_meta_logo' ), 20, 2 );
		
		// load plugin styles and scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'course_logos_enqueue_script' ) );
		
	}
	
	/**
	 * add title field when creating a course
	 *
	 * Under the "Posts" dashboard menu, "Courses" is a submenu page
	 * used to create new Courses. During the creation process, which
	 * is exactly the same as creating a new category or tag, a new
	 * field is available for adding the "Course Logo."
	 *
	 * This image appears on the actual posts assigned to an article.
	 * It is the logo for the container holding the course.
	 */
	public function course_meta_logo() { 
		// this will add the custom meta field to the add new term page
	?>
		<div class="form-field">
			<label for="logo_image_id"><?php _e( 'Course Logo', 'scccl' ); ?></label>
			<input name ="logo_image_id" id="logo_image_id" type="text" value="" />
			<div><a class="button" id="upload_logo" href="#">Upload Logo</a></div>
			<div id="logo_image_holder"><!-- We will have our logo image showing here --></div>			
			<p class="description"><?php _e( 'This is the displayed logo of your course.','scccl' ); ?></p>
		</div>
	<?php }


	/**
	 * add course logo field for editing an existing course
	 *
	 * Now that the "Course Logo" field is in place, users need 
	 * to be able to edit it on the term edit screen. This method adds
	 * the form field to the term edit screen and populates it with 
	 * the saved course logo, if it exists.
	 */
	public function edit_course_meta_logo( $term ) {
 
		// put the term ID into a variable
		$course_id = $term->term_id;

		// retrieve the existing value for the course title
		$term_meta = get_option( "taxonomy_$course_id" ); 
		?>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="logo_image_id"><?php _e( 'Course Logo', 'scccl' ); ?></label>
			</th>
			<td>
				<input name="logo_image_id" id="logo_image_id" type="text" value="<?php echo esc_attr( $term_meta['logo_image_id'] ) ? esc_attr( $term_meta['logo_image_id'] ) : ''; ?>" />
				<div><a class="button" id="upload_logo" href="#">Upload Logo</a></div>
				<div id="logo_image_holder"><!-- We will have our logo image showing here --></div>	
				<p class="description"><?php _e( 'This is the displayed logo of your course.','scccl' ); ?></p>
			</td>
		</tr>
	<?php }


	/**
	 * save the course logo
	 *
	 * From both the two above methods, save any edits made to
	 * the "Course Logo" field.
	 *
	 * @used_by course_meta_logo() and edit_course_meta_logo()
	 */
	public function save_course_meta_logo( $term_id ) {
		if ( isset( $_POST['term_meta'] ) ) {
			$course_id = $term_id;
			$term_meta = get_option( "taxonomy_$course_id" );
			$course_keys = array_keys( $_POST['term_meta'] );
			foreach ( $course_keys as $key ) {
				if ( isset ( $_POST['term_meta'][$key] ) ) {
					$term_meta[$key] = $_POST['term_meta'][$key];
				}
			}
			update_option( "taxonomy_$course_id", $term_meta );
		}
	}
	
	/**
	 * enqueue plugin styles and scripts
	 *
	 * @since 1.0.0
	 */
	public function course_logos_enqueue_script() {
		wp_enqueue_media();
	    wp_enqueue_script( 'media-upload' ); // we need this for WordPress Uploader frame
	    wp_enqueue_script( 'thickbox' ); // For modal windows
	    wp_enqueue_style( 'thickbox' );
	}
}
new SCC_Course_Logos_Settings(); 

