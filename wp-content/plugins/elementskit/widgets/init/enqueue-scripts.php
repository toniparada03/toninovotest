<?php
namespace ElementsKit\Widgets\Init;

defined( 'ABSPATH' ) || exit;

class Enqueue_Scripts{

    public function __construct() {

        add_action( 'wp_enqueue_scripts', [$this, 'frontend_js']);
        add_action( 'wp_enqueue_scripts', [$this, 'frontend_css'], 99 );

        add_action( 'elementor/frontend/before_enqueue_scripts', [$this, 'elementor_js'] );
        add_action( 'elementor/editor/after_enqueue_styles', [$this, 'elementor_css'] );
    }

    public function elementor_js() {
        wp_enqueue_script( 'elementskit-elementor', \ElementsKit::widget_url() . 'init/assets/js/elementor.js',array( 'jquery', 'elementor-frontend' ), \ElementsKit::VERSION, true );
    }

    public function elementor_css() {
        wp_enqueue_style( 'elementskit-panel', \ElementsKit::widget_url() . 'init/assets/css/editor.css',null, \ElementsKit::VERSION );
    }

    public function frontend_js() {
        if(!is_admin()){
            
            /*
            * Register scripts.
            * This scripts are only loaded when the associated widget is being used on a page.
            */
            wp_register_script( 'magnific-popup', \ElementsKit::widget_url() . 'init/assets/js/jquery.magnific-popup.min.js', array( 'jquery' ), false, true ); // video //
            wp_register_script( 'isotope', \ElementsKit::widget_url() . 'init/assets/js/isotope.pkgd.min.js', array( 'jquery' ), false, true ); // gallary //
            wp_register_script( 'masonry', \ElementsKit::widget_url() . 'init/assets/js/masonry.pkgd.min.js', array( 'jquery' ), false, true ); // gallary //
            wp_register_script( 'easypiechart', \ElementsKit::widget_url() . 'init/assets/js/jquery.easypiechart.min.js', array( 'jquery' ), false, true ); // chart //
            
            wp_register_script( 'twentytwenty', \ElementsKit::widget_url() . 'init/assets/js/jquery.twentytwenty.js', array( 'jquery' ), false, true ); // image comparism //
            wp_register_script( 'final-countdown', \ElementsKit::widget_url() . 'init/assets/js/jquery.countdown.min.js', array( 'jquery' ), false, true ); // count down //
            wp_register_script( 'tilt', \ElementsKit::widget_url() . 'init/assets/js/tilt.jquery.min.js', array( 'jquery' ), false, true ); // gallary //
            wp_register_script( 'slick', \ElementsKit::widget_url() . 'init/assets/js/slick.min.js', array( 'jquery' ), false, true ); // testimonial, client //
            wp_register_script( 'goodshare', \ElementsKit::widget_url() . 'init/assets/js/goodshare.min.js', array( 'jquery' ), false, true ); // sosial share //
            wp_register_script( 'event.move', \ElementsKit::widget_url() . 'init/assets/js/jquery.event.move.js', array( 'jquery' ), false, true ); // image comparism //           
            wp_register_script( 'datatables', \ElementsKit::widget_url() . 'init/assets/js/datatables.min.js', array( 'jquery' ), false, true ); // table //    
            
            /*
            * Enqueue scripts.
            * This scripts are globally loaded.
            */
            wp_enqueue_script( 'ekit-nav-menu', \ElementsKit::widget_url() . 'init/assets/js/nav-menu.js', array( 'jquery' ), false, true ); // nav-menu //
            wp_enqueue_script( 'ekit-slim-ui', \ElementsKit::widget_url() . 'init/assets/js/ui-slim.min.js', array( 'jquery' ), false, true ); // tab, accordion, modal //
        }
    }

    public function frontend_css() {
        if(!is_admin()){
            wp_enqueue_style( 'font-awesome', \ElementsKit::widget_url() . 'init/assets/css/font-awesome.min.css', false, \ElementsKit::VERSION );
            wp_enqueue_style( 'elementskit-vendors', \ElementsKit::widget_url() . 'init/assets/css/vendors.css', false, \ElementsKit::VERSION );
            wp_enqueue_style( 'elementskit-style', \ElementsKit::widget_url() . 'init/assets/css/style.css', false, \ElementsKit::VERSION );
            wp_enqueue_style( 'elementskit-responsive', \ElementsKit::widget_url() . 'init/assets/css/responsive.css', false, \ElementsKit::VERSION );
        }
    }
}