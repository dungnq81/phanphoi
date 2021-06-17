<?php defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/**
 * Class Auth
 *
 * @property User_model $user_model
 * @property Setting $setting
 * @property PHPMailer_lib $phpmailer_lib
 */
class Auth extends Library {

	public $user_activation = 'auto';
	public $unique_phone = true;

	/**
	 * Auth constructor.
	 *
	 * @param array $config
	 */
	public function __construct( $config = [] ) {

		$this->load->model( 'user_model' );
		$this->load->library( 'phpmailer_lib' );
		$this->lang->load( 'ion_auth' );
		$this->lang->load( 'auth' );

		// Mapping to User_model class
		// enable call directly a func of User_m class from Auth class
		$this->class = $this->user_model;

		$this->unique_phone = $this->user_model->unique_phone;

		// user_activation_method
		if ( is_string( $activation = $config['user_activation_method'] ) ) {
			// auto|email|none
			if ( in_array( $activation, [ 'auto', 'email', 'none' ] ) ) {
				$this->user_activation = $activation;
			}
		}
	}

	/**
	 * @param $identity
	 * @param $password
	 * @param bool $remember
	 *
	 * @return bool
	 * @throws Exception
	 */
	public function login( $identity, $password, $remember = false ) {
		if ( $this->user_model->login( $identity, $password, $remember ) ) {
			$this->set_message( __( 'login_successful' ) );

			return true;
		}

		$this->set_error( __( 'login_unsuccessful' ) );

		return false;
	}

	/**
	 * @param $email
	 *
	 * @return bool
	 * @throws Exception
	 */
	public function forgotten_password( $email ) {
		if ( $this->user_model->forgotten_password( $email ) ) {
			// Get user information
			$user = $this->user_model->user( $email )->row();
			if ( $user and $user->active == 1 ) {
				$data = [
					'email'          => $user->email,
					'forgotten_code' => $user->forgotten_code
				];

				$message_content = $this->load->view( 'auth/email/forgot_password.tpl.php', $data, true );
				$this->email->clear();
				$this->email->from( $this->setting->server_email, $this->setting->blogname );
				$this->email->to( $user->email );
				$this->email->subject( $this->setting->blogname . ' - ' . __( 'email_forgotten_password_subject' ) );
				$this->email->message( $message_content );
				if ( $this->email->send() ) {
					$this->set_message( __( 'forgot_password_successful' ) );

					return true;
				}
			}
		}

		$this->set_error( __( 'forgot_password_unsuccessful' ) );

		return false;
	}

	/**
	 * @param $email
	 * @param null $password
	 * @param null $phone
	 * @param null $fullname
	 *
	 * @return bool|int
	 * @throws \PHPMailer\PHPMailer\Exception
	 */
	public function add_user( $email, $password = null, $phone = null, $fullname = null ) {
		$id = $this->user_model->add_user( $email, $password, $phone, $fullname );
		if ( $id !== false ) {
			if ( $this->user_activation !== 'email' ) {
				if ( $this->user_activation === 'auto' ) {
					$this->set_message( __( 'account_creation_successful' ) );
					$this->user_model->activate( $id );
				} else if ( $this->user_activation === 'none' ) {
					$this->user_model->deactivate( $id, false );
				}

				return $id;
			}

			if ( is_array( $email ) and array_key_exists( 'email', $email ) ) {
				$email = $email['email'];
			}

			if ( $email == false ) {
				$this->set_error( __( 'account_creation_unsuccessful' ) );
				return false;
			}

			//
			$this->user_model->deactivate( $id );
			$user = $this->user_model->user( $id )->row();
			$data = [
				'email'      => $email,
				'id'         => $user->id,
				'activation' => $user->activation_code,
			];

			$message = $this->load->view( 'auth/email/activate.tpl.php', $data, true );
			$bool = $this->phpmailer_lib->send_mail([
				'to' => $email,
				'subject' => $this->setting->blogname . ' - ' . __( 'email_activation_subject' ),
				'content' => $message
			]);

			if ($bool) {
				$this->set_message( __( 'account_creation_email_activate' ) );
				return $id;
			}
		}

		$this->set_error( __( 'account_creation_unsuccessful' ) );
		return false;
	}
}

/* end of file */
