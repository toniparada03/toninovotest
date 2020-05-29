<?php
namespace Elementor;

use \ElementsKit\Elementskit_Widget_Business_Hours_Handler as Handler;
use \ElementsKit\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;


class Elementskit_Widget_Business_Hours extends Widget_Base {

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
			'ekit_btn_section_content',
			array(
				'label' => esc_html__( 'Content', 'elementskit' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'ekit_business_day',
			[
				'label'   => __( 'Day', 'elementskit' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Saturday', 'elementskit' ),
				'dynamic' => [
                    'active' => true,
                ],
			]
		);

		$repeater->add_control(
			'ekit_business_time',
			[
				'label'   => __( 'Time', 'elementskit' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( '9:00 AM - 6:00 PM', 'elementskit' ),
				'dynamic' => [
                    'active' => true,
                ],
			]
		);

		$repeater->add_control(
			'ekit_highlight_this_day',
			[
				'label'        => esc_html__( 'Hight Light this day', 'elementskit' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			]
		);

		$repeater->add_responsive_control(
			'ekit_single_business_day_color',
			[
				'label'     => __( 'Day Color', 'elementskit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fa2d2d',
				'selectors' => [
					'{{WRAPPER}} .ekit-wid-con {{CURRENT_ITEM}}.ekit-closed-day.ekit-single-day .ekit-business-day' => 'color: {{VALUE}}',
				],
				'condition' => [
					'ekit_highlight_this_day' => 'yes',
				],
				'separator' => 'before',
			]
		);

		$repeater->add_responsive_control(
			'ekit_single_business_time_color',
			[
				'label'     => __( 'Time Color', 'elementskit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fa2d2d',
				'selectors' => [
					'{{WRAPPER}} .ekit-wid-con {{CURRENT_ITEM}}.ekit-closed-day.ekit-single-day .ekit-business-time' => 'color: {{VALUE}}',
				],
				'condition' => [
					'ekit_highlight_this_day' => 'yes',
				],
				'separator' => 'before',
			]
		);

		$repeater->add_responsive_control(
			'ekit_single_business_background_color',
			[
				'label'     => __( 'Background Color', 'elementskit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ekit-wid-con {{CURRENT_ITEM}}.ekit-closed-day' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'ekit_highlight_this_day' => 'yes',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ekit_business_openday_list',
			[
				'type'    => Controls_Manager::REPEATER,
				'fields'  => array_values( $repeater->get_controls() ),
				'default' => [
					[
						'ekit_business_day' => __( 'Sunday', 'elementskit' ),
						'ekit_business_time' => __( 'Close','elementskit' ),
						'ekit_highlight_this_day' => __( 'yes','elementskit' ),
					],

					[
						'ekit_business_day' => __( 'Saturday', 'elementskit' ),
						'ekit_business_time' => __( '10:00 AM to 7:00 PM','elementskit' ),
						'ekit_highlight_this_day' => __( 'yes','elementskit' ),
					],

					[
						'ekit_business_day' => __( 'Monday', 'elementskit' ),
						'ekit_business_time' => __( '10:00 AM to 7:00 PM','elementskit' ),
					],

					[
						'ekit_business_day' => __( 'Tues Day', 'elementskit' ),
						'ekit_business_time' => __( '10:00 AM to 7:00 PM','elementskit' ),
					],

					[
						'ekit_business_day' => __( 'Wednesday', 'elementskit' ),
						'ekit_business_time' => __( '10:00 AM to 7:00 PM','elementskit' ),
					],

					[
						'ekit_business_day' => __( 'Thursday', 'elementskit' ),
						'ekit_business_time' => __( '10:00 AM to 7:00 PM','elementskit' ),
					],

					[
						'ekit_business_day' => __( 'Friday', 'elementskit' ),
						'ekit_business_time' => __( '10:00 AM to 7:00 PM','elementskit' ),
					]
				],
				'title_field' => '{{{ ekit_business_day }}}',
			]
		);

		$this->end_controls_section();


        // Style Item section
        $this->start_controls_section(
            'ekit_business_item_style_section',
            [
                'label' => __( 'Item', 'elementskit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_responsive_control(
			'ekit_business_item_margin',
			[
				'label' => __( 'Margin', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit-wid-con .ekit-single-day' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' =>'before',
			]
		);

		$this->add_responsive_control(
			'ekit_business_item_padding',
			[
				'label' => __( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit-wid-con .ekit-single-day' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' =>'after',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_business_item_background',
				'label' => __( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ekit-wid-con .ekit-single-day',
			]
		);

		$this->add_responsive_control(
			'ekit_business_item_item_radius',
			[
				'label' => __( 'Border Radius', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit-wid-con .ekit-single-day' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ekit_business_item_border',
				'label' => __( 'Border', 'elementskit' ),
				'selector' => '{{WRAPPER}} .ekit-wid-con .ekit-single-day:not(:last-child)',
			]
		);

        $this->end_controls_section();

        // Style Business day section
        $this->start_controls_section(
            'ekit_business_day_style_section',
            [
                'label' => __( 'Day', 'elementskit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_responsive_control(
			'ekit_business_day_color',
			[
				'label'     => __( 'color', 'elementskit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ekit-wid-con .ekit-single-day .ekit-business-day' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ekit_business_day_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .ekit-wid-con .ekit-single-day .ekit-business-day',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_business_day_background',
				'label' => __( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ekit-wid-con .ekit-single-day .ekit-business-day',
			]
		);

		$this->add_responsive_control(
			'ekit_business_item_day_radius',
			[
				'label' => __( 'Border Radius', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit-wid-con .ekit-single-day .ekit-business-day' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// $this->add_responsive_control(
		// 	'ekit_business_item_day_margin',
		// 	[
		// 		'label' => __( 'Margin', 'elementskit' ),
		// 		'type' => Controls_Manager::DIMENSIONS,
		// 		'size_units' => [ 'px', '%', 'em' ],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .ekit-wid-con .ekit-single-day .ekit-business-day' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		],
		// 	]
		// );

		$this->add_responsive_control(
			'ekit_business_item_day_padding',
			[
				'label' => __( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit-wid-con .ekit-single-day .ekit-business-day' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        // Style Business Time section
        $this->start_controls_section(
            'ekit_business_time_style_section',
            [
                'label' => __( 'Time', 'elementskit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_responsive_control(
			'ekit_business_time_color',
			[
				'label'     => __( 'color', 'elementskit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ekit-wid-con .ekit-single-day .ekit-business-time' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ekit_business_time_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .ekit-wid-con .ekit-single-day .ekit-business-time',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_business_time_background',
				'label' => __( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ekit-wid-con .ekit-single-day .ekit-business-time',
			]
		);

		$this->add_responsive_control(
			'ekit_business_item_time_radius',
			[
				'label' => __( 'Border Radius', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit-wid-con .ekit-single-day .ekit-business-time' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// $this->add_responsive_control(
		// 	'ekit_business_item_time_margin',
		// 	[
		// 		'label' => __( 'Margin', 'elementskit' ),
		// 		'type' => Controls_Manager::DIMENSIONS,
		// 		'size_units' => [ 'px', '%', 'em' ],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .ekit-wid-con .ekit-single-day .ekit-business-time' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		],
		// 	]
		// );

		$this->add_responsive_control(
			'ekit_business_item_time_padding',
			[
				'label' => __( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit-wid-con .ekit-single-day .ekit-business-time' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


        $this->end_controls_section();
    }

    protected function render( ) {
        echo '<div class="ekit-wid-con" >';
            $this->render_raw();
        echo '</div>';
    }

    protected function render_raw( ) {
		$settings = $this->get_settings_for_display();
		?>
		<div class="ekit-business-hours-inner">
			<?php foreach ($settings['ekit_business_openday_list'] as $item) : ?>
			<div class="ekit-single-day elementor-repeater-item-<?php echo $item['_id']; ?> <?php if( $item['ekit_highlight_this_day'] == 'yes' ){ echo esc_attr( 'ekit-closed-day','elementskit'); }?>">
				<?php if( !empty( $item['ekit_business_day'] ) ) : ?>
				<span class="ekit-business-day"><?php echo esc_html__( $item['ekit_business_day'],'elementskit' ); ?></span>
				<?php endif; if( !empty( $item['ekit_business_time'] ) ): ?>
				<span class="ekit-business-time"><?php echo esc_html__( $item['ekit_business_time'],'elementskit' ); ?></span>
				<?php endif; ?>
			</div>
			<?php endforeach; ?>
		</div>
        <?php
    }

    protected function _content_template() { }
}