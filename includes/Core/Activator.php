<?php

namespace TailorSheet_Manager\Core;

class Activator
{
    /**
     * Short Description. (use period)
     *
     * Long Description.
     * 
     * @return void
     * @since    1.0.0
     */
    public static function activate()
    {
        // ...

        /**
         * Custom Post Types
         */
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
        $plugin_post_types->create_custom_post_type();

        /**
         * This is only required if the custom post type has rewrite!
         *
         * Remove rewrite rules and then recreate rewrite rules.
         *
         * This function is useful when used with custom post types as it allows for automatic flushing of the WordPress
         * rewrite rules (usually needs to be done manually for new custom post types).
         * However, this is an expensive operation so it should only be used when absolutely necessary.
         * See Usage section for more details.
         *
         * Flushing the rewrite rules is an expensive operation, there are tutorials and examples that suggest
         * executing it on the 'init' hook. This is bad practice. It should be executed either
         * on the 'shutdown' hook, or on plugin/theme (de)activation.
         *
         * @link https://codex.wordpress.org/Function_Reference/flush_rewrite_rules
         */
        flush_rewrite_rules();
    }

}
