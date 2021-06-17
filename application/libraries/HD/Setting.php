<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/**
 * Setting Library. Allows for an easy interface for site settings
 *
 * @author Dan Horrigan <dan@dhorrigan.com>
 * @author nqdung <quocdung@vietnhan.net>
 *
 */
class Setting {
	/**
	 * Setting cache
	 *
	 * @var    array
	 */
	private $_cache = [];

	/**
	 * The settings table columns
	 *
	 * @var    array
	 */
	private $_columns = [
		'title',
		'name',
		'default_value',
		'value',
		'trangthai',
		'options'
	];

	/**
	 * Setting constructor.
	 */
	public function __construct() {
		ci()->load->model( 'setting_model' );
	}

	/**
	 * Getter
	 *
	 * Gets the setting value requested
	 *
	 * @param string $name
	 *
	 * @return bool
	 */
	public function __get( $name ) {
		return $this->get( $name );
	}

	/**
	 * Setter
	 *
	 * Sets the setting value requested
	 *
	 * @param string $name
	 * @param string $value
	 *
	 * @return    bool
	 */
	public function __set( $name, $value ) {
		return $this->set( $name, $value );
	}

	/**
	 * Get
	 *
	 * Gets a setting.
	 *
	 * @param string $name
	 *
	 * @return    bool
	 */
	public function get( $name ) {
		if ( isset( $this->_cache[ $name ] ) ) {
			return $this->_cache[ $name ];
		}

		$setting = ci()->setting_model->get( $name );

		// Setting doesn't exist, maybe it's a config option
		$value = $setting ? $setting->value : config_item( $name );

		// Store it for later
		$this->_cache[ $name ] = $value;
		return $value;
	}

	/**
	 * Set
	 *
	 * Sets a config item
	 *
	 * @param string $name
	 * @param string $value
	 *
	 * @return    bool
	 */
	public function set( $name, $value ) {
		if ( $name ) {
			if ( is_scalar( $value ) ) {
				ci()->setting_model->update( $name, [ 'value' => $value ] );
			}

			$this->_cache[ $name ] = $value;

			return true;
		}

		return false;
	}

	/**
	 * Temp
	 *
	 * Changes a setting for this request only. Does not modify the database
	 *
	 * @param string $name
	 * @param string $value
	 *
	 * @return void
	 */
	public function temp( $name, $value ) {
		// store the temp value in the cache so that all subsequent calls
		// for this request will use it instead of the database value
		$this->_cache[ $name ] = $value;
	}

	/**
	 * All
	 *
	 * Gets all the settings
	 *
	 * @return    array
	 */
	public function get_all() {
		if ( $this->_cache ) {
			return $this->_cache;
		}

		$settings = ci()->setting_model->get_many_by();
		foreach ( $settings as $setting ) {
			$this->_cache[ $setting->name ] = $setting->value;
		}

		return $this->_cache;
	}

	/**
	 * Add Setting
	 *
	 * Adds a new setting to the database
	 *
	 * @param array $setting
	 *
	 * @return    int
	 */
	public function add( $setting ) {
		if ( ! $this->_check_format( $setting ) ) {
			return false;
		}

		return ci()->setting_model->insert( $setting );
	}

	/**
	 * Delete Setting
	 *
	 * Deletes setting to the database
	 *
	 * @param string $name
	 *
	 * @return    bool
	 */
	public function delete( $name ) {
		return ci()->setting_model->delete_by( [ 'name' => $name ] );
	}

	/**
	 * Check Format
	 *
	 * This assures that the setting is in the correct format.
	 * Works with arrays or objects (it is PHP 5.3 safe)
	 *
	 * @param array $setting
	 *
	 * @return    bool    If the setting is the correct format
	 */
	private function _check_format( $setting ) {
		if ( ! isset( $setting ) ) {
			return false;
		}
		foreach ( $setting as $key => $value ) {
			if ( ! in_array( $key, $this->_columns ) ) {
				return false;
			}
		}

		return true;
	}
}
