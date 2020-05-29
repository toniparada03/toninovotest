<?php
namespace ElementsKit;

class Elementskit_Widget_Post_List_Handler extends Core\Handler_Widget{

    static function get_name() {
		return 'elementskit-post-list';
	}


	static function get_title() {
		return esc_html__( 'Post List', 'elementskit' );
	}


	static function get_icon() {
		return 'eicon-bullet-list ekit-widget-icon ';
	}

	static function get_keywords() {
	    return [ 'list', 'post list', 'post', 'ekit', 'elementskit post list' ];
	}

    static function get_categories() {
        return [ 'elementskit_headerfooter' ];
	}

    static function get_dir() {
        return \ElementsKit::widget_dir() . 'post-list/';
    }

    static function get_url() {
        return \ElementsKit::widget_url() . 'post-list/';
    }
}