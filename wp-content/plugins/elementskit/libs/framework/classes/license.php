<?php 
namespace ElementsKit\Libs\Framework\Classes;
use ElementsKit\Libs\Framework\Classes\Utils;

defined( 'ABSPATH' ) || exit;

class License{

    public static $instance = null;

    public function get_license_info(){
        return apply_filters('elementskit/license/extended', '');
    }

    public function activate($key){
        Utils::instance()->save_option('license_key', $key);
        return true;
    }

    public function revoke(){
        $data = [
            'key' => Utils::instance()->get_option('license_key'),
        ];
        // print_r($data); exit;
        $o = $this->com_revoke($data);
        if($o->validate == 1){
            delete_option('__validate_oppai__');
            Utils::instance()->save_option('license_key', '');
        }
        
        return $o;
    }

    public function com_validate($data = []){
        return 1;
    }

    public function com_revoke($data = []){
        $data['oppai'] = get_option('__validate_oppai__');
        $data['action'] = 'revoke';
        $data['v'] = \ElementsKit::VERSION;
        $url = \ElementsKit::api_url() . 'license?' . http_build_query($data);
        
        $args = array(
            'timeout'     => 10,
            'redirection' => 3,
            'httpversion' => '1.0',
            'user-agent'  => home_url(),
            'blocking'    => true,
            'sslverify'   => true,
        ); 
        // print_r(wp_remote_get( $url, $args ));
        $res = wp_remote_get( $url, $args );

        return (object) json_decode(
            (string) $res['body']
        );
    }

    public function status(){
        $status = 'valid';
        return $status;
    }

    public static function instance() {
        if ( is_null( self::$instance ) ) {

            // Fire the class instance
            self::$instance = new self();
        }

        return self::$instance;
    }
}