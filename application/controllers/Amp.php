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
		$this->load->model('Amp_db_model');
		$this->load->model('Amp_family_model');
	}

	/**
	 *
	 */
	public function index()
	{
		if ($this->input->method(TRUE) == 'GET') {
			$pageSize = $this->input->get('pageSize', TRUE);
			$currentPage = $this->input->get('currentPage', TRUE);
			$ampId = $this->input->get('ampId', TRUE);
			$familyId = $this->input->get('familyId', TRUE);
			$environment = $this->input->get('environment', TRUE);
			$sequence = $this->input->get('sequence', TRUE);
			$minLength = $this->input->get('minLength', TRUE);
			$maxLength = $this->input->get('maxLength', TRUE);
			$minpI = $this->input->get('minpI', TRUE);
			$maxpI = $this->input->get('maxpI', TRUE);
			$minCharge = $this->input->get('minCharge', TRUE);
			$maxCharge = $this->input->get('maxCharge', TRUE);

			$data['count'] = $this->Amp_family_model->count($ampId, $familyId, $environment, $sequence, $minLength, $maxLength, $minpI, $maxpI, $minCharge, $maxCharge);
			$data['AMP'] = $this->Amp_family_model->read($ampId, $familyId, $environment, $pageSize, $currentPage, $sequence, $minLength, $maxLength, $minpI, $maxpI, $minCharge, $maxCharge);

			if ($data['AMP'] != null) {
				foreach ($data['AMP'] as $key => $value) {
					$data['AMP'][$key]['pI'] = trim(rtrim(sprintf("%.4f", $value['pI']), '0'), '.');
					$data['AMP'][$key]['charge'] = trim(rtrim(sprintf("%.4f", $value['charge']), '0'), '.');
				}
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($data));
		} elseif ($this->input->method(TRUE) == 'OPTIONS') {
			$this->output
				->set_status_header(200)
				->set_content_type('application/json');
		} else {
			$this->output
				->set_status_header(405)
				->set_content_type('application/json');
		}
	}

	/**
	 *
	 */
	public function db()
	{
		if ($this->input->method(TRUE) == 'GET') {
			$data['AMPDB'] = $this->Amp_db_model->index();

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($data));
		} elseif ($this->input->method(TRUE) == 'OPTIONS') {
			$this->output
				->set_status_header(200)
				->set_content_type('application/json');
		} else {
			$this->output
				->set_status_header(405)
				->set_content_type('application/json');
		}
	}

	/**
	 *
	 */
	public function ampDbDownload()
	{
		if ($this->input->method(TRUE) == 'GET') {
			$name = $this->input->get('name', TRUE);

			$this->output
				->set_status_header(200)
				->set_content_type('blob')
				->set_output(file_get_contents(base_url('/shell/ampdb/' . $name)));
		} elseif ($this->input->method(TRUE) == 'OPTIONS') {
			$this->output
				->set_status_header(200)
				->set_content_type('application/json');
		} else {
			$this->output
				->set_status_header(405)
				->set_content_type('application/json');
		}
	}
}
