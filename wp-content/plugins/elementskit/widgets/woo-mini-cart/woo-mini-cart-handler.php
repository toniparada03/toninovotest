<?php
namespace ElementsKit;

class ElementsKit_Widget_Woo_Mini_Cart_Handler extends Core\Handler_Widget{

    static function get_name() {
        return 'elementskit-woo-mini-cart';
    }

    static function get_title() {
        return esc_html__( 'Woo Mini Cart', 'elementskit' );
    }

    static function get_icon() {
        return 'ekit ekit-widget-icon ekit-accordion';
    }

    static function get_categories() {
        return [ 'elementskit' ];
    }

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'woo-mini-cart/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'woo-mini-cart/';
    }
    public function scripts(){
        
    }
    public function styles(){
        wp_enqueue_style( 'ekit-mini-cart', self::get_url() . 'assets/css/mini-cart.css', false, \ElementsKit::VERSION );

    }
}