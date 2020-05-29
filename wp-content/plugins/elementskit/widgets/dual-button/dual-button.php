<?php
namespace Elementor;

use \ElementsKit\Elementskit_Widget_Dual_Button_Handler as Handler;
use \ElementsKit\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;


class Elementskit_Widget_Dual_Button extends Widget_Base {

	public $base;

    public function get_name() {
        return Handler::get_name();
    }

    public function get_title() {
        return Handler::get_title();
    }

    public function get_icon() {
        return Handler::get_icon();
    }

    public function get_categories() {
        return Handler::get_categories();
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'dualbutton_content',
            [
                'label' => __( 'Double Button', 'elementskit' ),
            ]
        );

            $this->add_control(
                'ekit_show_button_middle_text',
                [
                    'label' => __( 'Middle Text', 'elementskit' ),
                    'type'  => Controls_Manager::SWITCHER,
                ]
            );

            $this->add_control(
                'ekit_button_middle_text',
                [
                    'label' => __( 'Text', 'elementskit' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Or', 'elementskit' ),
                    'condition'   => [
                        'ekit_show_button_middle_text' => 'yes',
                    ],
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $this->add_responsive_control(
                'ekit_double_button_align',
                [
                    'label' => __( 'Alignment', 'elementskit' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => __( 'Left', 'elementskit' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'elementskit' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'end' => [
                            'title' => __( 'Right', 'elementskit' ),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'prefix_class' => 'elementor-widget-elementskit-dual-button%s-',
                ]
            );

            $this->add_responsive_control(
                'ekit_dual_button_width',
                [
                    'label' => __( 'Button Width', 'elementskit' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        '%' => [
                            'max' => 100,
                            'min' => 20,
                        ],
                        'px' => [
                            'max' => 1200,
                            'min' => 300,
                        ],
                    ],
                    'size_units' => ['%', 'px'],
                    'default' => [
                        'size' => 40,
                        'unit' => '%',
                    ],
                    'tablet_default' => [
                        'size' => 80,
                        'unit' => '%',
                    ],
                    'mobile_default' => [
                        'size' => 100,
                        'unit' => '%',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ekit_double_button'  => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'ekit_dual_button_gap',
                [
                    'label'   => __( 'Button Gap', 'elementskit' ),
                    'type'    => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 5,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .ekit-double-btn:not(:last-child)' => 'margin-right: {{SIZE}}px;',
                    ],
                    'condition' => [
                        'ekit_show_button_middle_text!' => 'yes',
                    ],
                ]
            );

        $this->end_controls_section();

        // Button One
        $this->start_controls_section(
            'ekit_button_one_content',
            [
                'label' => __( 'Button One', 'elementskit' ),
            ]
        );
            $this->add_control(
                'ekit_button_one_text',
                [
                    'label' => __( 'Text', 'elementskit' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Button', 'elementskit' ),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $this->add_control(
                'ekit_button_one_link',
                [
                    'label' => __( 'Link', 'elementskit' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => __( 'https://your-link.com', 'elementskit' ),
                    'show_external' => true,
                    'default' => [
                        'url' => '#',
                        'is_external' => false,
                        'nofollow' => false,
                    ],
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $this->add_control(
                'ekit_button_one_icon',
                [
                    'label' => __( 'Icon', 'elementskit' ),
                    'type' => Controls_Manager::ICON,
                ]
            );

            $this->add_control(
                'ekit_double_button_one_icon_position',
                [
                    'label' => __( 'Border Style', 'elementskit' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'before',
                    'options' => [
                        'before'  => __( 'Before', 'elementskit' ),
                        'after' => __( 'after', 'elementskit' ),
                    ],
                    'condition' => [
                        'ekit_button_one_icon!' => '',
                    ]
                ]
            );

            $this->add_responsive_control(
                'ekit_double_button_one_icon_before_specing',
                [
                    'label' => __( 'Icon Spacing', 'elementskit' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 150,
                        ],
                    ],
                    'default' => [
                        'size' => 8,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-one > i'  => 'padding-right: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'ekit_button_one_icon!' => '',
                        'ekit_double_button_one_icon_position' => 'before',
                    ]
                ]
            );

            $this->add_responsive_control(
                'ekit_double_button_one_icon_after_specing',
                [
                    'label' => __( 'Icon Spacing', 'elementskit' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 150,
                        ],
                    ],
                    'default' => [
                        'size' => 8,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-one > i'  => 'padding-left: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'ekit_button_one_icon!' => '',
                        'ekit_double_button_one_icon_position' => 'after',
                    ]
                ]
            );

        $this->end_controls_section(); // Button One End

        // Button Two
        $this->start_controls_section(
            'ekit_button_two_content',
            [
                'label' => __( 'Button Two', 'elementskit' ),
            ]
        );
            $this->add_control(
                'ekit_button_two_text',
                [
                    'label' => __( 'Text', 'elementskit' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Button', 'elementskit' ),
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $this->add_control(
                'ekit_button_two_link',
                [
                    'label' => __( 'Link', 'elementskit' ),
                    'type' => Controls_Manager::URL,
                    'placeholder' => __( 'https://your-link.com', 'elementskit' ),
                    'show_external' => true,
                    'default' => [
                        'url' => '#',
                        'is_external' => false,
                        'nofollow' => false,
                    ],
                    'dynamic' => [
                        'active' => true,
                    ],
                ]
            );

            $this->add_control(
                'ekit_button_two_icon',
                [
                    'label' => __( 'Icon', 'elementskit' ),
                    'type' => Controls_Manager::ICON,
                ]
            );

            $this->add_control(
                'ekit_double_button_two_icon_position',
                [
                    'label' => __( 'Border Style', 'elementskit' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'before',
                    'options' => [
                        'before'  => __( 'Before', 'elementskit' ),
                        'after' => __( 'after', 'elementskit' ),
                    ],
                    'condition' => [
                        'ekit_button_two_icon!' => '',
                    ]
                ]
            );

            $this->add_responsive_control(
                'ekit_double_button_two_icon_before_specing',
                [
                    'label' => __( 'Icon Spacing', 'elementskit' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 150,
                        ],
                    ],
                    'default' => [
                        'size' => 8,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-two > i'  => 'padding-right: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'ekit_button_two_icon!' => '',
                        'ekit_double_button_two_icon_position' => 'before',
                    ]
                ]
            );

            $this->add_responsive_control(
                'ekit_double_button_two_icon_after_specing',
                [
                    'label' => __( 'Icon Spacing', 'elementskit' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 150,
                        ],
                    ],
                    'default' => [
                        'size' => 8,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-two > i'  => 'padding-left: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'ekit_button_two_icon!' => '',
                        'ekit_double_button_two_icon_position' => 'after',
                    ]
                ]
            );

        $this->end_controls_section(); // Button Two End


        // Button One Style tab Start
        $this->start_controls_section(
            'ekit_double_button_one_style_section',
            [
                'label' => __( 'Button One', 'elementskit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs('ekit_double_button_one_style_tabs');

                // Button Default Normal style start
                $this->start_controls_tab(
                    'ekit_double_button_one_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'elementskit' ),
                    ]
                );

                    $this->add_responsive_control(
                        'ekit_double_button_one_color',
                        [
                            'label'     => __( 'Color', 'elementskit' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   =>'#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-one' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'ekit_double_button_one_typography',
                            'label' => __( 'Typography', 'elementskit' ),
                            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                            'selector' => '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-one',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'ekit_double_button_one_border',
                            'label' => __( 'Border', 'elementskit' ),
                            'selector' => '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-one',
                        ]
                    );

                    $this->add_responsive_control(
                        'ekit_double_button_one_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'elementskit' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-one' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'ekit_double_button_one_background',
                            'label' => __( 'Background', 'elementskit' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-one',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'ekit_double_button_one_box_shadow',
                            'label' => __( 'Box Shadow', 'elementskit' ),
                            'selector' => '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-one',
                        ]
                    );

                    $this->add_responsive_control(
                        'ekit_double_button_one_padding',
                        [
                            'label' => __( 'Padding', 'elementskit' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-one' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'ekit_double_button_one_margin',
                        [
                            'label' => __( 'Margin', 'elementskit' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-one' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'ekit_double_button_one_align',
                        [
                            'label' => __( 'Alignment', 'elementskit' ),
                            'type' => Controls_Manager::CHOOSE,
                            'options' => [
                                'start' => [
                                    'title' => __( 'Left', 'elementskit' ),
                                    'icon' => 'fa fa-align-left',
                                ],
                                'center' => [
                                    'title' => __( 'Center', 'elementskit' ),
                                    'icon' => 'fa fa-align-center',
                                ],
                                'end' => [
                                    'title' => __( 'Right', 'elementskit' ),
                                    'icon' => 'fa fa-align-right',
                                ],
                                'justify' => [
                                    'title' => __( 'Justified', 'elementskit' ),
                                    'icon' => 'fa fa-align-justify',
                                ],
                            ],
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-one' => 'text-align: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Button One Normal style End

                // Button One Hover style start
                $this->start_controls_tab(
                    'ekit_double_button_one_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'elementskit' ),
                    ]
                );

                    $this->add_control(
                        'ekit_double_button_one_hover_color',
                        [
                            'label'     => __( 'Color', 'elementskit' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   =>'#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-one:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'ekit_double_button_one_hover_border',
                            'label' => __( 'Border', 'elementskit' ),
                            'selector' => '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-one:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'ekit_double_button_one_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'elementskit' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-one:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'ekit_double_button_one_hover_background',
                            'label' => __( 'Background', 'elementskit' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-one:before',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'ekit_double_button_one_hover_box_shadow',
                            'label' => __( 'Box Shadow', 'elementskit' ),
                            'selector' => '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-one:hover',
                        ]
                    );

                $this->end_controls_tab(); // Button one Hover style End

            $this->end_controls_tabs();

        $this->end_controls_section(); // Button One Style tab end

        // Button two Style tab Start
        $this->start_controls_section(
            'ekit_double_button_two_style_section',
            [
                'label' => __( 'Button Two', 'elementskit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs('ekit_double_button_two_style_tabs');

                // Button Two Normal style start
                $this->start_controls_tab(
                    'ekit_double_button_two_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'elementskit' ),
                    ]
                );

                    $this->add_responsive_control(
                        'ekit_double_button_two_color',
                        [
                            'label'     => __( 'Color', 'elementskit' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   =>'#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-two' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'ekit_double_button_two_typography',
                            'label' => __( 'Typography', 'elementskit' ),
                            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                            'selector' => '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-two',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'ekit_double_button_two_border',
                            'label' => __( 'Border', 'elementskit' ),
                            'selector' => '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-two',
                        ]
                    );

                    $this->add_responsive_control(
                        'ekit_double_button_two_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'elementskit' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-two' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'ekit_double_button_two_background',
                            'label' => __( 'Background', 'elementskit' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-two',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'ekit_double_button_two_box_shadow',
                            'label' => __( 'Box Shadow', 'elementskit' ),
                            'selector' => '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-two',
                        ]
                    );

                    $this->add_responsive_control(
                        'ekit_double_button_two_padding',
                        [
                            'label' => __( 'Padding', 'elementskit' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'ekit_double_button_two_margin',
                        [
                            'label' => __( 'Margin', 'elementskit' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-two' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'ekit_double_button_two_align',
                        [
                            'label' => __( 'Alignment', 'elementskit' ),
                            'type' => Controls_Manager::CHOOSE,
                            'options' => [
                                'start' => [
                                    'title' => __( 'Left', 'elementskit' ),
                                    'icon' => 'fa fa-align-left',
                                ],
                                'center' => [
                                    'title' => __( 'Center', 'elementskit' ),
                                    'icon' => 'fa fa-align-center',
                                ],
                                'end' => [
                                    'title' => __( 'Right', 'elementskit' ),
                                    'icon' => 'fa fa-align-right',
                                ],
                                'justify' => [
                                    'title' => __( 'Justified', 'elementskit' ),
                                    'icon' => 'fa fa-align-justify',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-two' => 'text-align: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Button two Normal style End

                // Button Two Hover style start
                $this->start_controls_tab(
                    'ekit_double_button_two_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'elementskit' ),
                    ]
                );
                    $this->add_responsive_control(
                        'ekit_double_button_two_hover_color',
                        [
                            'label'     => __( 'Color', 'elementskit' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   =>'#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-two:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'ekit_double_button_two_hover_border',
                            'label' => __( 'Border', 'elementskit' ),
                            'selector' => '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-two:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'ekit_double_button_two_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'elementskit' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-two:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'ekit_double_button_two_hover_background',
                            'label' => __( 'Background', 'elementskit' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-two:before',
                            'separator' => 'before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'ekit_double_button_two_hover_box_shadow',
                            'label' => __( 'Box Shadow', 'elementskit' ),
                            'selector' => '{{WRAPPER}} .ekit-double-btn.ekit-double-btn-two:hover',
                        ]
                    );

                $this->end_controls_tab(); // Button two Hover style End

            $this->end_controls_tabs();

        $this->end_controls_section(); // Button two Style tab end

        // Button Middle Text style start
        $this->start_controls_section(
            'ekit_double_button_middletext_style_section',
            [
                'label' => __( 'Middle Text', 'elementskit' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_button_middle_text'=>'yes',
                    'button_middle_text!'=>'',
                ]
            ]
        );
            $this->add_responsive_control(
                'ekit_double_button_middletext_color',
                [
                    'label'     => __( 'Color', 'elementskit' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   =>'#000000',
                    'selectors' => [
                        '{{WRAPPER}} .ekit-wid-con .ekit_button_middle_text' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'ekit_double_button_middletext_typography',
                    'label' => __( 'Typography', 'elementskit' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .ekit-wid-con .ekit_button_middle_text',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'ekit_double_button_middletext_border',
                    'label' => __( 'Border', 'elementskit' ),
                    'selector' => '{{WRAPPER}} .ekit-wid-con .ekit_button_middle_text',
                ]
            );

            $this->add_responsive_control(
                'ekit_double_button_middletext_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'elementskit' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .ekit-wid-con .ekit_button_middle_text' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'ekit_double_button_middletext_background',
                    'label' => __( 'Background', 'elementskit' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .ekit-wid-con .ekit_button_middle_text',
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'ekit_double_button_middletext_box_shadow',
                    'label' => __( 'Box Shadow', 'elementskit' ),
                    'selector' => '{{WRAPPER}} .ekit-wid-con .ekit_button_middle_text',
                ]
            );

            $this->add_responsive_control(
                'ekit_double_button_middletext_width',
                [
                    'label' => __( 'Width', 'elementskit' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 40,
                            'max' => 140,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 40,
                    ],
                    'separator' => 'before',
                    'selectors' => [
                        '{{WRAPPER}} .ekit-wid-con .ekit_button_middle_text' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'ekit_double_button_middletext_height',
                [
                    'label' => __( 'Height', 'elementskit' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 40,
                            'max' => 140,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 40,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ekit-wid-con .ekit_button_middle_text' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section(); //Button Middle Text Style tab end

    }

    protected function render( ) {
        echo '<div class="ekit-wid-con" >';
            $this->render_raw();
        echo '</div>';
    }

    protected function render_raw( ) {
		$settings = $this->get_settings_for_display();

        $button_one_text = $button_two_text = $button_middle_text = '';
        $this->add_render_attribute( 'ekit_doublebutton', 'class', 'ekit_double_button' );

        // Button One
        if ( ! empty( $settings['ekit_button_one_link']['url'] ) ) {

            $button_one_text  = !empty( $settings['ekit_button_one_text'] ) ? $settings['ekit_button_one_text'] : '';
            $button_one_icon  = !empty( $settings['ekit_button_one_icon'] ) ? '<i class="'.$settings['ekit_button_one_icon'].'"></i>' : '';

            $this->add_render_attribute( 'url_one', 'href', $settings['ekit_button_one_link']['url'] );

            if ( $settings['ekit_button_one_link']['is_external'] ) {
                $this->add_render_attribute( 'url_one', 'target', '_blank' );
            }

            if ( ! empty( $settings['ekit_button_one_link']['nofollow'] ) ) {
                $this->add_render_attribute( 'url_one', 'rel', 'nofollow' );
            }

            $this->add_render_attribute( 'url_one', 'class', 'ekit-double-btn ekit-double-btn-one' );

            if ($settings['ekit_double_button_one_icon_position'] == 'before') {
                $button_one_text = sprintf( '<a %1$s>%2$s%3$s</a>', $this->get_render_attribute_string( 'url_one' ), $button_one_icon, $button_one_text );
            } else {
                $button_one_text = sprintf( '<a %1$s>%2$s%3$s</a>', $this->get_render_attribute_string( 'url_one' ), $button_one_text, $button_one_icon );
            }
        }

        // Button Two
        $button_two_text  = !empty( $settings['ekit_button_two_text'] ) ? $settings['ekit_button_two_text'] : '';
        $button_two_icon  = !empty( $settings['ekit_button_two_icon'] ) ? '<i class="'.$settings['ekit_button_two_icon'].'"></i>' : '';

        if ( ! empty( $settings['ekit_button_two_link']['url'] ) ) {

            $this->add_render_attribute( 'url_two', 'href', $settings['ekit_button_two_link']['url'] );

            if ( $settings['ekit_button_two_link']['is_external'] ) {
                $this->add_render_attribute( 'url_two', 'target', '_blank' );
            }

            if ( ! empty( $settings['ekit_button_two_link']['nofollow'] ) ) {
                $this->add_render_attribute( 'url_two', 'rel', 'nofollow' );
            }

            $this->add_render_attribute( 'url_two', 'class', 'ekit-double-btn ekit-double-btn-two' );

            if ($settings['ekit_double_button_two_icon_position'] == 'before') {
                $button_two_text = sprintf( '<a %1$s>%2$s%3$s</a>', $this->get_render_attribute_string( 'url_two' ), $button_two_icon, $button_two_text );
            } else {
                $button_two_text = sprintf( '<a %1$s>%2$s%3$s</a>', $this->get_render_attribute_string( 'url_two' ), $button_two_text, $button_two_icon );
            }
        }

        if( $settings['ekit_show_button_middle_text'] == 'yes' && !empty( $settings['ekit_button_middle_text'] ) ){
            $button_middle_text = "<span class='ekit_button_middle_text'>".$settings['ekit_button_middle_text']."</span>";
        }

        $button_double_text = $button_one_text.$button_middle_text.$button_two_text;

        if( !empty( $button_one_text ) || !empty( $button_two_text ) ){
            echo sprintf( '<div class="ekit-element-align-wrapper"><div %1$s>%2$s</div></div>', $this->get_render_attribute_string( 'ekit_doublebutton' ), $button_double_text );
        }
    }

    protected function _content_template() { }
}