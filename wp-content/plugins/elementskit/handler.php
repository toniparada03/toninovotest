<?php
namespace ElementsKit;

defined( 'ABSPATH' ) || exit;


/**
 * ElementsKit - the God class.
 * Initiate all necessary classes, hooks, configs.
 *
 * @since 1.0.0
 */
class Handler{


	/**
	 * The plugin instance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @var Handler
	 */
    public static $instance = null;

    /**
     * Construct the plugin object.
     *
     * @since 1.0.0
     * @access public
     */
    public function __construct() {

        // Call the method for ElementsKit autoloader.
        $this->registrar_autoloader();

        // Enqueue frontend scripts.
        add_action( 'wp_enqueue_scripts', [$this, 'enqueue_frontend'] );

        // Enqueue admin scripts.
        add_action( 'admin_enqueue_scripts', [$this, 'enqueue_admin'] );

        // Enqueue inline scripts
        Core\Build_Inline_Scripts::instance();

        // Register plugin settings pages
        Libs\Framework\Attr::instance();

        // Register default widgets
        Core\Build_Widgets::instance();

        // Register default modules
        Core\Build_Modules::instance();

        // Register ElementsKit supported widgets to Elementor from 3rd party plugins.
        add_action( 'elementor/widgets/widgets_registered', [$this, 'register_widgets'],  1050);

        // Register ElementsKit's custom endpoints for WP RESTful APIs and 3rd party hooks.
        add_action( 'init', [$this, 'register_apis'],  1055);

        $license = Libs\Framework\Classes\License::instance();

        if ( $license->status() != 'valid' ) {
			add_action( 'admin_notices', array( $this, 'failed_license' ) );
		}

    }

    /**
     * Enqueue scripts
     *
     * Enqueue js and css to frontend.
     *
     * @since 1.0.0
     * @access public
     */
    public function enqueue_frontend(){
        wp_enqueue_style( 'elementskit-framework-css-frontend', \ElementsKit::lib_url() . 'framework/assets/css/frontend-style.css', \ElementsKit::VERSION );
        wp_enqueue_script( 'elementskit-framework-js-frontend', \ElementsKit::lib_url() . 'framework/assets/js/frontend-script.js', \ElementsKit::VERSION, true );
    }
    public function enqueue_frontend_inline(){
        $script_builder = new Core\Build_Inline_scripts();
        $script_builder->script_for_frontend();
    }

    /**
     * Enqueue scripts
     *
     * Enqueue js and css to admin.
     *
     * @since 1.0.0
     * @access public
     */
    public function enqueue_admin(){
        $screen = get_current_screen();
        // dd($screen);
        if(!in_array($screen->id, ['nav-menus', 'toplevel_page_elementskit', 'edit-elementskit_template', 'elementskit_page_elementskit-license'])){
            return;
        }

        wp_register_style( 'fontawesome', \ElementsKit::widget_url() . 'init/assets/css/font-awesome.min.css', \ElementsKit::VERSION );
        wp_register_style( 'elementskit-font-css-admin', \ElementsKit::widget_url() . 'init/assets/css/admin-ekiticon.css', \ElementsKit::VERSION );
        wp_register_style( 'elementskit-lib-css-admin', \ElementsKit::lib_url() . 'framework/assets/css/framework.css', \ElementsKit::VERSION );
        wp_register_style( 'elementskit-init-css-admin', \ElementsKit::lib_url() . 'framework/assets/css/admin-style.css', \ElementsKit::VERSION );
        wp_register_style( 'elementskit-init-css-admin-ems', \ElementsKit::lib_url() . 'framework/assets/css/admin-style-ems-dev.css', \ElementsKit::VERSION );


        wp_enqueue_style( 'fontawesome' );
        wp_enqueue_style( 'elementskit-font-css-admin' );
        wp_enqueue_style( 'elementskit-lib-css-admin' );
        wp_enqueue_style( 'elementskit-init-css-admin' );
        wp_enqueue_style( 'elementskit-init-css-admin-ems' );

        wp_enqueue_script( 'bootstrap', \ElementsKit::lib_url() . 'framework/assets/js/bootstrap.min.js', \ElementsKit::VERSION, true );
        wp_enqueue_script( 'popper', \ElementsKit::lib_url() . 'framework/assets/js/popper.min.js', \ElementsKit::VERSION, true );
        wp_enqueue_script( 'elementskit-init-js-admin', \ElementsKit::lib_url() . 'framework/assets/js/admin-script.js', \ElementsKit::VERSION, true );
    }
    public function enqueue_admin_inline(){
        $script_builder = new Core\Build_Inline_scripts();
        $script_builder->script_for_admin();
    }


    /**
     * Control registrar.
     *
     * Register the custom controls for Elementor
     * using `elementskit/widgets/widgets_registered` action.
     *
     * @since 1.0.0
     * @access public
     */
    public function register_control($widgets_manager){
        do_action('elementskit/widgets/widgets_registered', $widgets_manager);
    }


    /**
     * Api registrar.
     *
     * Retrieve all the registered API's endpoints
     * using `elementskit/apis/apis_registered/post` action (for POST method).
     * using `elementskit/apis/apis_registered/get` action (for GET method).
     *
     * @since 1.0.0
     * @access public
     */
    public function register_apis(){
        new Core\Build_Apis();
    }


    /**
     * Widget registrar.
     *
     * Retrieve all the registered widgets
     * using `elementor/widgets/widgets_registered` action.
     *
     * @since 1.0.0
     * @access public
     */
    public function register_widgets($widgets_manager){
        do_action('elementskit/widgets/widgets_registered', $widgets_manager);
    }



    /**
     * License error notice.
     *
     * @since 1.0.0
     * @access public
     */
    public function failed_license(){
		\ElementsKit\Notice::push(
			[
				'id'          => 'invalid-pro-version',
				'type'        => 'error',
				'dismissible' => true,
                'message'     => __('Please activate your license to get feature updates, premium support and unlimited access to the layout library.', 'elementskit'),
                'btn'         => [
                    'label' => esc_html__('Active ElementsKit', 'elementskit'),
                    'url' => self_admin_url('admin.php?page=elementskit-license')
                ]
			]
		);
    }


    /**
     * Construct the plugin object.
     *
     * @since 1.0.0
     * @access public
     */
    private function registrar_version_manager(){
        // run the migration class if current version is greater than old installed version.
        if(Helper::current_version() > Helper::old_version()){
            // load the update and related migration classes
            // new ElementsKit_Version_Manager();
        }
    }


    /**
     * Autoloader.
     *
     * ElementsKit autoloader loads all the classes needed to run the plugin.
     *
     * @since 1.0.0
     * @access private
     */
    private function registrar_autoloader() {
        require_once \ElementsKit::plugin_dir() . '/autoloader.php';
        Autoloader::run();
    }


    /**
     * Disable class cloning and throw an error on object clone.
     *
     * The whole idea of the singleton design pattern is that there is a single
     * object. Therefore, we don't want the object to be cloned.
     *
     * @access public
     * @since 1.0.0
     */
    public function __clone() {

        // Cloning instances of the class is forbidden.
        _doing_it_wrong( __FUNCTION__, esc_html__( 'Cloning is forbidden.', 'elementskit' ), '1.0.0' );
    }


    /**
     * Disable unserializing of the class.
     *
     * @access public
     * @since 1.0.0
     */
    public function __wakeup() {

        // Unserializing instances of the class is forbidden.
        _doing_it_wrong( __FUNCTION__, esc_html__( 'Unserializing instances of this class is forbidden.', 'elementskit' ), '1.0.0' );
    }


    /**
     * Instance.
     *
     * Ensures only one instance of the plugin class is loaded or can be loaded.
     *
     * @since 1.0.0
     * @access public
     * @static
     *
     * @return Handler An instance of the class.
     */
    public static function instance() {
        if ( is_null( self::$instance ) ) {

            // Fire when ElementsKit instance.
            self::$instance = new self();

            // Fire when ElementsKit was fully loaded and instantiated.
            do_action( 'elementskit/loaded' );
        }

        return self::$instance;
    }
}

// Run the instance.
Handler::instance();