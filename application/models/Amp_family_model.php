<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Amp_family_model
 */
class Amp_family_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * @param $id
	 * @param $pageSize
	 * @param $currentPage
	 * @param $sequence
	 * @param $minLength
	 * @param $maxLength
	 * @param $minpI
	 * @param $maxpI
	 * @param $minCharge
	 * @param $maxCharge
	 * @return mixed
	 */
	public function read($ampId, $pageSize, $currentPage, $sequence, $minLength, $maxLength, $minpI, $maxpI, $minCharge, $maxCharge)
	{
		$this->db->select('amp_family.*,amp_feature.pI,amp_feature.charge');
		$this->db->from('amp_family');
		$this->db->join('amp_feature', 'amp_family.AMP_ID=amp_feature.AMP_ID', 'left');
		if ($ampId != '') {
			$this->db->like('amp_family.AMP_ID', $ampId);
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

	/**
	 * @param $id
	 * @param $sequence
	 * @param $minLength
	 * @param $maxLength
	 * @param $minpI
	 * @param $maxpI
	 * @param $minCharge
	 * @param $maxCharge
	 * @return mixed
	 */
	public function count($ampId, $sequence, $minLength, $maxLength, $minpI, $maxpI, $minCharge, $maxCharge)
	{
		$this->db->select('amp_family.*,amp_feature.pI,amp_feature.charge');
		$this->db->from('amp_family');
		$this->db->join('amp_feature', 'amp_family.AMP_ID=amp_feature.AMP_ID', 'left');
		if ($ampId != '') {
			$this->db->like('amp_family.AMP_ID', $ampId);
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
		return $this->db->count_all_results();
	}
}
