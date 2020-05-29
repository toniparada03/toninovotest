<?php

namespace Elementor;

use \ElementsKit\Elementskit_Widget_FAQ_Handler as Handler;
use \ElementsKit\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Elementskit_Widget_FAQ extends Widget_Base {

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
            'ekit_faq_section_tab', [
                'label' =>esc_html__( 'FAQ', 'elementskit' ),
            ]
        );


        $repeater = new Repeater();

        $repeater->add_control(
            'ekit_faq_title',
            [
                'label' =>esc_html__( 'Title', 'elementskit' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' =>esc_html__( 'Title type here', 'elementskit' ),
                'default' =>esc_html__( 'How to Change my Photo from Admin Dashboard?', 'elementskit' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $repeater->add_control(
            'ekit_faq_content',
            [
                'label' =>esc_html__( 'Content', 'elementskit' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' =>esc_html__( 'Description type here', 'elementskit' ),
                'default' =>esc_html__( 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast', 'elementskit' ),
                'dynamic' => [
                    'active' => true
                ],
            ]
        );

        $repeater->add_control(
			'ekit_faq_content_special_item_tag_choosen',
			[
				'label' => esc_html__( 'Highlight Content', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'span',
				'options' => [
					'span'  => esc_html__( 'Span', 'elementskit' ),
					'u' => esc_html__( 'U', 'elementskit' ),
					'a' => esc_html__( 'A', 'elementskit' ),
					'em' => esc_html__( 'Em', 'elementskit' ),
                    'strong' => esc_html__( 'Strong', 'elementskit' ),
                    'sub' => esc_html__( 'Sub', 'elementskit' ),
                    'sup' => esc_html__( 'Sup', 'elementskit' ),
                    'code' => esc_html__( 'Code', 'elementskit' ),
				],
			]
        );

        $repeater->add_control(
			'ekit_faq_content_special_item_tag_website_link',
			[
				'label' => esc_html__( 'Link', 'elementskit' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'elementskit' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'ekit_faq_content_special_item_tag_choosen' => 'a'
                ]
			]
        );

        $repeater->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ekit_faq_content_special_elemtnt_typography',
				'label' => esc_html__( 'Typography', 'elementskit' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} {{CURRENT_ITEM}} .elementskit-faq-body > p >span,
                    {{WRAPPER}} {{CURRENT_ITEM}} .elementskit-faq-body > p >u,
                    {{WRAPPER}} {{CURRENT_ITEM}} .elementskit-faq-body > p >a,
                    {{WRAPPER}} {{CURRENT_ITEM}} .elementskit-faq-body > p >em,
                    {{WRAPPER}} {{CURRENT_ITEM}} .elementskit-faq-body > p >strong,
                    {{WRAPPER}} {{CURRENT_ITEM}} .elementskit-faq-body > p >sub,
                    {{WRAPPER}} {{CURRENT_ITEM}} .elementskit-faq-body > p >sup,
                    {{WRAPPER}} {{CURRENT_ITEM}} .elementskit-faq-body > p >code
                ',
			]
        );

        $repeater->add_responsive_control(
			'ekit_faq_content_special_elemtnt_color',
			[
				'label' => esc_html__( 'Highlight Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
                'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementskit-faq-body > p >span' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementskit-faq-body > p >u' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementskit-faq-body > p >a' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementskit-faq-body > p >em' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementskit-faq-body > p >strong' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementskit-faq-body > p >sub' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementskit-faq-body > p >sup' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementskit-faq-body > p >code' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
            'ekit_faq_content_items',
            [
                'label' => esc_html__('Tab content', 'elementskit'),
                'type' => Controls_Manager::REPEATER,
                'separator' => 'before',
                'title_field' => '{{ ekit_faq_title }}',
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    [
                        'ekit_faq_title' => 'Wait. What is WordPress?',
                        'ekit_faq_content' => 'Far far away, behind the word Mountains far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmark',
                    ],
                    [
                        'ekit_faq_title' => 'How long do I get support?',
                        'ekit_faq_content' => 'Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line',
                    ],
                    [
                        'ekit_faq_title' => 'Do I need to renew my license?',
                        'ekit_faq_content' => 'Marks and devious Semikoli but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.',
                    ],
                ],
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();

        //Title Style Section

        $this->start_controls_section(
            'ekit_faq_section_title_style', [
                'label'	 =>esc_html__( 'Title', 'elementskit' ),
                'tab'	 => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ekit_faq_title_color', [
                'label'		 =>esc_html__( 'Title Color', 'elementskit' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .elementskit-single-faq .elementskit-faq-title' => 'color: {{VALUE}};'
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'		 => 'ekit_faq_title_typography_group',
                'selector'	 => '{{WRAPPER}} .elementskit-single-faq .elementskit-faq-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ekit_faq_title_background_group',
                'label' => esc_html__( 'Background', 'elementskit' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .elementskit-single-faq .elementskit-faq-header',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_faq_title_border_group',
                'label' => esc_html__( 'Border', 'elementskit' ),
                'selector' => '{{WRAPPER}} .elementskit-single-faq .elementskit-faq-header',
            ]
        );

        $this->add_control(
            'ekit_faq_border_radious',
            [
                'label' => esc_html__( 'Title Border Radius', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-single-faq .elementskit-faq-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ekit_faq_title_padding',
            [
                'label' => esc_html__( 'Title Padding', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => 	[
					'top' => '21',
					'right' => '40',
					'bottom' => '21',
					'left' => '40',
					'unit' => 'px',
				],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-single-faq .elementskit-faq-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ekit_faq_title_margin',
            [
                'label' => esc_html__( 'Title Margin', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-single-faq .elementskit-faq-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

        //Content Style Section
        $this->start_controls_section(
            'ekit_faq_section_content_style', [
                'label'	 =>esc_html__( 'Content', 'elementskit' ),
                'tab'	 => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ekit_faq_content_color', [
                'label'		 =>esc_html__( 'Color', 'elementskit' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .elementskit-single-faq .elementskit-faq-body' => 'color: {{VALUE}};'
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name'		 => 'ekit_faq_content_typography_group',
                'selector'	 => '{{WRAPPER}} .elementskit-single-faq .elementskit-faq-body',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ekit_faq_content_background_group',
                'label' => esc_html__( 'Content Background', 'elementskit' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .elementskit-single-faq .elementskit-faq-body',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ekit_faq_content_border_group',
                'label' => esc_html__( 'Content Border', 'elementskit' ),
                'selector' => '{{WRAPPER}} .elementskit-single-faq .elementskit-faq-body',
            ]
        );

        $this->add_control(
            'ekit_faq_content_border_radious',
            [
                'label' => esc_html__( 'Border Radius', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-single-faq .elementskit-faq-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ekit_faq_content_padding',
            [
                'label' => esc_html__( 'Content Padding', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => 	[
					'top' => '30',
					'right' => '40',
					'bottom' => '30',
					'left' => '40',
					'unit' => 'px',
				],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-single-faq .elementskit-faq-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ekit_faq_content_margin',
            [
                'label' => esc_html__( 'Content Margin', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-faq-body > p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ekit_faq_container_margin',
            [
                'label' => esc_html__( 'Container Margin', 'elementskit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementskit-single-faq:not(:last-child)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }
    public function kspan($content, $tags='span'){
        $content = strip_tags($content);
        return str_replace(['{{', '}}'], ["<$tags>", "</$tags>"], $content);
    }
    public function kspan_for_link($content, $href="#", $target="_self", $rel){
        $content = strip_tags($content);
        return str_replace(['{{', '}}'], ["<a href=".$href." target=".$target." rel=".$rel.">", "</a>"], $content);
    }
    protected function render( ) {
        echo '<div class="ekit-wid-con" >';
            $this->render_raw();
        echo '</div>';
    }

    protected function render_raw( ) {
        $settings = $this->get_settings_for_display();
        extract($settings);
        ?>

        <?php if($ekit_faq_content_items > 0) : foreach($ekit_faq_content_items as $ekit_faq_content_item) : ?>
        <?php
            $link_href = $ekit_faq_content_item['ekit_faq_content_special_item_tag_website_link']['url'];
            $link_target = $ekit_faq_content_item['ekit_faq_content_special_item_tag_website_link']['is_external'] == true ? '_blank' : '_self';
            $link_rel = $ekit_faq_content_item['ekit_faq_content_special_item_tag_website_link']['nofollow'] == true ? 'nofollow' : '';
        ?>
        <div class="elementskit-single-faq elementor-repeater-item-<?php echo esc_attr( $ekit_faq_content_item[ '_id' ] ); ?>">
            <div class="elementskit-faq-header">
                <h2 class="elementskit-faq-title"><?php echo esc_html($ekit_faq_content_item['ekit_faq_title']); ?></h2>
            </div>
            <div class="elementskit-faq-body">
                <?php if($ekit_faq_content_item['ekit_faq_content_special_item_tag_choosen'] != 'a') : ?>
                <p><?php echo wp_kses_post($this->kspan( $ekit_faq_content_item['ekit_faq_content'], $ekit_faq_content_item['ekit_faq_content_special_item_tag_choosen'] )); ?></p>
                <?php endif; ?>
                <?php if($ekit_faq_content_item['ekit_faq_content_special_item_tag_choosen'] == 'a') : ?>
                <p><?php echo wp_kses_post($this->kspan_for_link( $ekit_faq_content_item['ekit_faq_content'], $link_href, $link_target, $link_rel)); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; endif; ?>

    <?php }

    protected function _content_template() { }
}