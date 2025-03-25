<?php

namespace TailorSheet_Manager\Widgets;

use TailorSheet_Manager\Helpers;

class AppSheet_Functions_Examples extends TSM_Widget_Base
{
    public function get_name()
    {
        return 'tsm_appsheet_functions_examples';
    }

    public function get_title()
    {
        return esc_html__('Appsheet Functions Examples', 'tailorsheet-manager');
    }

    public function get_icon()
    {
        return 'eicon-bullet-list';
    }

    public function get_keywords()
    {
        return [ 'tailorsheet', 'appsheet', 'functions', 'examples' ];
    }

    protected function render()
    {   
        $queried_object = get_queried_object();
        if ( $queried_object ) {
            $post_id = $queried_object->ID;
            $terms = get_the_terms($post_id, 'ejemplo-de-expresion');
            if ($terms && !is_wp_error($terms)) {
                Helpers::render_template( 'af-examples-list', [ 'terms' => $terms ] );
             } else { 
                Helpers::render_template( 'af-examples-error');
             }
        }
    }

}

