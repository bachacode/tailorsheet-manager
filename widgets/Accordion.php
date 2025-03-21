<?php

namespace TailorSheet_Manager\Widgets;

class Accordion extends TSM_Widget_Base
{
    protected static bool $isPublished = true;
    
    public function get_name() {
        return 'tsm_accordion';
    }

    public function get_title() {
        return esc_html__( 'TSM Accordion', 'tailorsheet-manager' );
    }

    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_keywords() {
        return [ 
            'tailorsheet',
            'faq', 
            'question', 
            'answer', 
            'frequently asked questions', 
            'accordion' 
        ];
    }

    protected function _register_controls() {
        // Register the Basic section
        $this->register_basic_controls();

        // Register the Elements repeater (shown when "Elements" is selected)
        $this->register_elements_controls();

        // Register the Current Post meta controls (shown when "Current Post" is selected)
        $this->register_current_post_controls();

        // Register the elements icon
        $this->register_icons_controls();

        // Style controls
        $this->register_style_controls();
    }

    /**
     * Register Basic controls.
     */
    protected function register_basic_controls() {
        $this->start_controls_section(
            'basic_section',
            [
                'label' => esc_html__( 'Basic', 'tailorsheet-manager' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'faq_first_opened',
            [
                'label'   => esc_html__( 'First Opened', 'tailorsheet-manager' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'tailorsheet-manager' ),
                    'no' => esc_html__( 'No', 'tailorsheet-manager' ),
                ],
            ]
        );

        $this->add_control(
            'faq_source',
            [
                'label'   => esc_html__( 'Source', 'tailorsheet-manager' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'elements',
                'options' => [
                    'elements' => esc_html__( 'Elements', 'tailorsheet-manager' ),
                    'current_post' => esc_html__( 'Current Post', 'tailorsheet-manager' ),
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Register Elements controls (the repeater for FAQ items).
     * This section will only be visible if the Source is set to "Elements".
     */
    protected function register_elements_controls() {
        $this->start_controls_section(
            'elements_section',
            [
                'label'     => esc_html__( 'Elements', 'tailorsheet-manager' ),
                'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'faq_source' => 'elements',
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'faq_heading',
            [
                'label'       => esc_html__( 'Heading', 'tailorsheet-manager' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Demo title',
                'label_block' => true,
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'faq_content',
            [
                'label'      => esc_html__( 'Content', 'tailorsheet-manager' ),
                'type'       => \Elementor\Controls_Manager::WYSIWYG,
                'default'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin nec mi quam. Cras at lorem sit amet leo finibus lacinia.',
                'show_label' => true,
            ]
        );

        $this->add_control(
            'faq_items',
            [
                'label'       => esc_html__( 'FAQ Items', 'tailorsheet-manager' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'faq_heading' => 'Demo title',
                        'faq_content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin nec mi quam. Cras at lorem sit amet leo finibus lacinia.',
                    ],
                ],
                'title_field' => '{{{ faq_heading }}}',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Register controls for the "Current Post" source.
     * Visible only if the Source is set to "Current Post".
     */
    protected function register_current_post_controls() {
        $this->start_controls_section(
            'current_post_section',
            [
                'label'     => esc_html__( 'Current Post Settings', 'tailorsheet-manager' ),
                'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'faq_source' => 'current_post',
                ],
            ]
        );

        $this->add_control(
            'faq_meta_field',
            [
                'label'       => esc_html__( 'Meta Field', 'tailorsheet-manager' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '',
                'label_block' => true,
                'description' => esc_html__( 'This field must be an array', 'tailorsheet-manager' ),
            ]
        );

        $this->add_control(
            'faq_heading_key',
            [
                'label'       => esc_html__( 'Heading Key', 'tailorsheet-manager' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '',
                'label_block' => true,
                'description' => esc_html__( 'Key for the FAQ heading in the meta array', 'tailorsheet-manager' ),
            ]
        );

        $this->add_control(
            'faq_content_key',
            [
                'label'       => esc_html__( 'Content Key', 'tailorsheet-manager' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '',
                'label_block' => true,
                'description' => esc_html__( 'Key for the FAQ content in the meta array', 'tailorsheet-manager' ),
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Register Icons control.
     */
    protected function register_icons_controls() {
        $this->start_controls_section(
            'icons_section',
            [
                'label' => esc_html__( 'Icons', 'tailorsheet-manager' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon_inactive',
            [
                'label'   => esc_html__('Inactive Icon', 'your-text-domain'),
                'type'    => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-plus',
                    'library' => 'fa-solid',
                ],
            ]
        );
    
        $this->add_control(
            'icon_active',
            [
                'label'   => esc_html__('Active Icon', 'your-text-domain'),
                'type'    => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-minus',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /*
    Register Style controls for the widget.
    */
    protected function register_style_controls() {
        // Item Style
        $this->start_controls_section(
            'section_item_style',
            [
                'label' => esc_html__( 'Item', 'tailorsheet-manager' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'item_background',
            [
                'label'     => esc_html__( 'Background Color', 'tailorsheet-manager' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .tm-accordion-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_background_active',
            [
                'label'     => esc_html__( 'Background Color Active', 'tailorsheet-manager' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-accordion-item.active' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'item_border',
                'label'    => esc_html__( 'Border', 'tailorsheet-manager' ),
                'selector' => '{{WRAPPER}} .tm-accordion-item',
            ]
        );

        $this->add_control(
            'item_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'tailorsheet-manager' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tm-accordion-item' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .tm-accordion-item',
            ]
        );

        $this->end_controls_section();

        // Heading Style
        $this->start_controls_section(
            'section_heading_style',
            [
                'label' => esc_html__( 'Heading', 'tailorsheet-manager' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_background',
            [
                'label'     => esc_html__( 'Background Color', 'tailorsheet-manager' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-accordion-heading-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'heading_background_active',
            [
                'label'     => esc_html__( 'Background Color Active', 'tailorsheet-manager' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-accordion-item.active .tm-accordion-heading-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'heading_border',
                'label'    => esc_html__( 'Border', 'tailorsheet-manager' ),
                'selector' => '{{WRAPPER}} .tm-accordion-heading-wrapper',
            ]
        );

        $this->add_control(
            'heading_padding',
            [
                'label'      => esc_html__( 'Padding', 'tailorsheet-manager' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tm-accordion-heading-wrapper h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_margin',
            [
                'label'      => esc_html__( 'Margin', 'tailorsheet-manager' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tm-accordion-heading-wrapper h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'heading_typography',
                'label'    => esc_html__( 'Typography', 'tailorsheet-manager' ),
                'selector' => '{{WRAPPER}} .tm-accordion-heading-wrapper h3',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label'     => esc_html__( 'Heading Color', 'tailorsheet-manager' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-accordion-heading-wrapper h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'heading_color_active',
            [
                'label'     => esc_html__( 'Heading Color (Active)', 'tailorsheet-manager' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-accordion-item.active .tm-accordion-heading-wrapper h3' => 'color: {{VALUE}};',
                ],
            ]
        );



        $this->end_controls_section();

        // Content Style
        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__( 'Content', 'tailorsheet-manager' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_background',
            [
                'label'     => esc_html__( 'Background Color', 'tailorsheet-manager' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-accordion-content-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'content_border',
                'label'    => esc_html__( 'Border', 'tailorsheet-manager' ),
                'selector' => '{{WRAPPER}} .tm-accordion-content-wrapper',
            ]
        );

        $this->add_control(
            'content_padding',
            [
                'label'      => esc_html__( 'Padding', 'tailorsheet-manager' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tm-accordion-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'label'    => esc_html__( 'Typography', 'tailorsheet-manager' ),
                'selector' => '{{WRAPPER}} .tm-accordion-content-wrapper span',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => esc_html__( 'Content Color', 'tailorsheet-manager' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-accordion-content-wrapper span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_color_active',
            [
                'label'     => esc_html__( 'Content Color (Active)', 'tailorsheet-manager' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-accordion-item.active .tm-accordion-content-wrapper span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Icon styles
        $this->start_controls_section(
            'icon_style_section',
            [
                'label' => esc_html__( 'Icon', 'tailorsheet-manager' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color_inactive',
            [
                'label'     => esc_html__( 'Icon Color (Inactive)', 'tailorsheet-manager' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-accordion-icon i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color_active',
            [
                'label'     => esc_html__( 'Icon Color (Active)', 'tailorsheet-manager' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-accordion-item.active .tm-accordion-icon i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label'      => esc_html__( 'Icon Size', 'tailorsheet-manager' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'selectors'  => [
                    '{{WRAPPER}} .tm-accordion-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_padding',
            [
                'label'      => esc_html__( 'Icon Padding', 'tailorsheet-manager' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors'  => [
                    '{{WRAPPER}} .tm-accordion-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $faq_icons = array (
            'icon_active' => $settings['icon_active'],
            'icon_inactive' => $settings['icon_inactive']
        );
        $faq_first_opened = $settings['faq_first_opened'];
        $faq_items = array ( );

        if ( ! function_exists( 'af_show_template' ) ) {
            return;
        }

        if ( 'elements' === $settings['faq_source'] ) {
            if ( empty( $settings['faq_items'] ) ) {
                return;
            }
            $faq_items = $settings['faq_items'];
        } elseif ( 'current_post' === $settings['faq_source'] ) {
            // Render FAQ items based on current post meta.
            $meta_field   = $settings['faq_meta_field'];
            $heading_key  = $settings['faq_heading_key'];
            $content_key  = $settings['faq_content_key'];
            if ( empty( $meta_field ) ) {
                return;
            }
            // Using get_the_ID() in production; here using a fixed ID for demonstration.
            $faq_data = get_post_meta( get_the_ID(), $meta_field, true );
            $faq_data = maybe_unserialize( $faq_data );
            if ( empty( $faq_data ) || !is_array( $faq_data ) ) {
                return;
            }
               
            foreach ( $faq_data as $value ) {
                $faq_items[] = [
                    'faq_heading' => isset( $value[ $heading_key ] ) ? $value[ $heading_key ] : '',
                        'faq_content' => isset( $value[ $content_key ] ) ? $value[ $content_key ] : '',
                ];
            }            
        }

        af_show_template( 'af-faq', [ 'faq_items' => $faq_items, 'faq_icons' => $faq_icons, 'faq_first_opened' => $faq_first_opened ] );
    }
}

?>