<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Environment_amp_model
 */
class Environment_amp_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * @param $environment
	 * @return mixed
	 */
	public function index($environment)
	{
		$this->db->select('*');
		$this->db->from('environment_amp');
		$this->db->where('Environment', $environment);
		return $this->db->get()->result_array();
	}
}
