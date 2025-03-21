<?php

use TailorSheet_Manager\Libraries\Custom_Template_Loader;

function af_load_template($template_name, $data = array ())
{
    $templates = new Custom_Template_Loader;
    // Turn on output buffering, because it is a shortcode, content file should not echo anything out.
    // In other cases, output buffering may not required.
    ob_start();
    // Load template from PLUGIN_NAME_BASE_DIR/templates/content-header.php
    $templates->set_template_data($data)->get_template_part( $template_name );
    // Return content ftom the file
    return ob_get_clean();
}

function af_show_template($template_name, $data = array())
{
    echo af_load_template($template_name, $data);
}

function admin_assets($dir) 
{
    return TAILORSHEET_MANAGER_BASE_DIR . 'assets/admin/' . $dir;
}