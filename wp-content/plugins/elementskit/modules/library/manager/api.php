<?php namespace ElementsKit\Modules\Library\Manager;defined('ABSPATH')||exit;class Api{private $dir;private $url;private $server_url;private $sources;public function __construct(){if(defined('WP_DEBUG')&&WP_DEBUG!=true){error_reporting(0);}$this->sources=['elementskit-api',];$this->server_url=\ElementsKit::api_url().'elementor-layouts/';$this->dir=dirname(__FILE__).'/';$this->url=\ElementsKit::plugin_url().'modules/library/templates/';add_action('wp_ajax_elementskit_get_templates',array($this,'get_templates'));add_action('wp_ajax_elementskit_core_clone_template',array($this,'clone_template'));add_action('wp_ajax_elementskit_get_layouts',[$this,'get_layouts']);if(defined('ELEMENTOR_VERSION')&&version_compare(ELEMENTOR_VERSION,'2.2.8','>')){add_action('elementor/ajax/register_actions',array($this,'register_ajax_actions'),20);}else{add_action('wp_ajax_elementor_get_template_data',array($this,'get_template_data'),-1);}}public function get_license(){if(!class_exists('\ElementsKit\Libs\Framework\Classes\Utils')){return[];}return['key'=>\ElementsKit\Libs\Framework\Classes\Utils::instance()->get_option('license_key'),'oppai'=>get_option('__validate_oppai__'),'package_type'=>\ElementsKit::PACKAGE_TYPE];}public function get_layouts(){isset($_GET['tab'])||exit();$query=array_merge(['action'=>'get_layouts','tab'=>(empty($_GET['tab'])?'elementskit_page':$_GET['tab']),],$this->get_license());$request_url=$this->server_url.'?'.http_build_query($query);$response=wp_remote_get($request_url,array('timeout'=>120,'httpversion'=>'1.1',));if($response['body']!=''){echo \ElementsKit\Utils::kses($response['body']);exit;}}public function get_layout_data(){$actions=!isset($_POST['actions'])?'':$_POST['actions'];$actions=json_decode(stripslashes($actions),true);$template_data=reset($actions);$query=array_merge(['action'=>'get_layout_data','id'=>$template_data['data']['template_id'],],$this->get_license());$request_url=$this->server_url.'?'.http_build_query($query);$response=wp_remote_get($request_url,array('timeout'=>120,'httpversion'=>'1.1',));$content=json_decode($response['body'],true);$content=$this->process_import_ids($content);$content=$this->process_import_content($content,'on_import');return $content;}public function register_ajax_actions($ajax){if(!isset($_POST['actions'])){return;}$actions=json_decode(stripslashes($_REQUEST['actions']),true);$data=false;foreach($actions as $id=>$action_data){if(!isset($action_data['get_template_data'])){$data=$action_data;}}if(!$data){return;}if(!isset($data['data'])){return;}if(!isset($data['data']['source'])){return;}$source=$data['data']['source'];if(!in_array($source,$this->sources)){return;}$ajax->register_ajax_action('get_template_data',function($data){return $this->get_layout_data();});}protected function process_import_ids($content){return \Elementor\Plugin::$instance->db->iterate_data($content,function($element){$element['id']=\Elementor\Utils::generate_random_string();return $element;});}protected function process_import_content($content,$method){return \Elementor\Plugin::$instance->db->iterate_data($content,function($element_data)use($method){$element=\Elementor\Plugin::$instance->elements_manager->create_element_instance($element_data);if(!$element){return null;}$r=$this->process_import_element($element,$method);return $r;});}protected function process_import_element($element,$method){$element_data=$element->get_data();if(method_exists($element,$method)){$element_data=$element->{$method}($element_data);}foreach($element->get_controls()as $control){$control_class=\ELementor\Plugin::$instance->controls_manager->get_control($control['type']);if(!$control_class){return $element_data;}if(method_exists($control_class,$method)){$element_data['settings'][$control['name']]=$control_class->{$method}($element->get_settings($control['name']),$control);}}return $element_data;}}