<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Hmmer_db_model
 */
class Hmmer_db_model extends CI_Model
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
		$this->db->from('hmmer_db');
		return $this->db->get()->result_array();
	}
}
