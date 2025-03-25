<?php

namespace TailorSheet_Manager\Widgets;

class TSM_Widget_Base extends \Elementor\Widget_Base 
{
    public function get_name()
    {
        return 'tsm_widget_base';
    }

    public function get_categories()
    {
        return [ 'tailorsheet-manager' ];
    }

    public function get_keywords()
    {
        return [ 'tailorsheet' ];
    }
}

?>