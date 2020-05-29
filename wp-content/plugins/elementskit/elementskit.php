<?php

defined( 'ABSPATH' ) || exit;
/**
 * Plugin Name: ElementsKit
 * Description: The most advanced addons for Elementor with tons of widgets, Header builder, Footer builder, Mega menu builder, layout pack and powerful custom controls.
 * Plugin URI: https://products.wpmet.com/elementskit
 * Author: Wpmet
 * Version: 1.2.1
 * Author URI: https://wpmet.com/
 *
 * Text Domain: elementskit
 *
 * @package ElementsKit
 * @category Pro
 *
 * Elemeпtskit is a powerful addoп for Elemeпtor page builder.
 * It iпcludes most compreheпsive modules, such as "header footer builder", "mega meпu",
 * "layout iпstaller", "quick form builder" etc uпder the hood.
 * It has a toпs of widgets to create aпy sites with aп ease. It has some most uпique
 * and powerful custom coпtrols for elemeпtor, such as "image picker", "ajax select", "widget area".
 * 
 */

if(!class_exists('ElementsKit')):

final class ElementsKit{
	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 * @var string The plugin version.
	 */
	const VERSION = '1.2.1';

	/**
	 * Package type
	 *
	 * @since 1.1.0
	 * @var string The plugin purchase type [pro/ free].
	 */
	const PACKAGE_TYPE = 'pro';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */

	const MINIMUM_ELEMENTOR_VERSION = '2.4.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '5.6';

	/**
	 * Plugin file
	 *
	 * @since 1.0.0
	 * @var string plugins's root file.
	 */
	static function plugin_file(){
		return __FILE__;
	}

	/**
	 * Plugin url
	 *
	 * @since 1.0.0
	 * @var string plugins's root url.
	 */
	static function plugin_url(){
		return trailingslashit(plugin_dir_url( __FILE__ ));
	}

	/**
	 * Plugin dir
	 *
	 * @since 1.0.0
	 * @var string plugins's root directory.
	 */
	static function plugin_dir(){
		return trailingslashit(plugin_dir_path( __FILE__ ));
	}

    /**
     * Plugin's widget directory.
     *
     * @since 1.0.0
     * @var string widget's root directory.
     */
	static function widget_dir(){
		return self::plugin_dir() . 'widgets/';
	}

    /**
     * Plugin's widget url.
     *
     * @since 1.0.0
     * @var string widget's root url.
     */
	static function widget_url(){
		return self::plugin_url() . 'widgets/';
	}


    /**
     * Remote url
     *
     * @since 1.0.0
     * @var string widget image choose's root url.
     */
	static function api_url(){
		return 'http://api.wpmet.com/public/';
	}

    /**
     * Plugin's module directory.
     *
     * @since 1.0.0
     * @var string module's root directory.
     */
	static function module_dir(){
		return self::plugin_dir() . 'modules/';
	}

    /**
     * Plugin's module url.
     *
     * @since 1.0.0
     * @var string module's root url.
     */
	static function module_url(){
		return self::plugin_url() . 'modules/';
	}


    /**
     * Plugin's lib directory.
     *
     * @since 1.0.0
     * @var string lib's root directory.
     */
	static function lib_dir(){
		return self::plugin_dir() . 'libs/';
	}

    /**
     * Plugin's lib url.
     *
     * @since 1.0.0
     * @var string lib's root url.
     */
	static function lib_url(){
		return self::plugin_url() . 'libs/';
	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		// Load translation
		add_action( 'init', array( $this, 'i18n' ) );
		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ), 100 );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'elementskit', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Initialize the plugin
	 *
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {
		// Load the main static helper class.
		require_once self::plugin_dir() . 'helpers/dump.php';
		require_once self::plugin_dir() . 'helpers/notice.php';
		require_once self::plugin_dir() . 'helpers/utils.php';

		// Check if Elementor installed and activated.
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'missing_elementor' ) );
			return;
		}
		// Check for required Elementor version.
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'failed_elementor_version' ) );
			return;
		}
		// Check for required PHP version.
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'failed_php_version' ) );
			return;
		}
		// Once we get here, We have passed all validation checks so we can safely include our plugin.

		// Register ElementsKit widget category
		add_action('elementor/init', [$this, 'elementor_widget_category']);

		add_action( 'elementor/init', function(){
			// Load the Handler class, it's the core class of ElementsKit.
			require_once self::plugin_dir() . 'handler.php';
		});

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have required Elementor.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function missing_elementor() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		if ( file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) ) {
			$btn['label'] = esc_html__('Activate Elementor', 'elementskit');
			$btn['url'] = wp_nonce_url( 'plugins.php?action=activate&plugin=elementor/elementor.php&plugin_status=all&paged=1', 'activate-plugin_elementor/elementor.php' );
		} else {
			$btn['label'] = esc_html__('Install Elementor', 'elementskit');
			$btn['url'] = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
		}

		\ElementsKit\Notice::push(
			[
				'id'          => 'unsupported-elementor-version',
				'type'        => 'error',
				'dismissible' => true,
				'btn'		  => $btn,
				'message'     => sprintf( esc_html__( 'ElementsKit requires Elementor version %1$s+, which is currently NOT RUNNING.', 'elementskit' ), self::MINIMUM_ELEMENTOR_VERSION ),
			]
		);
	}


	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		\ElementsKit\Notice::push(
			[
				'id'          => 'unsupported-php-version',
				'type'        => 'error',
				'dismissible' => true,
				'message'     => sprintf( esc_html__( 'ElementsKit requires PHP version %1$s+, which is currently NOT RUNNING on this server.', 'elementskit' ), self::MINIMUM_PHP_VERSION ),
			]
		);
	}

    /**
     * Rewrite flush.
     *
     * @since 1.0.7
     * @access public
     */
	public static function flush_rewrites(){
		require_once self::module_dir() . 'dynamic-content/cpt.php'; 
		new ElementsKit\Modules\Dynamic_Content\Cpt();

		flush_rewrite_rules();
	}
    /**
     * Add category.
     *
     * Register custom widget category in Elementor's editor
     *
     * @since 1.0.0
     * @access public
     */
    public function elementor_widget_category($widgets_manager){
		\Elementor\Plugin::$instance->elements_manager->add_category(
			'elementskit',
			[
				'title' =>esc_html__( 'ElementsKit', 'elementskit' ),
				'icon' => 'fa fa-plug',
			],
			1
		);
        \Elementor\Plugin::$instance->elements_manager->add_category(
            'elementskit_headerfooter',
            [
                'title' =>esc_html__( 'ElementsKit Header Footer', 'elementskit' ),
                'icon' => 'fa fa-plug',
            ],
            1
        );
	}


	static function default_widgets($package = null){
		$package = ($package != null) ? $package : self::PACKAGE_TYPE;
		$default_list = [
			'image-accordion',
			'accordion',
			'button',
            'heading',
            'blog-posts',
            'icon-box',
            'image-box',
            'countdown-timer',
            'client-logo',
            'faq',
            'funfact',
            'image-comparison',
            'testimonial',
            'pricing',
            'team',
            'social',
            'progressbar',
            'category-list',
            'page-list',
            'post-grid',
            'post-list',
            'post-tab',
            'nav-menu',
            'mail-chimp',
            'header-info',
			'piechart',
            'header-search',
            'header-offcanvas',
			'tab',
            'contact-form7',
            'video',
			'business-hours',
			'drop-caps',
			'social-share',
			'caldera-forms',
		];
		
		$optional_list = [
			'advanced-accordion',
			'advanced-tab',
			'hotspot',
			'motion-text',
			'twitter-feed',
            'facebook-feed',
			'instagram-feed',
			'gallery',
			'chart',
			'woo-category-list',
			'woo-mini-cart',
			'woo-product-carousel',
			'woo-product-list',
			'table',
			'timeline',
			'dual-button',
			'creative-button',
		];

		return ($package == 'pro') ? array_merge($default_list, $optional_list) : $default_list;
	}

	static function default_modules($package = null){
		$package = ($package != null) ? $package : self::PACKAGE_TYPE;
		$default_list = [

			'header-footer',
			'megamenu'
		];

		$optional_list =[
			'parallax',
			'sticky-content',
		];

		return ($package == 'pro') ? array_merge($default_list, $optional_list) : $default_list;
	}
}

new ElementsKit();

register_activation_hook( __FILE__, 'ElementsKit::flush_rewrites' );

endif;