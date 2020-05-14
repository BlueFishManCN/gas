<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Amp_metagenome_model
 */
class Amp_metagenome_model extends CI_Model
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
		$this->db->from('amp_metagenome');
		$this->db->where('AMP_ID', $ampId);
		return $this->db->get()->result_array();
	}
}
