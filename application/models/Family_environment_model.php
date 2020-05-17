<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Family_environment_model
 */
class Family_environment_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * @param $familyId
	 * @return mixed
	 */
	public function getByFamilyID($familyId)
	{
		$this->db->select('*');
		$this->db->from('family_environment');
		$this->db->where('Family_ID', $familyId);
		return $this->db->get()->result_array();
	}

	/**
	 * @param $environment
	 * @return mixed
	 */
	public function count($environment)
	{
		$this->db->select('*');
		$this->db->from('family_environment');
		$this->db->where('Environment', $environment);
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
		$this->db->from('family_environment');
		$this->db->join('family_amp', 'family_amp.Family_ID=family_environment.Family_ID', 'left');
		$this->db->where('Environment', $environment);
		$this->db->limit($pageSize, ($currentPage - 1) * $pageSize);
		return $this->db->get()->result_array();
	}
}
