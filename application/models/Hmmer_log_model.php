<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Hmmer_log_model
 */
class Hmmer_log_model extends CI_Model
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
	public function index($ip, $directory)
	{
		$data = array(
			'ip' => $ip,
			'directory' => $directory
		);

		return $this->db->insert('hmmer_log', $data);
	}
}
