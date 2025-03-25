<?php

namespace TailorSheet_Manager\Core;

use TailorSheet_Manager\Admin\Admin_Handler;
use TailorSheet_Manager\Frontend\Frontend_Handler;

class Bootstrap
{
    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
        if (defined('TAILORSHEET_MANAGER_VERSION')) {
            $this->version = TAILORSHEET_MANAGER_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = TAILORSHEET_MANAGER_NAME_SLUG;

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();

    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Tailorsheet_Manager_Loader. Orchestrates the hooks of the plugin.
     * - Tailorsheet_Manager_i18n. Defines internationalization functionality.
     * - Tailorsheet_Manager_Admin. Defines all hooks for the admin area.
     * - Tailorsheet_Manager_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies()
    {
        /**
         * Exopite Simple Options Framework
         *
         * @link https://github.com/JoeSz/Exopite-Simple-Options-Framework
         * @author Joe Szalai
         */
        require_once TAILORSHEET_MANAGER_BASE_DIR . 'vendor/exopite-simple-options/exopite-simple-options-framework-class.php';

        $this->loader = new Loader();

    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Tailorsheet_Manager_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale()
    {

        $plugin_i18n = new i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');

    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks()
    {

        $plugin_admin = new Admin_Handler($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
        $this->loader->add_action('init', $plugin_admin, 'create_menu', 10);
        // Save/Update our plugin options
        $this->loader->add_action('init', $plugin_admin, 'create_metaboxes', 10);
        $this->loader->add_action('init', $plugin_admin, 'create_metaboxes_examples_appsheet', 10);
        // Custom fields for function-example taxonomy on create, edit, and save hooks
        $this->loader->add_action('ejemplo-de-expresion_add_form_fields', $plugin_admin, 'fe_add_fields', 10);
        $this->loader->add_action('ejemplo-de-expresion_edit_form_fields', $plugin_admin, 'fe_edit_fields', 10, 2);
        $this->loader->add_action('created_ejemplo-de-expresion', $plugin_admin, 'fe_save_term_fields', 10);
        $this->loader->add_action('edited_ejemplo-de-expresion', $plugin_admin, 'fe_save_term_fields', 10);

        // Elementor actions
        $this->loader->add_action('elementor/widgets/register', $plugin_admin, 'register_elementor_widgets');
        $this->loader->add_action('elementor/elements/categories_registered', $plugin_admin, 'register_elementor_tailorsheet_manager_category');


        // Search posts by name using like wildcard syntax
        $this->loader->add_filter('posts_where', $plugin_admin, 'search_posts_by_name_like', 10, 2);

        $plugin_post_types = new Post_Types();

        /**
         * The problem with the initial activation code is that when the activation hook runs, it's after the init hook has run,
         * so hooking into init from the activation hook won't do anything.
         * You don't need to register the CPT within the activation function unless you need rewrite rules to be added
         * via flush_rewrite_rules() on activation. In that case, you'll want to register the CPT normally, via the
         * loader on the init hook, and also re-register it within the activation function and
         * call flush_rewrite_rules() to add the CPT rewrite rules.
         *
         * @link https://github.com/DevinVinson/WordPress-Plugin-Boilerplate/issues/261
         */
        $this->loader->add_action('init', $plugin_post_types, 'create_custom_post_type', 900);


        /**
        * This function runs when WordPress completes its upgrade process
        * It iterates through each plugin updated to see if ours is included
        * @param $upgrader_object Array
        * @param $options Array
        */
        $this->loader->add_action('upgrader_process_complete', $plugin_admin, 'upgrader_process_complete', 10, 2);

        /**
        * Show a notice to anyone who has just updated this plugin
        * This notice shouldn't display to anyone who has just installed the plugin for the first time
        */
        $this->loader->add_action('admin_notices', $plugin_admin, 'display_update_notice');
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks()
    {

        $plugin_frontend = new Frontend_Handler($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_frontend, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_frontend, 'enqueue_scripts');

        $this->loader->add_action('wp_ajax_prefix_query_tailorsheet_manager', $plugin_frontend, 'query_tailorsheet_manager');
        $this->loader->add_action('wp_ajax_nopriv_prefix_query_tailorsheet_manager', $plugin_frontend, 'query_tailorsheet_manager');

        $this->loader->add_action('wp_ajax_prefix_query_tailorsheet_manager_by_category', $plugin_frontend, 'query_tailorsheet_manager_by_category');
        $this->loader->add_action('wp_ajax_nopriv_prefix_query_tailorsheet_manager_by_category', $plugin_frontend, 'query_tailorsheet_manager_by_category');

    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name()
    {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Tailorsheet_Manager_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }

}
