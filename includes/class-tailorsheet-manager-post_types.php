<?php

/**
 * Register custom post type
 *
 * @link       https://bachacode.com
 * @since      1.0.0
 *
 * @package    Tailorsheet_Manager
 * @subpackage Tailorsheet_Manager/includes
 */

class Tailorsheet_Manager_Post_Types
{
    /**
    * Register custom post type
    *
    * @link https://codex.wordpress.org/Function_Reference/register_post_type
    */
    private function register_single_post_type($fields)
    {

        /**
         * Labels used when displaying the posts in the admin and sometimes on the front end.  These
         * labels do not cover post updated, error, and related messages.  You'll need to filter the
         * 'post_updated_messages' hook to customize those.
         */
        $labels = array(
            'name'                  => $fields['plural'],
            'singular_name'         => $fields['singular'],
            'menu_name'             => $fields['menu_name'],
            /* translators: %s: Post type name */
            'new_item'              => sprintf(__('New %s', 'tailorsheet-manager'), $fields['singular']),
            /* translators: %s: Post type name */
            'add_new_item'          => sprintf(__('Add new %s', 'tailorsheet-manager'), $fields['singular']),
            /* translators: %s: Post type name */
            'edit_item'             => sprintf(__('Edit %s', 'tailorsheet-manager'), $fields['singular']),
            /* translators: %s: Post type name */
            'view_item'             => sprintf(__('View %s', 'tailorsheet-manager'), $fields['singular']),
            /* translators: %s: Post type name */
            'view_items'            => sprintf(__('View %s', 'tailorsheet-manager'), $fields['plural']),
            /* translators: %s: Post type name */
            'search_items'          => sprintf(__('Search %s', 'tailorsheet-manager'), $fields['plural']),
            /* translators: %s: Post type name */
            'not_found'             => sprintf(__('No %s found', 'tailorsheet-manager'), strtolower($fields['plural'])),
            /* translators: %s: Post type name */
            'not_found_in_trash'    => sprintf(__('No %s found in trash', 'tailorsheet-manager'), strtolower($fields['plural'])),
            /* translators: %s: Post type name */
            'all_items'             => sprintf(__('All %s', 'tailorsheet-manager'), $fields['plural']),
            /* translators: %s: Post type name */
            'archives'              => sprintf(__('%s Archives', 'tailorsheet-manager'), $fields['singular']),
            /* translators: %s: Post type name */
            'attributes'            => sprintf(__('%s Attributes', 'tailorsheet-manager'), $fields['singular']),
            /* translators: %s: Post type name */
            'insert_into_item'      => sprintf(__('Insert into %s', 'tailorsheet-manager'), strtolower($fields['singular'])),
            /* translators: %s: Post type name */
            'uploaded_to_this_item' => sprintf(__('Uploaded to this %s', 'tailorsheet-manager'), strtolower($fields['singular'])),

            /* Labels for hierarchical post types only. */
            /* translators: %s: Post type name */
            'parent_item'           => sprintf(__('Parent %s', 'tailorsheet-manager'), $fields['singular']),
            /* translators: %s: Post type name */
            'parent_item_colon'     => sprintf(__('Parent %s\:', 'tailorsheet-manager'), $fields['singular']),

            /* Custom archive label.  Must filter 'post_type_archive_title' to use. */
            'archive_title'        => $fields['plural'],
        );

        $args = array(
            'labels'             => $labels,
            'description'        => (isset($fields['description'])) ? $fields['description'] : '',
            'public'             => (isset($fields['public'])) ? $fields['public'] : true,
            'publicly_queryable' => (isset($fields['publicly_queryable'])) ? $fields['publicly_queryable'] : true,
            'exclude_from_search' => (isset($fields['exclude_from_search'])) ? $fields['exclude_from_search'] : false,
            'show_ui'            => (isset($fields['show_ui'])) ? $fields['show_ui'] : true,
            'show_in_menu'       => (isset($fields['show_in_menu'])) ? $fields['show_in_menu'] : true,
            'query_var'          => (isset($fields['query_var'])) ? $fields['query_var'] : true,
            'show_in_admin_bar'  => (isset($fields['show_in_admin_bar'])) ? $fields['show_in_admin_bar'] : true,
            'capability_type'    => (isset($fields['capability_type'])) ? $fields['capability_type'] : 'post',
            'has_archive'        => (isset($fields['has_archive'])) ? $fields['has_archive'] : true,
            'hierarchical'       => (isset($fields['hierarchical'])) ? $fields['hierarchical'] : true,
            'supports'           => (isset($fields['supports'])) ? $fields['supports'] : array(
                    'title',
                    'editor',
                    'excerpt',
                    'author',
                    'thumbnail',
                    'comments',
                    'trackbacks',
                    'custom-fields',
                    'revisions',
                    'page-attributes',
                    'post-formats',
            ),
            'menu_position'      => (isset($fields['menu_position'])) ? $fields['menu_position'] : 21,
            'menu_icon'          => (isset($fields['menu_icon'])) ? $fields['menu_icon'] : 'dashicons-admin-generic',
            'show_in_nav_menus'  => (isset($fields['show_in_nav_menus'])) ? $fields['show_in_nav_menus'] : true,
        );

        if (isset($fields['rewrite'])) {

            /**
             *  Add $this->plugin_name as translatable in the permalink structure,
             *  to avoid conflicts with other plugins which may use customers as well.
             */
            $args['rewrite'] = $fields['rewrite'];
        }

        if ($fields['custom_caps']) {

            /**
             * Provides more precise control over the capabilities than the defaults.  By default, WordPress
             * will use the 'capability_type' argument to build these capabilities.  More often than not,
             * this results in many extra capabilities that you probably don't need.  The following is how
             * I set up capabilities for many post types, which only uses three basic capabilities you need
             * to assign to roles: 'manage_examples', 'edit_examples', 'create_examples'.  Each post type
             * is unique though, so you'll want to adjust it to fit your needs.
             *
             * @link https://gist.github.com/creativembers/6577149
             * @link http://justintadlock.com/archives/2010/07/10/meta-capabilities-for-custom-post-types
             */
            $args['capabilities'] = array(

                // Meta capabilities
                'edit_post'                 => 'edit_' . strtolower($fields['singular']),
                'read_post'                 => 'read_' . strtolower($fields['singular']),
                'delete_post'               => 'delete_' . strtolower($fields['singular']),

                // Primitive capabilities used outside of map_meta_cap():
                'edit_posts'                => 'edit_' . strtolower($fields['plural']),
                'edit_others_posts'         => 'edit_others_' . strtolower($fields['plural']),
                'publish_posts'             => 'publish_' . strtolower($fields['plural']),
                'read_private_posts'        => 'read_private_' . strtolower($fields['plural']),

                // Primitive capabilities used within map_meta_cap():
                'delete_posts'              => 'delete_' . strtolower($fields['plural']),
                'delete_private_posts'      => 'delete_private_' . strtolower($fields['plural']),
                'delete_published_posts'    => 'delete_published_' . strtolower($fields['plural']),
                'delete_others_posts'       => 'delete_others_' . strtolower($fields['plural']),
                'edit_private_posts'        => 'edit_private_' . strtolower($fields['plural']),
                'edit_published_posts'      => 'edit_published_' . strtolower($fields['plural']),
                'create_posts'              => 'edit_' . strtolower($fields['plural'])

            );

            /**
             * Adding map_meta_cap will map the meta correctly.
             * @link https://wordpress.stackexchange.com/questions/108338/capabilities-and-custom-post-types/108375#108375
             */
            $args['map_meta_cap'] = true;

            /**
             * Assign capabilities to users
             * Without this, users - also admins - can not see post type.
             */
            $this->assign_capabilities($args['capabilities'], $fields['custom_caps_users']);
        }

        register_post_type($fields['slug'], $args);

        /**
         * Register Taxnonmies if any
         * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
         */
        if (isset($fields['taxonomies']) && is_array($fields['taxonomies'])) {

            foreach ($fields['taxonomies'] as $taxonomy) {

                $this->register_single_post_type_taxnonomy($taxonomy);

            }

        }

    }

    private function register_single_post_type_taxnonomy($tax_fields)
    {

        $labels = array(
            'name'                       => $tax_fields['plural'],
            'singular_name'              => $tax_fields['single'],
            'menu_name'                  => $tax_fields['plural'],
            /* translators: %s: Post type name */
            'all_items'                  => sprintf(__('All %s', 'tailorsheet-manager'), $tax_fields['plural']),
            /* translators: %s: Post type name */
            'edit_item'                  => sprintf(__('Edit %s', 'tailorsheet-manager'), $tax_fields['single']),
            /* translators: %s: Post type name */
            'view_item'                  => sprintf(__('View %s', 'tailorsheet-manager'), $tax_fields['single']),
            /* translators: %s: Post type name */
            'update_item'                => sprintf(__('Update %s', 'tailorsheet-manager'), $tax_fields['single']),
            /* translators: %s: Post type name */
            'add_new_item'               => sprintf(__('Add New %s', 'tailorsheet-manager'), $tax_fields['single']),
            /* translators: %s: Post type name */
            'new_item_name'              => sprintf(__('New %s Name', 'tailorsheet-manager'), $tax_fields['single']),
            /* translators: %s: Post type name */
            'parent_item'                => sprintf(__('Parent %s', 'tailorsheet-manager'), $tax_fields['single']),
            /* translators: %s: Post type name */
            'parent_item_colon'          => sprintf(__('Parent %s\:', 'tailorsheet-manager'), $tax_fields['single']),
            /* translators: %s: Post type name */
            'search_items'               => sprintf(__('Search %s', 'tailorsheet-manager'), $tax_fields['plural']),
            /* translators: %s: Post type name */
            'popular_items'              => sprintf(__('Popular %s', 'tailorsheet-manager'), $tax_fields['plural']),
            /* translators: %s: Post type name */
            'separate_items_with_commas' => sprintf(__('Separate %s with commas', 'tailorsheet-manager'), $tax_fields['plural']),
            /* translators: %s: Post type name */
            'add_or_remove_items'        => sprintf(__('Add or remove %s', 'tailorsheet-manager'), $tax_fields['plural']),
            /* translators: %s: Post type name */
            'choose_from_most_used'      => sprintf(__('Choose from the most used %s', 'tailorsheet-manager'), $tax_fields['plural']),
            /* translators: %s: Post type name */
            'not_found'                  => sprintf(__('No %s found', 'tailorsheet-manager'), $tax_fields['plural']),
        );

        $args = array(
            'label'                 => $tax_fields['plural'],
            'labels'                => $labels,
            'hierarchical'          => (isset($tax_fields['hierarchical'])) ? $tax_fields['hierarchical'] : true,
            'public'                => (isset($tax_fields['public'])) ? $tax_fields['public'] : true,
            'show_ui'               => (isset($tax_fields['show_ui'])) ? $tax_fields['show_ui'] : true,
            'show_in_menu'          => (isset($tax_fields['show_in_menu'])) ? $tax_fields['show_in_menu'] : true,
            'show_in_nav_menus'     => (isset($tax_fields['show_in_nav_menus'])) ? $tax_fields['show_in_nav_menus'] : true,
            'show_tagcloud'         => (isset($tax_fields['show_tagcloud'])) ? $tax_fields['show_tagcloud'] : true,
            'meta_box_cb'           => (isset($tax_fields['meta_box_cb'])) ? $tax_fields['meta_box_cb'] : null,
            'show_admin_column'     => (isset($tax_fields['show_admin_column'])) ? $tax_fields['show_admin_column'] : true,
            'show_in_quick_edit'    => (isset($tax_fields['show_in_quick_edit'])) ? $tax_fields['show_in_quick_edit'] : true,
            'update_count_callback' => (isset($tax_fields['update_count_callback'])) ? $tax_fields['update_count_callback'] : '',
            'show_in_rest'          => (isset($tax_fields['show_in_rest'])) ? $tax_fields['show_in_rest'] : true,
            'rest_base'             => $tax_fields['taxonomy'],
            'rest_controller_class' => (isset($tax_fields['rest_controller_class'])) ? $tax_fields['rest_controller_class'] : 'WP_REST_Terms_Controller',
            'query_var'             => $tax_fields['taxonomy'],
            'rewrite'               => (isset($tax_fields['rewrite'])) ? $tax_fields['rewrite'] : true,
            'sort'                  => (isset($tax_fields['sort'])) ? $tax_fields['sort'] : '',
        );

        $args = apply_filters($tax_fields['taxonomy'] . '_args', $args);

        register_taxonomy($tax_fields['taxonomy'], $tax_fields['post_types'], $args);

    }

    /**
     * Assign capabilities to users
     *
     * @link https://codex.wordpress.org/Function_Reference/register_post_type
     * @link https://typerocket.com/ultimate-guide-to-custom-post-types-in-wordpress/
     */
    public function assign_capabilities($caps_map, $users)
    {

        foreach ($users as $user) {

            $user_role = get_role($user);

            foreach ($caps_map as $cap_map_key => $capability) {

                $user_role->add_cap($capability);

            }

        }

    }

    /**
     * CUSTOMIZE CUSTOM POST TYPE AS YOU WISH.
     */

    /**
     * Create post types
     */
    public function create_custom_post_type()
    {
        $ts_manager_admin = get_option('tailorsheet-manager-admin');
        $expr_app_archive = false;
        $ejmp_app_archive = false;

        if($ts_manager_admin) {
            $admin_options = $ts_manager_admin['es'];
            
            if (isset($admin_options['expresiones-appsheet-archive']) && $admin_options['expresiones-appsheet-archive'] != "") {
                $expr_app_archive = $admin_options['expresiones-appsheet-archive'];
            }
            
            if (isset($admin_options['ejemplos-appsheet-archive']) && $admin_options['ejemplos-appsheet-archive'] != "") {
                $ejmp_app_archive = $admin_options['ejemplos-appsheet-archive'];
            }
        }
        /**
         * This is not all the fields, only what I find important. Feel free to change this function ;)
         *
         * @link https://codex.wordpress.org/Function_Reference/register_post_type
         *
         * For more info on fields:
         * @link https://github.com/JoeSz/WordPress-Plugin-Boilerplate-Tutorial/blob/9fb56794bc1f8aebfe04e99b15881db0c4bc61bd/plugin-name/includes/class-plugin-name-post_types.php#L230
         */
        $post_types_fields = array(

            // Appsheet Functions post type
            array(
                // Slug max. 20 characters, cannot contain capital letters or spaces!
                // https://toolset.com/forums/topic/types-custom-post-type-slug-length-limited-to-20-characters/
                'slug'                  => 'expresiones-appsheet',
                'singular'              => __('Appsheet Function', 'tailorsheet-manager'),
                'plural'                => __('Appsheet Functions', 'tailorsheet-manager'),
                'menu_name'             => __('Appsheet Functions', 'tailorsheet-manager'),
                'show_in_menu'          => 'admin.php?page=tailorsheet-manager-admin',
                'has_archive'           => $expr_app_archive,
                'hierarchical'          => false,
                'rewrite' => array(
                    'slug'                  => 'expresiones-appsheet',
                    'with_front'            => true,
                    'pages'                 => true,
                    'feeds'                 => true,
                    'ep_mask'               => EP_PERMALINK,
                ),
                'public'                => true,
                'publicly_queryable'    => true,
                'exclude_from_search'   => false,
                'show_ui'               => true,
                'query_var'             => true,
                'supports'              => array(
                    'title',
                    'editor',
                    'thumbnail',
                    'revisions',
                ),
                'custom_caps'           => true,
                'custom_caps_users'     => array(
                    'administrator',
                ),
                'taxonomies'            => array(
                    array(
                        'taxonomy'          => 'categoria-de-expresion',
                        'plural'            => __('Function Categories', 'tailorsheet-manager'),
                        'single'            => __('Function Category', 'tailorsheet-manager'),
                        'post_types'        => 'expresiones-appsheet',
                    ),
                    array(
                        'taxonomy'          => 'ejemplo-de-expresion',
                        'plural'            => __('Function Examples', 'tailorsheet-manager'),
                        'single'            => __('Function Example', 'tailorsheet-manager'),
                        'post_types'        => 'expresiones-appsheet',
                        'public'            => false
                    )
                ),
            ),

            // Appsheet Examples post type
            array(
                // Slug max. 20 characters, cannot contain capital letters or spaces!
                // https://toolset.com/forums/topic/types-custom-post-type-slug-length-limited-to-20-characters/
                'slug'                  => 'ejemplos-appsheet',
                'singular'              => __('AppSheet Example', 'tailorsheet-manager'),
                'plural'                => __('AppSheet Examples', 'tailorsheet-manager'),
                'menu_name'             => __('Appsheet Examples', 'tailorsheet-manager'),
                'show_in_menu'          => 'admin.php?page=tailorsheet-manager-admin',
                'description'           => __('AppSheet Examples', 'tailorsheet-manager'),
                'has_archive'           => $ejmp_app_archive,
                'hierarchical'          => false,
                'rewrite' => array(
                    'slug'                  => 'ejemplos-appsheet',
                    'with_front'            => true,
                    'pages'                 => true,
                    'feeds'                 => true,
                    'ep_mask'               => EP_PERMALINK,
                ),
                'public'                => true,
                'publicly_queryable'    => true,
                'exclude_from_search'   => false,
                'show_ui'               => true,
                'query_var'             => true,
                'supports'              => array(
                    'title',
                    'editor',
                    'excerpt',
                    'thumbnail',
                    'revisions',
                ),
                'custom_caps'           => true,
                'custom_caps_users'     => array(
                    'administrator',
                ),
                'taxonomies'            => array(
                    // array(
                    //     'taxonomy'          => 'categoria-de-ejemplo',
                    //     'plural'            => __('Example Categories', 'tailorsheet-manager'),
                    //     'single'            => __('Example Category', 'tailorsheet-manager'),
                    //     'post_types'        => 'ejemplos-appsheet',
                    //     'public'            => false,
                    //     'show_in_rest'      => true
                    // ),
                    array(
                        'taxonomy'          => 'sector-de-ejemplo',
                        'plural'            => __('Example Sectors', 'tailorsheet-manager'),
                        'single'            => __('Example Sector', 'tailorsheet-manager'),
                        'post_types'        => 'ejemplos-appsheet',
                        'public'            => false,
                        'show_in_rest'      => true
                    ),
                    array(
                        'taxonomy'          => 'func-de-ejemplo',
                        'plural'            => __('Example Functionalities', 'tailorsheet-manager'),
                        'single'            => __('Example Functionality', 'tailorsheet-manager'),
                        'post_types'        => 'ejemplos-appsheet',
                        'public'            => false,
                        'show_in_rest'      => true
                    ),
                    array(
                        'taxonomy'          => 'integracion-de-ejemplo',
                        'plural'            => __('Example Integrations', 'tailorsheet-manager'),
                        'single'            => __('Example Integration', 'tailorsheet-manager'),
                        'post_types'        => 'ejemplos-appsheet',
                        'public'            => false,
                        'show_in_rest'      => true
                    ),
                    // array(
                    //     'taxonomy'          => 'etiqueta-de-ejemplo',
                    //     'plural'            => __('Example Tags', 'tailorsheet-manager'),
                    //     'single'            => __('Example Tag', 'tailorsheet-manager'),
                    //     'post_types'        => 'ejemplos-appsheet',
                    //     'public'            => false,
                    //     'show_in_rest'      => true
                    // )
                ),
            ),
        );

        foreach ($post_types_fields as $fields) {

            $this->register_single_post_type($fields);

        }
    }
}
