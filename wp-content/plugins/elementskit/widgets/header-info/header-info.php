<?php
namespace Elementor;

use \ElementsKit\Elementskit_Widget_Header_Info_Handler as Handler;
use \ElementsKit\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Elementskit_Widget_Header_Info extends Widget_Base
{


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

    protected function _register_controls()
    {

        $this->start_controls_section(
            'ekit_header_info',
            [
                'label' => esc_html__('Header Info', 'elementskit'),
            ]
        );

        $headerinfogroup = new Repeater();
        $headerinfogroup->add_control(
            'ekit_headerinfo_icon',
            [
                'label' => esc_html__('Icon', 'elementskit'),
                'label_block' => true,
                'type' => Controls_Manager::ICON,
                'default' => 'icon icon-facebook',

            ]
        );

        $headerinfogroup->add_control(
            'ekit_headerinfo_text',
            [
                'label' => esc_html__('Text', 'elementskit'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => '463 7th Ave, NY 10018, USA',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $headerinfogroup->add_control(
            'ekit_headerinfo_link',
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
            ]
        );

        $this->add_control(
            'ekit_headerinfo_group',
            [
                'label' => esc_html__( 'Header Info', 'elementskit' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $headerinfogroup->get_controls(),
                'default' => [
                    [
                        'ekit_headerinfo_text' => esc_html__( '463 7th Ave, NY 10018, USA', 'elementskit' ),

                    ],

                ],
                'dynamic' => [
                    'active' => true,
                ],
                'title_field' => '{{{ ekit_headerinfo_text }}}',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'ekit_header_icon_style',
            [
                'label' => esc_html__( 'Header Info', 'elementskit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ekit_info_text_color',
            [
                'label' => esc_html__( 'Text Color', 'elementskit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ekit-header-info > li > a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'elementskit_content_typography',
                'label' => esc_html__( 'Typography', 'elementskit' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .ekit-header-info > li > a',
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
        <ul class="ekit-header-info">
            <?php
        if ( $settings['ekit_headerinfo_group'] ){
            foreach (  $settings['ekit_headerinfo_group'] as $item ){

                $target = $item['ekit_headerinfo_link']['is_external'] ? ' target="_blank"' : '';
                $nofollow = $item['ekit_headerinfo_link']['nofollow'] ? ' rel="nofollow"' : '';
                ?>
                    <li>
                        <a href="<?php echo esc_url($item['ekit_headerinfo_link']['url']);?>">
                            <i class="<?php echo esc_attr($item['ekit_headerinfo_icon']);?>"></i>
                            <?php echo esc_html($item['ekit_headerinfo_text']);?>
                        </a>
                    </li>

                <?php


            }
        }
        ?>

        </ul>
<?php




    }
    protected function _content_template() { }






}