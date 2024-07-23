<?php

class Elementor_Appsheet_Functions_Searchbar extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'appsheet_functions_searchbar';
    }

    public function get_title()
    {
        return esc_html__('Appsheet Functions Searchbar', 'appsheet-functions');
    }

    public function get_icon()
    {
        return 'eicon-search';
    }

    public function get_categories()
    {
        return [ 'appsheet-functions' ];
    }

    public function get_keywords()
    {
        return [ 'appsheet', 'functions', 'searchbar' ];
    }

    protected function render()
    {
        if ( !function_exists( 'af_show_template' ) ) {
            return;
        }

		af_show_template( 'af-searchbar' );

    }

}

?>