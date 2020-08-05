<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Amp_family_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function index($ampId)
	{
		$this->db->select('*');
		$this->db->from('amp_family');
		$this->db->where('AMP_ID', $ampId);
		return $this->db->get()->result_array();
	}

	public function read($ampId, $familyId, $environment, $pageSize, $currentPage, $sequence, $minLength, $maxLength, $minpI, $maxpI, $minCharge, $maxCharge)
	{
		$this->db->select('amp_family.*,amp_feature.pI,amp_feature.charge');
		$this->db->from('amp_family');
		$this->db->join('amp_feature', 'amp_family.AMP_ID=amp_feature.AMP_ID', 'left');
		$this->db->join('amp_environment', 'amp_family.Amp_ID=amp_environment.AMP_ID', 'left');
		if ($ampId != '') {
			$this->db->where('amp_family.AMP_ID', $ampId);
		}
		if ($familyId != '') {
			$this->db->where('amp_family.Family_ID', $familyId);
		}
		if (!empty($environment)) {
			foreach ($environment as $value) {
				$this->db->where('amp_environment.' . $value . '>', 0);
			}
		}
		if ($sequence != '') {
			$this->db->like('amp_family.Sequence', $sequence);
		}
		if ($minLength != 1) {
			$this->db->where('amp_family.Length >=', $minLength);
		}
		if ($maxLength != 100) {
			$this->db->where('amp_family.Length <=', $maxLength);
		}
		if ($minpI != 0) {
			$this->db->where('amp_feature.pI >=', $minpI);
		}
		if ($maxpI != 15) {
			$this->db->where('amp_feature.pI <=', $maxpI);
		}
		if ($minCharge != -50) {
			$this->db->where('amp_feature.Charge >=', $minCharge);
		}
		if ($maxCharge != 50) {
			$this->db->where('amp_feature.Charge <=', $maxCharge);
		}

		$this->db->limit($pageSize, ($currentPage - 1) * $pageSize);
		return $this->db->get()->result_array();
	}

	public function count($ampId, $familyId, $environment, $sequence, $minLength, $maxLength, $minpI, $maxpI, $minCharge, $maxCharge)
	{
		$this->db->select('amp_family.*,amp_feature.pI,amp_feature.charge');
		$this->db->from('amp_family');
		$this->db->join('amp_feature', 'amp_family.AMP_ID=amp_feature.AMP_ID', 'left');
		$this->db->join('amp_environment', 'amp_family.Amp_ID=amp_environment.AMP_ID', 'left');
		if ($ampId != '') {
			$this->db->where('amp_family.AMP_ID', $ampId);
		}
		if ($familyId != '') {
			$this->db->where('amp_family.Family_ID', $familyId);
		}
		if ($sequence != '') {
			$this->db->like('amp_family.Sequence', $sequence);
		}
		if (!empty($environment)) {
			foreach ($environment as $value) {
				$this->db->where('amp_environment.' . $value . '>', 0);
			}
		}
		if ($minLength != 1) {
			$this->db->where('amp_family.Length >=', $minLength);
		}
		if ($maxLength != 100) {
			$this->db->where('amp_family.Length <=', $maxLength);
		}
		if ($minpI != 0) {
			$this->db->where('amp_feature.pI >=', $minpI);
		}
		if ($maxpI != 15) {
			$this->db->where('amp_feature.pI <=', $maxpI);
		}
		if ($minCharge != -50) {
			$this->db->where('amp_feature.Charge >=', $minCharge);
		}
		if ($maxCharge != 50) {
			$this->db->where('amp_feature.Charge <=', $maxCharge);
		}
		return $this->db->count_all_results();
	}

	public function getByFamilyID($familyId)
	{
		return $this->db->query('SELECT Family_ID, COUNT(AMP_ID) AS AMP_Count, AVG(Length) AS Length_Avg FROM amp_family where Family_ID="' . $familyId . '"')->result_array();
	}
}
