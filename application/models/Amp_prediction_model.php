<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Amp_prediction_model
 */
class Amp_prediction_model extends CI_Model
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
		$this->db->from('amp_prediction');
		$this->db->where('AMP_ID', $ampId);
		return $this->db->get()->result_array();
	}
}
