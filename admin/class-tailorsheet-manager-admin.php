<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://bachacode.com
 * @since      1.0.0
 *
 * @package    Tailorsheet_Manager
 * @subpackage Tailorsheet_Manager/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tailorsheet_Manager
 * @subpackage Tailorsheet_Manager/admin
 * @author     Cristhian Flores <bachacode@gmail.com>
 */
class Tailorsheet_Manager_Admin
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
         * defined in Tailorsheet_Manager_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Tailorsheet_Manager_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/tailorsheet-manager-admin.css', array(), $this->version, 'all');

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
         * defined in Tailorsheet_Manager_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Tailorsheet_Manager_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/tailorsheet-manager-admin.js', array( 'jquery' ), $this->version, false);

    }

    public function create_menu()
    {

        $config_menu = array(
            'type'              => 'menu',                                          // Required, menu or metabox
            'id'                => $this->plugin_name . '-settings',                          // Required, meta box id, unique per page, to save: get_option( id )
            'menu'              => 'admin.php',                                         // Required, sub page to your options page
            'submenu'           => false,                                            // Required for submenu
            'position'			=> 4,
            'title'             => esc_html__('Settings', 'tailorsheet-manager'),    //The name of this page
            'menu_title'		=> esc_html__('TailorSheet Manager', 'tailorsheet-manager'),
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
            'title'             => __('Extra fields', 'tailorsheet-manager'),                  // The name of this page
            'capability'        => 'edit_posts',                    // The capability needed to view the page
            'tabbed'            => false,

        );

        $fields[] = array(
            'name'   => 'first',
            'title'  => __('Appsheet Function fields', 'tailorsheet-manager'),
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
                    'title'       => __('Example Syntax', 'tailorsheet-manager'),
                    'attributes'    => array(
                        'rows'        => 10,
                        'cols'        => 5,
                        'placeholder' => 'e.g: Function ( number1, number2 )',
                    ),
                    'help'        => __('The syntax shown on the function description page', 'tailorsheet-manager'),

                ),

                array(
                    'id'          => 'expected_result',
                    'type'        => 'text',
                    'title'       => __('Expected Result', 'tailorsheet-manager'),
                    'attributes'    => array(
                        'rows'        => 10,
                        'cols'        => 5,
                        'placeholder' => 'e.g: Number or Decimal',
                    ),
                    'help' 		=> __('The type of data that is returned by the function', 'tailorsheet-manager'),
                ),

                array(
                    'id'          => 'explanation',
                    'type'        => 'editor',
                    'title'       => __('Explanation', 'tailorsheet-manager'),
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
        if (!function_exists('af_show_template')) {
            return;
        }

        af_show_template('af-admin-function-example-fields');
    }

    public function fe_edit_fields($term, $taxonomy)
    {
        if (!function_exists('af_show_template')) {
            return;
        }

        $syntax = get_term_meta($term->term_id, 'fe_syntax', true);
        $expected = get_term_meta($term->term_id, 'fe_expected', true);

        af_show_template('af-admin-function-example-fields', array(
            'syntax' => $syntax,
            'expected' => $expected
        ));
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

    public function search_posts_by_name_like($where, $q)
    {
        if ($name__like = $q->get('_name__like')) {
            global $wpdb;
            $where .= $wpdb->prepare(
                " AND {$wpdb->posts}.post_name LIKE %s ",
                str_replace(
                    array( '**', '*' ),
                    array( '*',  '%' ),
                    mb_strtolower($wpdb->esc_like($name__like))
                )
            );
        }
        return $where;
    }

    public function register_elementor_widgets($widgets_manager)
    {

        require_once plugin_dir_path(dirname(__FILE__)) . 'widgets/appsheet-functions-examples.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'widgets/appsheet-functions-explanation.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'widgets/appsheet-functions-main.php';

        $widgets_manager->register(new \Elementor_Appsheet_Functions_Examples());
        $widgets_manager->register(new \Elementor_Appsheet_Functions_Explanation());
        $widgets_manager->register(new \Elementor_Appsheet_Functions());
    }

    public function register_elementor_tailorsheet_manager_category($elements_manager)
    {
        $elements_manager->add_category(
            'appsheet-functions',
            [
                'title' => esc_html__('AppSheet Functions', 'tailorsheet-manager'),
            ]
        );
    }

    public function upgrader_process_complete($upgrader_object, $options)
    {

        // If an update has taken place and the updated type is plugins and the plugins element exists
        if ($options['action'] == 'update' && $options['type'] == 'plugin' && isset($options['plugins'])) {

            // Iterate through the plugins being updated and check if ours is there
            foreach ($options['plugins'] as $plugin) {
                if ($plugin == TAILORSHEET_MANAGER_BASE_NAME) {

                    // Your code here, eg display a message:

                    // Set a transient to record that our plugin has just been updated
                    set_transient($this->plugin_name . '_updated', 1);
                    set_transient($this->plugin_name . '_updated_message', esc_html__('Thanks for updating', 'exopite_sof'));

                }
            }
        }
    }

    public function display_update_notice()
    {

        // Check the transient to see if we've just activated the plugin
        if (get_transient($this->plugin_name . '_updated')) {

            /**
             * Display a message.
             */
            // @link https://digwp.com/2016/05/wordpress-admin-notices/
            echo '<div class="notice notice-success is-dismissible"><p><strong>' . get_transient('exopite_sof_updated_message') . '</strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';

            // Delete the transient so we don't keep displaying the activation message
            delete_transient($this->plugin_name . '_updated');
            delete_transient($this->plugin_name . '_updated_message');
        }

    }
}
