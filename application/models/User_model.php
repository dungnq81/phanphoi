<?php
/** @noinspection ALL */
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/**
 * Class User_model
 * @property MY_Config $config
 * @property MY_Lang $lang
 * @property MY_Loader $load
 */
class User_model extends MY_Model {

	protected $_table = 'hd_users';

	private $_algorithm_password = PASSWORD_DEFAULT;
	private $_options_password = [];

	protected $_cache_users = [];
	public $unique_phone = true;

	private $_hash_prefix = '$W$';

	// ------------------------------------------

	/**
	 * Users_model constructor.
	 */
	public function __construct() {

		parent::__construct();

		$this->load->config( 'auth', true );

		// unique_phone
		if ( is_bool( $this->config->item( 'unique_phone', 'auth' ) ) ) {
			$this->unique_phone = $this->config->item( 'unique_phone', 'auth' );
		}

		// PASSWORD_DEFAULT
		// Use the bcrypt algorithm (default as of PHP 5.5.0).
		// Note that this constant is designed to change over time as new and stronger algorithms are added to PHP.
		// For that reason, the length of the result from using this identifier can change over time.
		$this->_algorithm_password = PASSWORD_DEFAULT;
		$this->_options_password   = [];

		// PASSWORD_BCRYPT
		// The salt option has been deprecated as of PHP 7.0.0.
		/*$this->_algorithm_password = PASSWORD_BCRYPT;
		$this->_options_password = [
			'cost' => PASSWORD_BCRYPT_DEFAULT_COST
		];*/

		// PASSWORD_ARGON2I | PASSWORD_ARGON2ID
		// Argon2 passwords using PASSWORD_ARGON2I was added in PHP 7.2.0
		// Argon2 passwords using PASSWORD_ARGON2ID was added in PHP 7.3.0
		//$this->_algorithm_password = PASSWORD_ARGON2ID;
		//$this->_options_password = [
		//	'memory_cost' => PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
		//	'time_cost' => PASSWORD_ARGON2_DEFAULT_TIME_COST,
		//	'threads' => PASSWORD_ARGON2_DEFAULT_THREADS
		//];
	}

	// ------------------------------------------

	/**
	 * @param $user_id
	 *
	 * @return bool|mixed
	 */
	public function user_session( $user_id ) {
		if ( ! is_numeric( $user_id ) ) {
			return false;
		}

		$this->_select_join();
		$query = $this->db
			->where( $this->_table . '.id', $user_id )
			->get( $this->_table, 1 );

		// check exist
		if ( $query->num_rows() < 1 ) {
			return false;
		}

		return $this->_cache_users[ $user_id ] = $query;
	}

	// ------------------------------------------

	/**
	 * Auto logs-in the user if they are remembered
	 *
	 * @return bool Whether the user is logged in
	 * @throws Exception
	 */
	public function logged_in() {
		$user_id = $this->session->userdata( "user_id" );
		if ( ! $user_id ) {
			return $this->_login_remembered_user();
		}

		// check exist
		if ( ! $this->user_session( $user_id ) ) {
			$this->logout( false );

			return false;
		}

		return true;
	}

	// ------------------------------------------

	/**
	 * @return bool
	 */
	private function _login_remembered_user() {
		// check for valid cookie
		$user_id       = get_cookie( 'user_id' );
		$remember_code = get_cookie( 'user_remember_code' );
		if ( empty( $remember_code ) || ! $this->user_session( $user_id ) ) {
			return false;
		}

		$user = $this->user( $user_id )->row();
		if ( strcmp( $user->status, 'Active' ) === 0 and strcmp( $user->remember_code, $remember_code ) === 0 ) {
			// update last login time
			$this->_update_last_login( $user );
			$this->session->set_userdata( [
				'user_id'         => $user_id,
				'user_login_time' => now(),
			] );

			//extend the users cookies if the option is enabled
			if ( $this->config->item( 'remember_extend_on_login', 'auth' ) ) {
				$this->_remember_user( $user );
			}

			return true;
		}

		delete_cookie( 'user_id' );
		delete_cookie( 'user_remember_code' );

		return false;
	}

	// ------------------------------------------

	/**
	 * @param object $user
	 */
	private function _remember_user( object $user ) {
		if ( isset( $user->id ) ) {
			set_cookie( [
				'name'   => 'user_id',
				'value'  => $user->id,
				'expire' => $this->config->item( 'remember_expire', 'auth' )
			] );
			set_cookie( [
				'name'   => 'user_remember_code',
				'value'  => $user->remember_code,
				'expire' => $this->config->item( 'remember_expire', 'auth' )
			] );
		}
	}

	// ------------------------------------------

	/**
	 * @param $identity
	 * @param $password
	 * @param bool $remember
	 *
	 * @return bool
	 * @throws Exception
	 */
	public function login( $identity, $password, $remember = false ) {
		if ( ! $identity or ! $password ) {
			return false;
		}

		$identity = $this->db->escape_str( $identity );
		$where_c  = sprintf( 'email = "%1$s"', $identity );

		if ( $this->unique_phone ) {
			$where_c = sprintf( '(email = "%1$s" OR phone = "%1$s")', $identity );
		}

		$query = $this->db->where( $where_c )
		                  ->where( 'status', 'Active' )
		                  ->get( $this->_table, 1 );

		if ( $query->num_rows() === 1 ) {
			$user = $query->row();

			// Verify stored hash against plain-text password
			if ( $this->_verify_password( $password, $user->id ) ) {
				$this->_set_login( $user, (bool) $remember );

				return true;
			}
		}

		return false;
	}

	// ------------------------------------------

	/**
	 * Hashes the password to be stored in the database.
	 *
	 * @param $password
	 *
	 * @return bool|string
	 */
	private function _hash_password( $password ) {
		if ( empty( $password ) ) {
			return false;
		}

		// default PASSWORD_DEFAULT
		//return password_hash( $password, $this->_algorithm_password, $this->_options_password );
		return $this->_hash_prefix . base64_encode( password_hash( $password, $this->_algorithm_password, $this->_options_password ) );
	}

	// ------------------------------------------

	/**
	 * @param $password
	 * @param $user_id
	 *
	 * @return bool
	 */
	private function _verify_password( $password, $user_id ) {
		$user = $this->user( $user_id )->row();
		if ( ! $user ) {
			return false;
		}

		$check = password_verify( $password, base64_decode( substr( $user->password, strlen( $this->_hash_prefix ) ) ) );

		return $check ? true : false;
	}

	// ------------------------------------------

	/**
	 * Used by login() function
	 *
	 * @param $user
	 * @param bool $remember
	 * @param bool $log
	 *
	 * @throws Exception
	 */
	private function _set_login( $user, bool $remember = false, $log = false ) {
		$this->_update_last_login( $user );
		$this->session->set_userdata( [
			'user_id'         => $user->id,
			'user_login_time' => now(),
		] );

		if ( $remember == true && $this->config->item( 'remember_users', 'auth' ) ) {
			if ( empty( $user->remember_code ) ) {
				$this->update( $user->id, [ 'remember_code' => $this->salt() ] );
			}

			// save cookie
			$this->_remember_user( $user );
		}
	}

	/**
	 * @param bool $log
	 */
	public function logout( $log = false ) {
		if ( $user_id = $this->session->userdata( 'user_id' ) ) {
			$this->session->unset_userdata( [
				'user_id',
				'user_login_time',
			] );

			// delete the cookies if they exist
			delete_cookie( 'user_id' );
			delete_cookie( 'user_remember_code' );

			// remove remember code, remove on all devices
			$this->update( $user_id, [ 'remember_code' => null ] );

			// Destroy the current session when it is called
			//$this->session->sess_destroy();
			//$this->session->sess_regenerate( true );
		}
	}

	// ------------------------------------------

	/**
	 * @param null $limit
	 * @param null $offset
	 *
	 * @return mixed
	 */
	public function users( $limit = null, $offset = null ) {
		// select join
		$this->_select_join();

		return $this->db->get( $this->_table, $limit, $offset );
	}

	// ------------------------------------------

	/**
	 * @param null $id
	 *
	 * @return CI_DB_result
	 */
	public function user( $id = null ) {
		// Don't grab the user data again if we already have it
		if ( is_numeric( $id ) and isset( $this->_cache_users[ $id ] ) ) {
			return $this->_cache_users[ $id ];
		}

		$pair = $this->_identity_pair( $id );
		$this->db->where( sprintf( '%s.%s', $this->_table, $pair['identity'] ), $pair['value'] );
		$this->db->limit( 1 );

		$user = $this->users();
		if ( is_numeric( $id ) ) {
			$this->_cache_users[ $id ] = $user;
		}

		// the user disappeared for a moment?
		if ( $user->num_rows() < 1 && $pair['user_is_current'] ) {
			log_message( 'error', sprintf( 'End user session - reason: Could not find a user identified by %s:%s', [
				$pair['identity'],
				$pair['value']
			] ) );
			$this->session->sess_destroy();
		}

		return $user;
	}

	// ------------------------------------------

	/**
	 * @param $id
	 * @param array $data
	 *
	 * @return bool
	 */
	public function update_user( $id, array $data = [] ) {
		$this->db->trans_start();

		// Filter the data passed
		$data = $this->filter_data( $this->_table, $data );

		// email
		if ( array_key_exists( 'email', $data ) and ! $this->email_update_check( $id, $data['email'] ) ) {
			unset( $data['email'] );
		}

		// phone
		if ( array_key_exists( 'phone', $data ) ) {
			if ( ! $this->phone_update_check( $id, $data['phone'] ) ) {
				unset( $data['phone'] );
			} else {
				$data['verified_phone'] = verified_phone( $data['phone'] );
			}
		}

		if ( array_key_exists( 'password', $data ) ) {
			if ( ! empty( $data['password'] ) ) {
				$data['password'] = $this->_hash_password( $data['password'] );
			} else {
				// unset password so it doesn't effect database entry if no password passed
				unset( $data['password'] );
			}
		}

		$data['updated_at'] = now();
		$this->update( $id, $data );
		$this->db->trans_complete();

		return ( $this->db->trans_status() === false ) ? false : true;
	}

	// ------------------------------------------

	/**
	 * @param $id
	 *
	 * @return bool
	 */
	public function delete_user( $id ) {
		$this->db->trans_start();

		// delete user from users table should be placed after remove from group
		$this->delete( $id );

		$this->db->trans_complete();

		return ( $this->db->trans_status() === false ) ? false : true;
	}

	// ------------------------------------------

	/**
	 * @param $email
	 * @param null $password
	 * @param null $phone
	 * @param null $fullname
	 *
	 * @return bool|int
	 */
	public function add_user( $email, $password = null, $phone = null, $fullname = null ) {
		$this->db->trans_start();

		// is array
		if ( is_array( $email ) ) {
			// Filter the data passed
			$data = $this->filter_data( $this->_table, $email );
			if ( ! array_key_exists( 'email', $data ) || ! $this->email_check( $data['email'] ) ) {
				return false;
			}

			if ( $this->unique_phone == true ) {
				if ( ! array_key_exists( 'phone', $data ) || ! $this->phone_check( $data['phone'] ) ) {
					return false;
				}
			}
			if ( ! array_key_exists( 'password', $data ) || empty( $data['password'] ) ) {
				return false;
			}

			if ( array_key_exists( 'phone', $data ) ) {
				$data['verified_phone'] = verified_phone( $data['phone'] );
			}

			$data['password']   = $this->_hash_password( $data['password'] );
			$data['ip_address'] = $this->input->ip_address();
			$data['created_at'] = now();
			$data['updated_at'] = now();
			$insert_id          = $this->insert( $data );

			$this->db->trans_complete();

			return ( $this->db->trans_status() === false ) ? false : $insert_id;
		}

		//
		// is string
		//
		if ( empty( $password ) || ! $this->email_check( $email ) || ! $this->phone_check( $phone ) ) {
			return false;
		}

		$dummy = [
			'fullname'       => $fullname,
			'password'       => $this->_hash_password( $password ),
			'email'          => $email,
			'phone'          => $phone,
			'verified_phone' => verified_phone( $phone ),
			'ip_address'     => $this->input->ip_address(),
			'created_at'     => now(),
			'updated_at'     => now(),
		];

		$insert_id = $this->insert( $dummy );
		$this->db->trans_complete();

		return ( $this->db->trans_status() === false ) ? false : $insert_id;
	}

	// ------------------------------------------

	/**
	 * @param int $limit
	 *
	 * @return mixed
	 */
	public function recent_users( $limit = 10 ) {
		return $this->list_users_order( $limit, 'last_login_time' );
	}

	// ------------------------------------------

	/**
	 * @param int $limit
	 *
	 * @return mixed
	 */
	public function newest_users( $limit = 10 ) {
		return $this->list_users_order( $limit, 'created_at' );
	}

	// ------------------------------------------

	/**
	 * @param int $limit
	 * @param null $groups
	 * @param string $column
	 * @param string $orderby
	 *
	 * @return CI_DB_result
	 */
	public function list_users_order( $limit = 10, $column = 'id', $orderby = 'DESC' ) {
		$column or $column = 'id';
		$orderby or $orderby = 'DESC';

		$this->db->order_by( $this->_table . '.' . $column, $orderby );

		return $this->users( $limit );
	}

	// ------------------------------------------

	/**
	 * @param null $limit
	 * @param null $offset
	 * @param null $groups
	 *
	 * @return CI_DB_result
	 */
	public function active_users( $limit = null, $offset = null ) {
		$this->db->where( $this->_table . '.status', 'Active' );

		return $this->users( $limit, $offset );
	}

	// ------------------------------------------

	/**
	 * @param null $limit
	 * @param null $offset
	 * @param null $groups
	 *
	 * @return CI_DB_result
	 */
	public function inactive_users( $limit = null, $offset = null ) {
		$this->db->where( $this->_table . '.status', 'Inactive' );

		return $this->users( $limit, $offset );
	}

	// ------------------------------------------

	/**
	 * @param null $limit
	 * @param null $offset
	 * @param null $groups
	 *
	 * @return CI_DB_result
	 */
	public function lock_users( $limit = null, $offset = null ) {
		$this->db->where( $this->_table . '.status', 'Lock' );

		return $this->users( $limit, $offset );
	}

	/**
	 * @param string $email
	 *
	 * @return bool
	 */
	public function email_check( $email = '' ) {
		if ( empty( $email ) or ! $this->form_validation->valid_email( $email ) ) {
			return false;
		}

		return $this->db->where( 'email', $email )
		                ->limit( 1 )
		                ->count_all_results( $this->_table ) === 0;
	}

	// ------------------------------------------

	/**
	 * @param $id
	 * @param string $email
	 *
	 * @return bool
	 */
	public function email_update_check( $id, $email = '' ) {
		if ( empty( $id ) or empty( $email ) or ! $this->form_validation->valid_email( $email ) ) {
			return false;
		}

		$this->db->where( 'id <>', $id );
		$this->db->where( 'email', $email );

		return $this->db->limit( 1 )->count_all_results( $this->_table ) === 0;
	}

	// ------------------------------------------

	/**
	 * @param string $phone
	 *
	 * @return bool
	 */
	public function phone_check( $phone = '' ) {
		if ( $this->unique_phone === false ) {
			return true;
		}

		if ( empty( $phone ) ) {
			return false;
		}

		return $this->db->where( 'verified_phone', verified_phone( $phone ) )
		                ->limit( 1 )
		                ->count_all_results( $this->_table ) === 0;
	}

	// ------------------------------------------

	/**
	 * @param $id
	 * @param string $phone
	 *
	 * @return bool
	 */
	public function phone_update_check( $id, $phone = '' ) {
		if ( $this->unique_phone === false ) {
			return true;
		}

		if ( empty( $id ) or empty( $phone ) ) {
			return false;
		}

		$this->db->where( 'id <>', $id );
		$this->db->where( 'verified_phone', verified_phone( $phone ) );

		return $this->db->limit( 1 )->count_all_results( $this->_table ) === 0;
	}

	// ------------------------------------------

	/**
	 * Validates and removes activation code.
	 *
	 * @param int|string $id
	 * @param bool $code
	 *
	 * @return bool
	 */
	public function activate( $id, $code = false ) {
		$dummy = [
			'activation_code' => null,
			'status'          => 'Active',
		];

		if ( $code !== false ) {
			$query = $this->db
				->where( 'activation_code', $code )
				->where( 'id', $id )
				->get( $this->_table, 1 );

			if ( $query->num_rows() == 1 ) {
				$this->update( $id, $dummy );
			}
		} else {
			$this->update( $id, $dummy );
		}

		return $this->db->affected_rows() === 1;
	}

	// ------------------------------------------

	/**
	 * deactivate a user row with an activation code.
	 *
	 * @param int|string|null $id
	 *
	 * @param bool $init_code
	 *
	 * @return bool
	 * @throws Exception
	 */
	public function deactivate( $id = null, $init_code = true ) {
		if ( ! isset( $id ) or $this->user()->row()->id == $id ) {
			return false;
		}

		$data['status'] = 'Inactive';
		if ( $init_code === true ) {
			$activation_code         = $this->salt();
			$data['activation_code'] = $activation_code;
		}

		$this->update( $id, $data );

		return $this->db->affected_rows() === 1;
	}

	// ------------------------------------------

	/**
	 * @param $code
	 *
	 * @return bool
	 */
	public function delete_forgotten_code( $code ) {
		if ( empty( $code ) ) {
			return false;
		}

		$this->db->where( 'forgotten_code', $code );
		if ( $this->db->count_all_results( $this->_table ) > 0 ) {
			$data = [
				'forgotten_code' => null,
			];

			$this->update_by( 'forgotten_code', $code, $data );

			return true;
		}

		return false;
	}

	// ------------------------------------------

	/**
	 * @param $email
	 * @param $new_password
	 *
	 * @return bool
	 */
	public function reset_password( $email, $new_password ) {
		$query = $this->db->get_where( $this->_table, [ 'email' => $email ], 1 );
		if ( $query->num_rows() < 1 ) {
			return false;
		}

		// store the new password and reset the remember code so all remembered instances have to re-login
		// also clear the forgotten password code
		$user = $query->row();
		$data = [
			'password'       => $this->_hash_password( $new_password ),
			'remember_code'  => null,
			'forgotten_code' => null,
		];

		$this->update( $user->id, $data );

		return $this->db->affected_rows() == 1;
	}

	// ------------------------------------------

	/**
	 * @param $email
	 * @param $old_password
	 * @param $new_password
	 *
	 * @return bool
	 */
	public function change_password( $email, $old_password, $new_password ) {
		$query = $this->db->get_where( $this->_table, [ 'email' => $email ], 1 );
		if ( $query->num_rows() < 1 ) {
			return false;
		}

		$user = $query->row();
		if ( $this->_verify_password( $old_password, $user->id ) ) {
			// store the new password and reset the remember code so all remembered instances have to re-login
			$data = [
				'password'       => $this->_hash_password( $new_password ),
				'remember_code'  => null,
				'forgotten_code' => null,
			];

			$this->update( $user->id, $data );

			return $this->db->affected_rows() == 1;
		}

		return false;
	}

	// ------------------------------------------

	/**
	 * @param $username
	 *
	 * @return bool
	 * @throws Exception
	 */
	public function forgotten_password( $email ) {
		$query = $this->db->get_where( $this->_table, [ 'email' => $email ], 1 );
		if ( $query->num_rows() < 1 ) {
			return false;
		}

		$user   = $query->row();
		$update = [
			'forgotten_code' => $this->salt(),
		];

		$this->update( $user->id, $update );

		return $this->db->affected_rows() == 1;
	}

	// ------------------------------------------

	/**
	 * @param $forgotten_code
	 *
	 * @return array|bool
	 * @throws Exception
	 */
	public function forgotten_password_complete( $forgotten_code ) {
		$query = $this->db->get_where( $this->_table, [ 'forgotten_code' => $forgotten_code ], 1 );
		if ( $query->num_rows() < 1 ) {
			return false;
		}

		$user = $query->row();
		if ( $this->config->item( 'forgot_password_expired', 'auth' ) > 0 ) {
			// Make sure it isn't expired
			$expiration = $this->config->item( 'forgot_password_expired', 'auth' );
			if ( now() - $user->forgotten_code_time > $expiration ) {
				// it has expired
				return false;
			}
		}

		$password = $this->salt( 6 );
		$data     = [
			'password'       => $this->_hash_password( $password ),
			'forgotten_code' => null,
			'remember_code'  => null,
		];

		$this->update( $user->id, $data );

		return ( $this->db->affected_rows() == 1 ) ? [
			'email'    => $user->email,
			'password' => $password
		] : false;
	}

	// ------------------------------------------

	/**
	 * @param null $id
	 *
	 * @return array
	 */
	private function _identity_pair( $id = null ) {
		$_user_is_current = false;

		// args null, get from session
		if ( is_null( $id ) or is_bool( $id ) ) {
			$identity = 'id';
			$id       = $this->session->userdata( "user_id" );

			// we'll use it bellow.. before returning
			$_user_is_current = is_scalar( $id ) && $id
				? [ $id ]    // as bool is true, as array pass the value to log
				: ( $id = null );    // as bool is false and $id is null
		} elseif ( is_scalar( $id ) ) {
			$identity = ( is_numeric( $id ) or empty( $id ) ) ? 'id' : 'email';
		} else {
			$identity = 'email';
			$id       = null;
		}

		return [
			'identity'        => $identity,
			'value'           => $id,
			'user_is_current' => $_user_is_current // array|bool
		];
	}

	// ------------------------------------------

	/**
	 * @param $user
	 *
	 * @return bool
	 */
	private function _update_last_login( $user ) {
		if ( isset( $user->id ) ) {
			$this->update( $user->id, [ 'last_login_time' => now() ] );

			return $this->db->affected_rows() === 1;
		}

		return false;
	}

	// ------------------------------------------

	/**
	 * @return CI_DB_query_builder
	 */
	private function _select_join() {
		$this->db->select( [
			$this->_table . '.*',
			$this->_table . '.id AS ' . $this->db->protect_identifiers( 'user_id' ),
		] );

		// join and then run a where_in against the roles ids
		return $this->db->distinct();
		//return $this->db->join();
	}
}
