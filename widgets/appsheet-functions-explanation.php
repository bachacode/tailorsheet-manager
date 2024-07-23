<?php

class Elementor_Appsheet_Functions_Explanation extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'appsheet_functions_explanation';
    }

    public function get_title()
    {
        return esc_html__('Appsheet Functions Explanation', 'appsheet-functions');
    }

    public function get_icon()
    {
        return 'eicon-text';
    }

    public function get_categories()
    {
        return [ 'appsheet-functions' ];
    }

    public function get_keywords()
    {
        return [ 'appsheet', 'functions', 'explanation' ];
    }

    protected function render()
    {
        if ( !function_exists( 'af_show_template' ) ) {
            return;
        }

        $queried_object = get_queried_object();
        if ($queried_object) {
            $post_id = $queried_object->ID;
            $explanation = get_post_meta($post_id,'explanation', true);
            if ($explanation && !is_wp_error($explanation)) {
                af_show_template( 'af-explanation', [ 'explanation' => $explanation ] );
           } else { 
                af_show_template( 'af-explanation-error' );
           }
        }
    }

}

?>