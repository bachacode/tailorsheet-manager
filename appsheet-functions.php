<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://bachacode.com
 * @since             1.0.0
 * @package           Appsheet_Functions
 *
 * @wordpress-plugin
 * Plugin Name:       Appsheet Functions
 * Plugin URI:        https://bachacode.com
 * Description:       Plugin for the management of Appsheet Functions and examples of their uses
 * Version:           1.0.0
 * Author:            Cristhian Flores
 * Author URI:        https://bachacode.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       appsheet-functions
 * Domain Path:       /languages
 * Requires Plugins: elementor
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('APPSHEET_FUNCTIONS_VERSION', '1.0.0');

/**
 * Store plugin base dir, for easier access later from other classes.
 * (eg. Include, pubic or admin)
 */
define( 'APPSHEET_FUNCTIONS_BASE_DIR', plugin_dir_path( __FILE__ ) );

/**
 * Initialize custom templater
 */
if( ! class_exists( 'Custom_Template_Loader' ) ) {
    require_once plugin_dir_path( __FILE__ ) . 'includes/libraries/class-appsheet-functions-template-loader.php';
}

/**
 * Helper functions for elementor templating
 */
require_once  plugin_dir_path( __FILE__ ) . 'includes/elementor.php';

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-appsheet-functions-activator.php
 */
function activate_appsheet_functions()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-appsheet-functions-activator.php';
    Appsheet_Functions_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-appsheet-functions-deactivator.php
 */
function deactivate_appsheet_functions()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-appsheet-functions-deactivator.php';
    Appsheet_Functions_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_appsheet_functions');
register_deactivation_hook(__FILE__, 'deactivate_appsheet_functions');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-appsheet-functions.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_appsheet_functions()
{
    $plugin = new Appsheet_Functions();
    $plugin->run();
}
run_appsheet_functions();
