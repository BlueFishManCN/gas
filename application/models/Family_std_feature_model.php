<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Family_std_feature_model
 */
class Family_std_feature_model extends CI_Model
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
	public function index($familyId)
	{
		$this->db->select('*');
		$this->db->from('family_std_feature');
		$this->db->where('Family_ID', $familyId);
		return $this->db->get()->result_array();
	}
}
