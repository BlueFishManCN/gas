<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Amp_db_model
 */
class Amp_db_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * @return mixed
	 */
	public function index()
	{
		$this->db->select('*');
		$this->db->from('amp_db');
		return $this->db->get()->result_array();
	}
}
