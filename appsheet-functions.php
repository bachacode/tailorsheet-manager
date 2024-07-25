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
 * @since             1.1.2
 * @package           Appsheet_Functions
 *
 * @wordpress-plugin
 * Plugin Name:       Appsheet Functions
 * Plugin URI:        https://bachacode.com
 * Description:       Plugin for the management of Appsheet Functions and examples of their uses
 * Version:           1.1.2
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
 * Start at version 1.1.2 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('APPSHEET_FUNCTIONS_VERSION', '1.1.2');

/**
 * Store plugin base dir, for easier access later from other classes.
 * (eg. Include, public or admin)
 */
define( 'APPSHEET_FUNCTIONS_BASE_DIR', plugin_dir_path( __FILE__ ) );

/**
 * This is useful if you need to display a message or update options, etc...
 */
define( 'APPSHEET_FUNCTIONS_BASE_NAME', plugin_basename( __FILE__ ) );

define( 'APPSHEET_FUNCTIONS_NAME_SLUG', 'appsheet-functions' );

/**
 * Initialize custom templater
 */
if( ! class_exists( 'Custom_Template_Loader' ) ) {
    require_once plugin_dir_path( __FILE__ ) . 'includes/libraries/class-appsheet-functions-template-loader.php';
}

/**
 * Helper functions for elementor templating
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/elementor.php';

if( ! class_exists( '\YahnisElsts\PluginUpdateChecker\v5\Puc_v4_Factory' ) ) {
    require_once plugin_dir_path( __FILE__ ) . 'vendor/plugin-update-checker/plugin-update-checker.php';
}

if(is_admin()) {
    $myUpdateChecker = \YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker(
        'https://github.com/bachacode/appsheet-functions',
        __FILE__,
        APPSHEET_FUNCTIONS_NAME_SLUG
    );

    //Set the branch that contains the stable release.
    $myUpdateChecker->setBranch('main');

    add_action('in_plugin_update_message-appsheet-functions/appsheet-functions.php', 'show_upgrade_notification', 10, 2);
    function show_upgrade_notification( $current_plugin_metadata, $new_plugin_metadata ){
       // check "upgrade_notice"
       if (isset( $new_plugin_metadata->upgrade_notice ) && strlen( trim( $new_plugin_metadata->upgrade_notice ) )  > 0 ) {

            echo '<span style="background-color:#d54e21;padding:6px;color:#f9f9f9;margin-top:10px;display:block;"><strong>' . esc_html( 'Upgrade Notice', 'appsheet-functions' ) . ':</strong><br>';
            echo esc_html( $new_plugin_metadata->upgrade_notice );
            echo '</span>';

       }
    }
}
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
 * @since    1.1.2
 */
function run_appsheet_functions()
{
    $plugin = new Appsheet_Functions();
    $plugin->run();
}
run_appsheet_functions();
