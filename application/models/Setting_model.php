<?php defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/**
 * Class Setting_m
 *
 * Allows for an easy interface for site settings
 */
class Setting_model extends MY_Model {
	/**
	 * @var string
	 */
	protected $_table = 'hd_option';

	/**
	 * Get
	 *
	 * Gets a setting based on the $where param.  $where can be either a string
	 * containing a slug name or an array of WHERE options.
	 *
	 * @access    public
	 *
	 * @param mixed $where
	 *
	 * @return mixed
	 */
	public function get( $where ) {
		if ( ! is_array( $where ) ) {
			$where = [ 'name' => $where ];
		}

		return $this->db->select( '*, IF(`value` = "", `default_value`, `value`) AS `value`', false )
		                ->where( $where )
		                ->get( $this->_table )
		                ->row();
	}

	/**
	 * Get Many By
	 *
	 * Gets all settings based on the $where param.
	 *
	 * @access    public
	 *
	 * @param mixed $where
	 *
	 * @return array
	 */
	public function get_many_by( $where = [] ) {
		if ( ! is_array( $where ) ) {
			$where = [ 'name' => $where ];
		}

		return $this->db->select( '*, IF(`value` = "", `default_value`, `value`) AS `value`', false )
		                ->where( $where )
		                ->order_by( 'id', 'DESC' )
		                ->get( $this->_table )
		                ->result();
	}

	/**
	 * Update
	 *
	 * Updates a setting for a given $slug.
	 *
	 * @access    public
	 *
	 * @param string $slug
	 * @param array $params
	 * @param bool $skip_validation
	 *
	 * @return    bool
	 */
	public function update( $slug = '', $params = [], $skip_validation = false ) {
		return $this->db->update( $this->_table, $params, [ 'name' => $slug ] );
	}
}
