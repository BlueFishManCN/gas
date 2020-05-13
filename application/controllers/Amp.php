<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Amp
 */
class Amp extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Amp_family_model');
	}

	/**
	 *
	 */
	public function index()
	{
		if ($this->input->method(TRUE) == 'GET' or $this->input->method(TRUE) == 'OPTIONS') {
			$pageSize = $this->input->get('pageSize', TRUE);
			$currentPage = $this->input->get('currentPage', TRUE);
			$ampId = $this->input->get('ampId', TRUE);
			$sequence = $this->input->get('sequence', TRUE);
			$minLength = $this->input->get('minLength', TRUE);
			$maxLength = $this->input->get('maxLength', TRUE);
			$minpI = $this->input->get('minpI', TRUE);
			$maxpI = $this->input->get('maxpI', TRUE);
			$minCharge = $this->input->get('minCharge', TRUE);
			$maxCharge = $this->input->get('maxCharge', TRUE);

			$data['count'] = $this->Amp_family_model->count($ampId, $sequence, $minLength, $maxLength, $minpI, $maxpI, $minCharge, $maxCharge);
			$data['AMP'] = $this->Amp_family_model->read($ampId, $pageSize, $currentPage, $sequence, $minLength, $maxLength, $minpI, $maxpI, $minCharge, $maxCharge);

			foreach ($data['AMP'] as $key => $value) {
				$data['AMP'][$key]['pI'] = trim(rtrim(sprintf("%.4f", $value['pI']), '0'), '.');
				$data['AMP'][$key]['charge'] = trim(rtrim(sprintf("%.4f", $value['charge']), '0'), '.');
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($data));
		} else {
			$this->output
				->set_status_header(405)
				->set_content_type('application/json');
		}
	}

//	/**
//	 * @return bool
//	 */
//	public function test()
//	{
//		if ($this->input->method(TRUE) == 'POST' or $this->input->method(TRUE) == 'OPTIONS') {
//			$command = escapeshellcmd('ls');
//			$data = array();
//			$data['command'] = $command;
//			exec($command, $data['output'], $data['return_val']);
//			$this->output
//				->set_status_header(200)
//				->set_content_type('application/json')
//				->set_output(json_encode($data));
//		} else {
//			$this->output
//				->set_status_header(405)
//				->set_content_type('application/json')
//				->set_output();
//		}
//	}
}
