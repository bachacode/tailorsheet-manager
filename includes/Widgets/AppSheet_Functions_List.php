<?php

namespace TailorSheet_Manager\Widgets;

class AppSheet_Functions_List extends TSM_Widget_Base
{
    public function get_name()
    {
        return 'tsm_appsheet_functions_list';
    }

    public function get_title()
    {
        return esc_html__('Appsheet Functions List', 'tailorsheet-manager');
    }

    public function get_icon()
    {
        return 'eicon-editor-code';
    }

    public function get_keywords()
    {
        return [ 'tailorsheet', 'appsheet', 'functions', 'list' ];
    }

    protected function render()
    {
        if ( !function_exists( 'af_show_template' ) ) {
            return;
        }

        $categories = get_terms(array (
            'taxonomy'      => 'categoria-de-expresion',
            'hide_empty'    => false
        ));
        $posts = array();
		// Eg.: custom Loop for Custom Post Type
		$args = array(
			'post_type' => 'expresiones-appsheet',
			'posts_per_page' => '-1', // for all of them
			'post_status' => 'publish'
		);
	
		$loop = new \WP_Query( $args );
	
		while( $loop->have_posts() ): $loop->the_post();
            $post_data = array (
                'post_id'		=> get_the_ID(),
                'post_title' 	=> get_the_title(),
                'post_url' 		=> get_the_permalink(),
                'post_categories' => get_the_terms(get_the_ID(), 'categoria-de-expresion')
            );
			array_push($posts, $post_data);
		endwhile;

		$template = af_load_template('af-appsheet-functions-list', array ( 'posts' => $posts ));
        
		wp_reset_query();

		af_show_template( 'af-appsheet-functions-main', array ( 'posts' => $template, 'categories' => $categories ) );

    }

}

?>