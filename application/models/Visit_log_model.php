<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Visit_log_model
 */
class Visit_log_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * @param $ip
	 * @return mixed
	 */
	public function index($ip)
	{
		$data = array(
			'ip' => $ip,
		);

		return $this->db->insert('visit_log', $data);
	}

	/**
	 * @return mixed
	 */
	public function count()
	{
		return $this->db->count_all('visit_log');
	}
}
