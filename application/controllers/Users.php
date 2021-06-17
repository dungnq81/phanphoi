<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/**
 * Class Users
 *
 * @property MY_Form_validation $form_validation
 * @property Auth $auth
 * @property CI_Session $session
 * @property MY_Lang $lang
 * @property Page_model $page_model
 */
class Users extends MY_Controller {

	public $data = [];

	private array $_login_validation_rules;
	private array $_register_validation_rules;

	/**
	 * Users constructor.
	 */
	public function __construct() {
		parent::__construct();
		$this->current_user = $this->auth->user()->row();

		$this->load->libraries( [
			'email',
			'form_validation',
			'functions',
			'xulychuoi',
			'Md5_system',
			'Ajax_pagination',
			'pagination',
			'cart',
			'Phpmailer_lib'
		] );
		$this->load->model( "page_model" );
		$this->load->helper( 'form' );
		$this->lang->load( 'auth' );

		// login validation
		$this->_login_validation_rules = [
			[
				'field' => 'identity',
				'label' => __( 'login_identity_label' ),
				'rules' => 'trim|required|min_length[6]|callback__check_login_callback'
			],
			[
				'field' => 'password',
				'label' => __( 'login_password_label' ),
				'rules' => 'trim|required|min_length[3]'
			]
		];

		// register validation
		$this->_register_validation_rules = [
			[
				'field' => 'email',
				'label' => __( 'create_user_email_label' ),
				'rules' => 'trim|required|min_length[6]|valid_email|is_unique[' . $this->auth->table_name() . '.email]|callback__email_check',
			],
			[
				'field' => 'phone',
				'label' => __( 'create_user_phone_label' ),
				'rules' => $this->auth->unique_phone ? 'trim|required|min_length[6]|callback__phone_check' : 'trim|min_length[6]',
			],
			[
				'field' => 'password',
				'label' => __( 'create_user_password_label' ),
				'rules' => 'trim|required|min_length[3]'
			],
			[
				'field' => 'password_confirm',
				'label' => __( 'create_user_password_confirm_label' ),
				'rules' => 'trim|required|matches[password]'
			]
		];
	}

	/**
	 * Method to register a new user
	 */
	public function register() {
		$this->data['title'] = __( 'create_user_heading' );
		$this->data['class'] = 'register-form identity-form';

		if ( $this->current_user ) {
			$this->session->set_flashdata( 'notice', __( 'already_logged_in' ) );
			redirect( 'users/profile' );
		}

		// Set the validation rules
		$this->form_validation->set_rules( $this->_register_validation_rules );

		$_data = [
			'fullname' => $this->input->post( 'fullname' ),
			'email'    => strtolower( $this->input->post( 'email' ) ),
			'phone'    => $this->input->post( 'phone' ),
			'password' => $this->input->post( 'password' ),
			'points'   => 0,
		];

		if ( $this->form_validation->run() === true && $this->auth->add_user( $_data ) ) {

			// check to see if we are creating the user
			$this->session->set_flashdata( 'message', $this->auth->messages() );
		}

		// display the create user form
		// set the flash data error message if there is one
		$this->data['message'] = ( validation_errors() ?: ( $this->auth->errors() ?: $this->session->flashdata( 'message' ) ) );

		$this->_render_page( 'content/partials/header' );
		$this->_render_page( 'auth/create_user', $this->data );
		$this->_render_page( 'content/partials/footer' );
	}

	/**
	 * Login
	 */
	public function login() {
		$this->data['class'] = 'login-form identity-form';
		if ( is_ajax_request() ) {
			$this->data['class'] = 'login-form identity-form ajax-login';
		}

		// Check post and session for the redirect place
		$redirect_to = ( $this->input->post( 'redirect_to' ) )
			? trim( urldecode( $this->input->post( 'redirect_to' ) ) )
			: $this->session->userdata( 'redirect_to' );

		// Call validation and set rules
		$this->form_validation->set_rules( $this->_login_validation_rules );

		// If the validation worked, or the user is already logged in
		if ( $this->current_user || $this->form_validation->run() ) {

			// Kill the session
			$this->session->unset_userdata( 'redirect_to' );
			if ( ! is_ajax_request() ) {
				redirect( $redirect_to ?: '/' );
			}
		}

		$this->data['title']   = __( 'login_heading' );
		$this->data['message'] = validation_errors();

		if ( ! is_ajax_request() ) {
			$this->_render_page( 'content/partials/header' );
		}
		$this->_render_page( 'auth/login', $this->data );
		if ( ! is_ajax_request() ) {
			$this->_render_page( 'content/partials/footer' );
		}
	}

	/**
	 * ajax_login
	 */
	public function ajax_login() {
		if ( ! is_ajax_request() ) {
			return;
		}

		// Call validation and set rules
		$this->form_validation->set_rules( $this->_login_validation_rules );

		// If the validation worked, or the user is already logged in
		if ( $this->current_user || $this->form_validation->run() === true ) {
			die( json_encode( [ 'status' => 'success', 'message' => __( 'login_successful' ) ] ) );
		}

		die( json_encode( [ 'status' => 'error', 'message' => validation_errors() ] ) );
	}

	/**
	 * Logout
	 */
	public function logout() {

		$this->auth->logout();
		$this->session->set_flashdata( 'success', __( "logged_out" ) );

		// if they were trying to go someplace besides the dashboard we'll have stored it in the session
		$_redirect = $this->session->userdata( '_redirect' );
		$this->session->unset_userdata( '_redirect' );
		redirect( $_redirect ?: 'users/login' );
	}

	/**
	 * Callback From: login()
	 *
	 * @param string $identity The identity to validate
	 *
	 * @return bool
	 * @throws Exception
	 */
	public function _check_login_callback( $identity ) {

		// recapcha
		//$_verify = recaptcha_verify( $this->input->post( 'g-recaptcha-response' ) );
		//if ( $_verify ) {
		if ( $this->auth->login( $identity, $this->input->post( 'password' ), str_to_bool( $this->input->post( 'remember' ) ) ) ) {
			return true;
		} else {
			$this->form_validation->set_message( __FUNCTION__, $this->auth->errors() );

			return false;
		}
		//}

		//$this->form_validation->set_message( __FUNCTION__, __( "something_went_wrong" ) );
		//return false;
	}

	/**
	 * Email check
	 *
	 * @param string $email The email to check.
	 *
	 * @return bool
	 * @author Ben Edmunds
	 *
	 */
	public function _email_check( $email ) {
		if ( ! $this->auth->email_check( $email ) ) {
			$this->form_validation->set_message( '_email_check', __( 'error_email' ) );

			return false;
		}

		return true;
	}

	/**
	 * Phone check
	 *
	 * @param string $phone The phone to check.
	 */
	public function _phone_check( $phone ) {
		if ( ! $this->auth->phone_check( $phone ) ) {
			$this->form_validation->set_message( '_phone_check', __( 'error_phone' ) );

			return false;
		}

		return true;
	}

	/**
	 * @param $view
	 * @param null $data
	 * @param false $returnhtml
	 *
	 * @return object|string|void
	 */
	private function _render_page( $view, $data = null, $returnhtml = false ) {
		$viewdata  = ( empty( $data ) ) ? $this->data : $data;
		$view_html = $this->load->view( $view, $viewdata, $returnhtml );

		// This will return html on 3rd argument being true
		if ( $returnhtml ) {
			return $view_html;
		}
	}
}
