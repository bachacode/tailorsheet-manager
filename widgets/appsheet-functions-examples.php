<?php

class Elementor_Appsheet_Functions_Examples extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'appsheet_functions_examples';
    }

    public function get_title()
    {
        return esc_html__('Appsheet Functions Examples', 'appsheet-functions');
    }

    public function get_icon()
    {
        return 'eicon-bullet-list';
    }

    public function get_categories()
    {
        return [ 'basic' ];
    }

    public function get_keywords()
    {
        return [ 'appsheet', 'functions', 'examples' ];
    }

    protected function render()
    {
        $queried_object = get_queried_object();
        if ( $queried_object ) {
            $post_id = $queried_object->ID;
            $terms = get_the_terms($post_id, 'ejemplo-de-expresion');
            if ($terms && !is_wp_error($terms)) {
                ?>
                <div class="fe-wrapper">
                    <div class="fe-table-wrapper">
                        <table class="fe-table">
                            <thead>
                                <tr class="fe-headers">
                                    <th class="fe-header">Sintaxis</th>
                                    <th class="fe-header">Resultado</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($terms as $term): ?>
                                <tr class="fe-row">
                                    <td class="fe-data"><pre class="fe-pre"><code><?= get_term_meta($term->term_id, 'fe_syntax', true);?> </code></pre></td>
                                    <td class="fe-data"><pre class="fe-pre"><code><?= get_term_meta($term->term_id, 'fe_expected', true); ?></code></pre></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php } else { ?>
                <p> <?= __('This function does not have examples!', 'appsheet-functions'); ?> </p>
            <?php }
        }
    }

}

