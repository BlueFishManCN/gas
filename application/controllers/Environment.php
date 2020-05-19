<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Environment
 */
class Environment extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Environment_amp_model');
		$this->load->model('Family_environment_model');
	}

	/**
	 *
	 */
	public function index()
	{
		if ($this->input->method(TRUE) == 'GET') {
			$environment = $this->input->get('environment', TRUE);
			$pageSize = $this->input->get('pageSize', TRUE);
			$currentPage = $this->input->get('currentPage', TRUE);

			if ($environment != '') {
				$data['Environment_AMP'] = $this->Environment_amp_model->index($environment);
				$data['Count'] = $this->Family_environment_model->count($environment);
				$data['Environment_Family'] = $this->Family_environment_model->getByEnvironment($environment, $pageSize, $currentPage);

				if ($data['Environment_AMP'] != null) {
					$data['Environment_AMP'][0]["Length_Avg"] = trim(rtrim(sprintf("%.4f", $data['Environment_AMP'][0]["Length_Avg"]), '0'), '.');
				}

				if ($data['Environment_Family'] != null) {
					foreach ($data['Environment_Family'] as $key => $value) {
						$data['Environment_Family'][$key]["Length_Avg"] = trim(rtrim(sprintf("%.4f", $value["Length_Avg"]), '0'), '.');
					}
				}

				$this->output
					->set_status_header(200)
					->set_content_type('application/json')
					->set_output(json_encode($data));
			} else {
				$this->output
					->set_status_header(204)
					->set_content_type('application/json');
			}
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
