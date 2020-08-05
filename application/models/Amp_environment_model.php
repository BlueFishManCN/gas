<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Amp_environment_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function index($ampId)
	{
		$this->db->select('*');
		$this->db->from('amp_environment');
		$this->db->where('AMP_ID', $ampId);
		return $this->db->get()->result_array();
	}

	public function countSequence($environment)
	{
		$this->db->select('*');
		$this->db->from('amp_environment');
		$this->db->where($environment . ' >', 0);
		return $this->db->count_all_results();
	}

	public function countFamily($environment)
	{
		$this->db->select('amp_family.Family_ID');
		$this->db->from('amp_environment');
		$this->db->join('amp_family', 'amp_family.AMP_ID=amp_environment.AMP_ID', 'left');
		$this->db->where($environment . ' >', 0);
		$this->db->distinct();
		return $this->db->count_all_results();
	}

	public function getByEnvironment($environment, $pageSize, $currentPage)
	{
		$this->db->select('*');
		$this->db->from('amp_environment');
		$this->db->join('amp_family', 'amp_family.AMP_ID=amp_environment.AMP_ID', 'left');
		$this->db->where($environment . ' >', 0);
		$this->db->limit($pageSize, ($currentPage - 1) * $pageSize);
		return $this->db->get()->result_array();
	}

	public function getByFamilyID($familyId)
	{
		return $this->db->query('SELECT af.Family_ID, SUM( ae.Freshwater ) AS Freshwater, SUM( ae.Gut ) AS Gut, SUM( ae.Marine ) AS Marine, SUM( ae.Milk ) AS Milk, SUM( ae.Oral_Cavity ) AS Oral_Cavity, SUM( ae.Respiratory_Tract ) AS Respiratory_Tract, SUM( ae.Skin ) AS Skin, SUM( ae.Soil ) AS Soil, SUM( ae.Surface ) AS Surface, SUM( ae.Vagina ) AS Vagina, SUM( ae.Wastewater ) AS Wastewater FROM amp_family AS af LEFT JOIN amp_environment AS ae ON af.AMP_ID = ae.AMP_ID WHERE Family_ID = "' . $familyId . ' "')->result_array();
	}

	public function getByEnvironmentForFamily($environment, $pageSize, $currentPage)
	{
		return $this->db->query('SELECT Family_ID, COUNT( AMP_ID ) AS AMP_Count, AVG( Length ) AS Length_Avg FROM amp_family WHERE Family_ID IN ( SELECT Family_ID FROM amp_family AS af LEFT JOIN amp_environment AS ae ON af.AMP_ID = ae.AMP_ID WHERE ' . $environment . ' > 0 ) GROUP BY Family_ID LIMIT ' . ($currentPage - 1) * $pageSize . ',' . $pageSize)->result_array();
	}
}
