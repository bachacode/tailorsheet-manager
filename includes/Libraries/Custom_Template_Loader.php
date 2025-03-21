<?php

namespace TailorSheet_Manager\Libraries;

/**
 * Template loader for PW Sample Plugin.
 *
 * Only need to specify class properties here.
 *
 */
class Custom_Template_Loader extends Gamajo_Template_Loader
{
    /**
     * Prefix for filter names.
     *
     * @since 1.0.0
     * @type string
     */
    protected $filter_prefix = 'af';

    /**
     * Directory name where custom templates for this plugin should be found in the theme.
     *
     * @since 1.0.0
     * @type string
     */
    protected $theme_template_directory = 'af_templates';

    protected $plugin_template_directory = 'af_templates';

    /**
     * Reference to the root directory path of this plugin.
     *
     * @since 1.0.0
     * @type string
     */
    protected $plugin_directory = TAILORSHEET_MANAGER_BASE_DIR;

}
