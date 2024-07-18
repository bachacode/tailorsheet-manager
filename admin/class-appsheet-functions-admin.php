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
class Appsheet_Functions_Admin
{
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
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

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

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/appsheet-functions-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

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

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/appsheet-functions-admin.js', array( 'jquery' ), $this->version, false);

    }

    public function create_menu()
    {

        $config_menu = array(
            'type'              => 'menu',                                          // Required, menu or metabox
            'id'                => $this->plugin_name . '-settings',                          // Required, meta box id, unique per page, to save: get_option( id )
            'menu'              => 'admin.php',                                         // Required, sub page to your options page
            'submenu'           => false,                                            // Required for submenu
            'position'			=> 4,
            'title'             => esc_html__('Settings', 'appsheet-functions'),    //The name of this page
            'menu_title'		=> esc_html__('Appsheet Functions', 'appsheet-functions'),
            'capability'        => 'manage_options',                                // The capability needed to view the page
            'plugin_basename'   => plugin_basename(plugin_dir_path(__DIR__) . $this->plugin_name . '.php'),
            'tabbed'            => false,

        );

        $fields_menu[] = array(
            'name'   => 'first',
            'title'  => 'First',
            'icon'   => 'dashicons-admin-generic',
            'fields' => array(
                array(
                    'id'          => 'text_1',
                    'type'        => 'text',
                    'title'       => 'Text',
                    'before'      => 'Text Before',
                    'after'       => 'Text After',
                    'class'       => 'text-class',
                    'attributes'  => 'data-test="test"',
                    'description' => 'Description',
                    'default'     => 'Default Text',
                    'attributes'    => array(
                        'rows'        => 10,
                        'cols'        => 5,
                        'placeholder' => 'do stuff',
                    ),
                    'help'        => 'Help text',
                ),
            ),
        );

        /**
         * instantiate your admin page
         */
        (new Exopite_Simple_Options_Framework($config_menu, $fields_menu));
    }

    public function create_metaboxes()
    {
        /*
        * To add a metabox.
        * This normally go to your functions.php or another hook
        */
        $config_metabox = array(

            /*
            * METABOX
            */
            'type'              => 'metabox',                       // Required, menu or metabox
            'id'                => 'functions-meta',    // Required, meta box id, unique, for saving meta: id[field-id]
            // 'post_types'        => array( 'page' ),                 // Post types to display meta box
            'post_types'        => array( 'expresiones-appsheet' ),         // Post types to display meta box
            'context'           => 'advanced',
            'options'			=> 'simple',
            'priority'          => 'default',
            'title'             => 'Extra fields',                  // The name of this page
            'capability'        => 'edit_posts',                    // The capability needed to view the page
            'tabbed'            => false,

        );

        $fields[] = array(
            'name'   => 'first',
            'title'  => 'Appsheet Function fields',
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
                    'id'          => 'function_syntax',
                    'type'        => 'text',
                    'title'       => __('Example Syntax', 'appsheet-functions'),
                    'attributes'    => array(
                        'rows'        => 10,
                        'cols'        => 5,
                        'placeholder' => 'e.g: Function ( number1, number2 )',
                    ),
                    'help'        => __('The syntax shown on the function description page', 'appsheet-functions'),

                ),

                array(
                    'id'          => 'expected_result',
                    'type'        => 'text',
                    'title'       => __('Expected Result', 'appsheet-functions'),
                    'attributes'    => array(
                        'rows'        => 10,
                        'cols'        => 5,
                        'placeholder' => 'e.g: Number or Decimal',
                    ),
					'help' 		=> __('The type of data that is returned by the function', 'appsheet-functions'),
                ),

                array(
                    'id'          => 'explanation',
                    'type'        => 'editor',
                    'title'       => __('Explanation', 'appsheet-functions'),
                    'attributes'    => array(
                        'rows'        => 10,
                        'cols'        => 5,
                    ),
                ),
            ),
        );

        /**
         * instantiate your admin page
         */
        (new Exopite_Simple_Options_Framework($config_metabox, $fields));
    }

    public function fe_add_fields()
    {
        ?>
<div class="form-field">
	<label
		for="fe_syntax"><?php echo __('Example use', 'appsheet-functions') ?></label>
	<input type="text" name="fe_syntax" id="fe_syntax" placeholder="e.j: FUNCTION (-1)" />
</div>

<div class="form-field">
	<label
		for="fe_expected"><?php echo __('Expected Result', 'appsheet-functions') ?></label>
	<input type="text" name="fe_expected" id="fe_expected" placeholder="e.j: 1" />
</div>
<?php
    }

    public function fe_edit_fields($term, $taxonomy)
    {

        // Get meta data values
        $syntax = get_term_meta($term->term_id, 'fe_syntax', true);
        $expected = get_term_meta($term->term_id, 'fe_expected', true);

        ?>
<div class="form-field">
	<label
		for="fe_syntax"><?php echo __('Example use', 'appsheet-functions') ?></label>
	<input type="text" name="fe_syntax" id="fe_syntax" placeholder="e.j: FUNCTION (-1)"
		value="<?php echo esc_attr($syntax) ?>" />
</div>

<div class="form-field">
	<label
		for="fe_expected"><?php echo __('Expected Result', 'appsheet-functions') ?></label>
	<input type="text" name="fe_expected" id="fe_expected" placeholder="e.j: 1"
		value="<?php echo esc_attr($expected) ?>" />
</div>
<?php
    }

    public function fe_save_term_fields($term_id)
    {

        update_term_meta(
            $term_id,
            'fe_syntax',
            sanitize_text_field($_POST[ 'fe_syntax' ])
        );
        update_term_meta(
            $term_id,
            'fe_expected',
            absint($_POST[ 'fe_expected' ])
        );

    }
}
?>