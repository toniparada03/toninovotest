<?php
namespace Elementor;

use \ElementsKit\Elementskit_Widget_Post_List_Handler as Handler;
use \ElementsKit\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if (! defined( 'ABSPATH' ) ) exit;

class Elementskit_Widget_Post_List extends Widget_Base {


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

	public function get_keywords() {
        return Handler::get_keywords();
    }

    public function get_categories() {
        return Handler::get_categories();
    }

	protected function _register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'List', 'elementskit' ),
			]
		);


		$repeater = new Repeater();

		$repeater->add_control(
			'text',
			[
				'label' => esc_html__( 'Text', 'elementskit' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'List Title', 'elementskit' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'elementskit' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => 'fa fa-check',
			]
		);

		$repeater->add_control(
			'link',
			[
                'label' =>esc_html__('Select Post', 'elementskit'),
                'type'      => ElementsKit_Controls_Manager::AJAXSELECT2,
                'options'   =>'ajaxselect2/post_list',
                'label_block' => true,
                'multiple'  => false,
			]
		);

		$this->add_control(
			'icon_list',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '<i class="{{ icon }}" aria-hidden="true"></i> {{{ text }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ekit_post_list_settings_tab',
			[
				'label' => __( 'Settings', 'elementskit' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'view',
			[
				'label' => esc_html__( 'Layout', 'elementskit' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'traditional',
				'options' => [
					'traditional' => [
						'title' => esc_html__( 'Default', 'elementskit' ),
						'icon' => 'eicon-editor-list-ul',
					],
					'inline' => [
						'title' => esc_html__( 'Inline', 'elementskit' ),
						'icon' => 'eicon-ellipsis-h',
					],
				],
				'render_type' => 'template',
				'classes' => 'elementor-control-start-end',
				'label_block' => false,
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'show_feature_image',
			[
				'label' => __( 'Show Feature Image', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'elementskit' ),
				'label_off' => __( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'show_post_meta',
			[
				'label' => __( 'Show Meta', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'elementskit' ),
				'label_off' => __( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		
		$this->add_control(
			'show_date_meta',
			[
				'label' => __( 'Show Date Meta', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'elementskit' ),
				'label_off' => __( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'show_post_meta' => 'yes',
				]
			]
		);

		$this->add_control(
			'date_meta__icon',
			[
				'label' => __( 'Date Meta Icon', 'elementskit' ),
				'type' => Controls_Manager::ICON,
				'default' => 'icon icon-calendar-page-empty',
				'condition' => [
					'show_post_meta' => 'yes',
					'show_date_meta' => 'yes',
				]
			]
		);
		
		$this->add_control(
			'show_category_meta',
			[
				'label' => __( 'Show Category Meta', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'elementskit' ),
				'label_off' => __( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'show_post_meta' => 'yes',
				]
			]
		);

		$this->add_control(
			'category_meta__icon',
			[
				'label' => __( 'Category Meta Icon', 'elementskit' ),
				'type' => Controls_Manager::ICON,
				'default' => 'icon icon-folder',
				'condition' => [
					'show_post_meta' => 'yes',
					'show_category_meta' => 'yes',
				]
			]
		);

		$this->add_control(
			'post_meta_position',
			[
				'label' => __( 'Meta Position', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'top_position',
				'options' => [
					'top_position'  => __( 'Top', 'elementskit' ),
					'bottom_position' => __( 'Bottom', 'elementskit' ),
				],
				'condition' => [
					'show_post_meta' => 'yes',
				]
			]
		);



		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_list',
			[
				'label' => esc_html__( 'List', 'elementskit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'space_between',
			[
				'label' => esc_html__( 'Space Between', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:last-child)' => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:first-child)' => 'margin-top: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item' => 'margin-right: calc({{SIZE}}{{UNIT}}/2); margin-left: calc({{SIZE}}{{UNIT}}/2)',
					'{{WRAPPER}} .elementor-icon-list-items.elementor-inline-items' => 'margin-right: calc(-{{SIZE}}{{UNIT}}/2); margin-left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body.rtl {{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item:after' => 'left: calc(-{{SIZE}}{{UNIT}}/2)',
					'body:not(.rtl) {{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item:after' => 'right: calc(-{{SIZE}}{{UNIT}}/2)',
				],
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' => esc_html__( 'Alignment', 'elementskit' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementskit' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementskit' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementskit' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'elementor-align-',
			]
		);

		$this->add_control(
			'divider',
			[
				'label' => esc_html__( 'Divider', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'Off', 'elementskit' ),
				'label_on' => esc_html__( 'On', 'elementskit' ),
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'content: ""',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'divider_style',
			[
				'label' => esc_html__( 'Style', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'solid' => esc_html__( 'Solid', 'elementskit' ),
					'dotted' => esc_html__( 'Dotted', 'elementskit' ),
					'dashed' => esc_html__( 'Dashed', 'elementskit' ),
				],
				'default' => 'solid',
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:last-child):after' => 'border-top-style: {{VALUE}}',
					'{{WRAPPER}} .elementor-icon-list-items.elementor-inline-items .elementor-icon-list-item:not(:last-child):after' => 'border-left-style: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'divider_weight',
			[
				'label' => esc_html__( 'Weight', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-items:not(.elementor-inline-items) .elementor-icon-list-item:not(:last-child):after' => 'border-top-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .elementor-inline-items .elementor-icon-list-item:not(:last-child):after' => 'border-left-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_width',
			[
				'label' => esc_html__( 'Width', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'condition' => [
					'divider' => 'yes',
					'view!' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_height',
			[
				'label' => esc_html__( 'Height', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'condition' => [
					'divider' => 'yes',
					'view' => 'inline',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'divider_color',
			[
				'label' => esc_html__( 'Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ddd',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'condition' => [
					'divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:not(:last-child):after' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__( 'Icon', 'elementskit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-icon i' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label' => esc_html__( 'Hover', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-icon i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 14,
				],
				'range' => [
					'px' => [
						'min' => 6,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-icon' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-icon-list-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			[
				'label' => esc_html__( 'Text', 'elementskit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-text' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label' => esc_html__( 'Hover', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item:hover .elementor-icon-list-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_indent',
			[
				'label' => esc_html__( 'Text Indent', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-text' => is_rtl() ? 'padding-right: {{SIZE}}{{UNIT}};' : 'padding-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'selector' => '{{WRAPPER}} .elementor-icon-list-item',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ekit_post_list_meta_style_tab',
			[
				'label' => __( 'Meta', 'elementskit' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_post_meta' => 'yes'
				]
			]
		);


		$this->start_controls_tabs( 'ekit_post_list_normal_and_hover_tabs' );

		$this->start_controls_tab(
			'ekit_post_list_normal_tab',
			[
				'label' =>esc_html__( 'Normal', 'elementskit' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ekit_post_list_meta_content_typography',
				'label' => __( 'Typography', 'elementskit' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .elementor-icon-list-item .meta-lists > span',
			]
		);

		$this->add_responsive_control(
			'ekit_post_list_meta_content_color',
			[
				'label' => __( 'Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#7f8595',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item .meta-lists > span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_post_list_meta_content_bg_color',
			[
				'label' => __( 'Background Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item .meta-lists > span' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_post_list_meta_content_border_radius',
			[
				'label' => __( 'Border Radius', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item .meta-lists > span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_post_list_meta_content_padding',
			[
				'label' => __( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item .meta-lists > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_post_list_meta_content_margin',
			[
				'label' => __( 'Margin', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item .meta-lists > span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'ekit_post_list_hover_tab',
			[
				'label' =>esc_html__( 'Hover', 'elementskit' ),
			]
		);

		$this->add_responsive_control(
			'ekit_post_list_meta_content_color_hover',
			[
				'label' => __( 'Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item .meta-lists > span:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_post_list_meta_content_bg_color_hover',
			[
				'label' => __( 'Background Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item .meta-lists > span:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_post_list_meta_content_border_radius_hover',
			[
				'label' => __( 'Border Radius', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-list-item .meta-lists > span:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render( ) {
        echo '<div class="ekit-wid-con" >';
            $this->render_raw();
        echo '</div>';
    }

    protected function render_raw( ) {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'icon_list', 'class', 'elementor-icon-list-items' );
		$this->add_render_attribute( 'list_item', 'class', 'elementor-icon-list-item' );

		if ( 'inline' === $settings['view'] ) {
			$this->add_render_attribute( 'icon_list', 'class', 'elementor-inline-items' );
			$this->add_render_attribute( 'list_item', 'class', 'elementor-inline-item' );
		}
		$categories = get_categories( array(
			'orderby' => 'name',
			'parent'  => 0
		) );
		
		?>
		<ul <?php echo \ElementsKit\Utils::render($this->get_render_attribute_string( 'icon_list' )); ?>>
			<?php
			foreach ( $settings['icon_list'] as $index => $item ) {
                $post = !empty( $item['link'] ) ? get_post($item['link']) : 0;
				$text = empty($item['text']) ? $post->post_title : $item['text'];
                if($post != null){ ?>
				<li class="elementor-icon-list-item" >
					<a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
						<?php 
							if ($settings['show_feature_image'] == 'yes') {
								echo get_the_post_thumbnail($post->ID, 'full');
							} else {
								if ( ! empty( $item['icon'] ) ) { ?>
									<span class="elementor-icon-list-icon">
										<i class="<?php echo esc_attr( $item['icon'] ); ?>" aria-hidden="true"></i>
									</span>
								<?php }
							}
						?>
						<div class="ekit_post_list_content_wraper">
							<?php if ($settings['show_post_meta'] == 'yes') { 
								if ($settings['post_meta_position'] == 'top_position') {
							?>
							<?php if ($settings['show_date_meta'] == 'yes' || $settings['show_category_meta'] == 'yes') { ?>
							<div class="meta-lists">
								<?php if ($settings['show_date_meta'] == 'yes') { ?>
								<span class="meta-date">
									<?php if (!empty($settings['date_meta__icon'])) { ?>
									<i class="<?php echo esc_attr($settings['date_meta__icon']); ?>"></i>
									<?php }; ?>
									<?php echo get_the_date("d M Y"); ?>
								</span>
								<?php }; ?>

								<?php 
									if ($settings['show_category_meta'] == 'yes') {
										$counter = 0;
										?>
										<span class="meta-category">
										<?php if (!empty($settings['category_meta__icon'])) { ?>
											<i class="<?php echo esc_attr($settings['category_meta__icon']); ?>"></i>
										<?php }
										foreach ( $categories as $category ) {
											printf( '%1$s',
												esc_html( $category->name )
											);
											$counter++;
											if ($counter == 1) {
												break;
											}
										} ?>
										</span>
										<?php
									}
								?>
							</div>
							<?php 
							};
								}; 
							};
							?>

                        	<span class="elementor-icon-list-text"><?php echo esc_html($text, 'elementskit'); ?></span>

							<?php if ($settings['show_post_meta'] == 'yes') { 
								if ($settings['post_meta_position'] == 'bottom_position') {
							?>
							<?php if ($settings['show_date_meta'] == 'yes' || $settings['show_category_meta'] == 'yes') { ?>
							<div class="meta-lists">
								<?php if ($settings['show_date_meta'] == 'yes') { ?>
								<span class="meta-date">
									<?php if (!empty($settings['date_meta__icon'])) { ?>
									<i class="<?php echo esc_attr($settings['date_meta__icon']); ?>"></i>
									<?php }; ?>
									<?php echo get_the_date("d M Y"); ?>
								</span>
								<?php }; ?>

								<?php 
									if ($settings['show_category_meta'] == 'yes') {
										$counter = 0;
										?>
										<span class="meta-category">
										<?php if (!empty($settings['category_meta__icon'])) { ?>
											<i class="<?php echo esc_attr($settings['category_meta__icon']); ?>"></i>
										<?php }
										foreach ( $categories as $category ) {
											printf( '%1$s',
												esc_html( $category->name )
											);
											$counter++;
											if ($counter == 1) {
												break;
											}
										} ?>
										</span>
										<?php
									}
								?>
							</div>
							<?php 
							};
								}; 
							};
							?>
						</div>
					</a>
				</li>
				<?php
				};
			};
			?>
		</ul>
		<?php
	}


}
