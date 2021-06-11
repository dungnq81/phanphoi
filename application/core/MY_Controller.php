<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/**
 * Class MY_Controller
 *
 * @property CI_Benchmark $benchmark
 * @property CI_Router $router
 * @property CI_Input $input
 *
 * @property MY_Config $config
 */
class MY_Controller extends CI_Controller {
	/**
	 * The name of the controller class for the current class instance.
	 *
	 * @var string
	 */
	public $controller;

	/**
	 * The name of the method for the current request.
	 *
	 * @var string
	 */
	public $method;

	/**
	 * The sub-directory (if any) that contains the requested controller class.
	 *
	 * @var string
	 */
	public $directory;

	/**
	 * MY_Controller constructor.
	 */
	public function __construct() {
		parent::__construct();

		$this->benchmark->mark( 'my_controller_start' );

		$this->load->library('asset');

		// add addon asset path and set base url
		Asset::add_path( 'assets', site_url( 'assets/' ) );
		Asset::set_url( base_url() );

		//$this->output->set_header('Content-Type: text/html; charset=UTF-8');
		//$this->output->enable_profiler(TRUE);
		$this->benchmark->mark( 'my_controller_end' );
	}
}

/* PHP5 spl_autoload */
spl_autoload_register( '_autoload' );

/**
 * Returns the CodeIgniter object.
 *
 * Example: ci()->db->get('table');
 *
 * @return \CI_Controller
 */
function &ci() {
	return get_instance();
}

/**
 * Library base autoload for core class and libraries extends
 *
 * @param $class
 */
function _autoload( $class ) {
	// don't autoload CI_ prefixed classes
	// or those using the config subclass_prefix
	if ( strstr( $class, 'CI_' ) or strstr( $class, config_item( 'subclass_prefix' ) ) ) {
		return;
	}

	// autoload core classes
	if ( is_file( $location = APPPATH . 'core/' . ucfirst( $class ) . '.php' ) ) {
		include_once $location;
		return;
	}
}
