<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Home
 */
class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Visit_log_model');
	}

	/**
	 *
	 */
	public function index()
	{
		if ($this->input->method(TRUE) == 'POST') {
			$ip = $this->input->ip_address();
			if ($ip != '127.0.0.1') {
				$this->Visit_log_model->index($ip);
			}
			$data['count'] = $this->Visit_log_model->count();

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
}
