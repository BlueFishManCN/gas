<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Base
 */
class Base extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @return bool
	 */
	public function test()
	{
		if ($this->input->method(TRUE) == 'POST' or $this->input->method(TRUE) == 'OPTIONS') {
			$command = escapeshellcmd('');
			$data = array();
			$data['command'] = $command;
			exec($command, $data['output'], $data['return_val']);
			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
				->set_output(json_encode($data));
		} else {
			$this->output
				->set_status_header(405)
				->set_content_type('application/json')
				->set_output();
		}
	}
}
