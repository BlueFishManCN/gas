<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Amp_environment_model
 */
class Amp_environment_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * @param $ampId
	 * @return mixed
	 */
	public function index($ampId)
	{
		$this->db->select('*');
		$this->db->from('amp_environment');
		$this->db->where('AMP_ID', $ampId);
		return $this->db->get()->result_array();
	}

	/**
	 * @param $environment
	 * @return mixed
	 */
	public function count($environment)
	{
		$this->db->select('*');
		$this->db->from('amp_environment');
		$this->db->where($environment . ' >', 0);
		return $this->db->count_all_results();
	}

	/**
	 * @param $environment
	 * @param $pageSize
	 * @param $currentPage
	 * @return mixed
	 */
	public function getByEnvironment($environment, $pageSize, $currentPage)
	{
		$this->db->select('*');
		$this->db->from('amp_environment');
		$this->db->join('amp_family', 'amp_family.AMP_ID=amp_environment.AMP_ID', 'left');
		$this->db->where($environment . ' >', 0);
		$this->db->limit($pageSize, ($currentPage - 1) * $pageSize);
		return $this->db->get()->result_array();
	}
}
