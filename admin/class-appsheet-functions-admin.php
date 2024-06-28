<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://bachacode.com
 * @since      1.0.0
 *
 * @package    Appsheet_Functions
 * @subpackage Appsheet_Functions/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Appsheet_Functions
 * @subpackage Appsheet_Functions/admin
 * @author     Cristhian Flores <bachacode@gmail.com>
 */
class Appsheet_Functions_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
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
		 * defined in Appsheet_Functions_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Appsheet_Functions_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/appsheet-functions-admin.css', array(), $this->version, 'all' );

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
		 * defined in Appsheet_Functions_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Appsheet_Functions_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/appsheet-functions-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function create_menu() {

		/*
		* To add a metabox.
		* This normally go to your functions.php or another hook
		*/
		$config_metabox = array(
	
			/*
			* METABOX
			*/
			'type'              => 'metabox',                       // Required, menu or metabox
			'id'                => $this->plugin_name . '-meta',    // Required, meta box id, unique, for saving meta: id[field-id]
			// 'post_types'        => array( 'page' ),                 // Post types to display meta box
			'post_types'        => array( 'appsheet-functions' ),         // Post types to display meta box
			'context'           => 'advanced',
			'priority'          => 'default',
			'title'             => 'Demo Metabox',                  // The name of this page
			'capability'        => 'edit_posts',                    // The capability needed to view the page
			'tabbed'            => true,
	
		);
	
		$fields[] = array(
			'name'   => 'first',
			'title'  => 'First',
			'icon'   => 'dashicons-admin-generic',
			'fields' => array(
	
				/**
				 * Available fields:
				 * - ACE field
				 * - attached
				 * - backup
				 * - button
				 * - botton_bar
				 * - card
				 * - checkbox
				 * - color
				 * - content
				 * - date
				 * - editor
				 * - group
				 * - hidden
				 * - image
				 * - image_select
				 * - meta
				 * - notice
				 * - number
				 * - password
				 * - radio
				 * - range
				 * - select
				 * - switcher
				 * - tap_list
				 * - text
				 * - textarea
				 * - upload
				 * - video mp4/oembed
				 *
				 * Add your fields, eg.:
				 */
	
				array(
					'id'          => 'function-syntax',
					'type'        => 'text',
					'title'       => 'Text',
					'attributes'    => array(
						'rows'        => 10,
						'cols'        => 5,
						'placeholder' => 'e.g: Function ( value )',
					),
					'help'        => 'The syntax shown on the function description page',
	
				),
			),
		);
	
		/**
		 * instantiate your admin page
		 */
		(new Exopite_Simple_Options_Framework( $config_metabox, $fields ));
	
	}

}
