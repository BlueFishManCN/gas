<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Blast_log_model
 */
class Blast_log_model extends CI_Model
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

		return $this->db->insert('blast_log', $data);
	}
}
