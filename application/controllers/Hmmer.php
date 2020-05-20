<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Hmmer
 */
class Hmmer extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Hmmer_log_model');
		$this->load->helper('file');
		$this->load->helper('string');
	}

	/**
	 *
	 */
	public function index()
	{
		if ($this->input->method(TRUE) == 'POST') {
			$sequence = $this->input->post('sequence', TRUE);
			$evalue = $this->input->post('evalue', TRUE);

			$data = array();

			$str = random_string('alnum', 16);
			$directory = RUN_PATH . $str;
			if (!is_dir($directory)) {
				mkdir($directory, 0777);
			}
			write_file($directory . '/input.fasta', $sequence);
			$input = $directory . '/input.fasta';
			$output = $directory . '/output.txt';
			$evalue = escapeshellarg($evalue);

			$command = escapeshellcmd(HMMSEARCH_PATH . ' --tblout ' . $output . ' -E ' . $evalue . ' --cpu 2 ' . HMMER_DB . ' ' . $input);
			exec($command, $t, $data['return_val']);

			if ($data['return_val'] == 0) {
				$ip = $this->input->ip_address();
				if ($ip != '127.0.0.1') {
					$this->Hmmer_log_model->index($ip, $directory);
				}

				$data['Hmmer_Sequence_Results'] = array();
				$results = file_get_contents($output);
				$results = explode("\n", $results, -1);
				if ($results != null) {
					$length = count($results);

					foreach ($results as $key => $value) {
						if ($key > 2 && $key < $length - 10) {
							$results[$key] = preg_replace("/\s(?=\s)/", "\\1", $value);
							$results[$key] = str_replace(" - ", " ", $results[$key]);
							$results[$key] = explode(" ", $results[$key]);
							array_push($data['Hmmer_Sequence_Results'], array("qseqid" => $results[$key][0], "Family_ID" => $results[$key][1], "f-E-value" => $results[$key][2], "f-score" => $results[$key][3], "f-bias" => $results[$key][4], "b-E-value" => $results[$key][5], "b-score" => $results[$key][6], "b-bias" => $results[$key][7]));
						}
					}
				}

				$data['Hmmer_Sequence_Results_File'] = $str . '/output.txt';
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
	public function file()
	{
		if ($this->input->method(TRUE) == 'POST') {
			$evalue = $this->input->post('evalue', TRUE);

			$data = array();

			$str = random_string('alnum', 16);
			$directory = RUN_PATH . $str;
			if (!is_dir($directory)) {
				mkdir($directory, 0777);
			}

			$config['upload_path'] = $directory;
			$config['allowed_types'] = '*';
			$config['file_name'] = 'input.fasta';
			$config['max_size'] = '524288';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('file')) {
				$input = $directory . '/input.fasta';
				$output = $directory . '/output.txt';
				$evalue = escapeshellarg($evalue);

				$command = escapeshellcmd(HMMSEARCH_PATH . ' --tblout ' . $output . ' -E ' . $evalue . ' --cpu 2 ' . HMMER_DB . ' ' . $input);
				exec($command, $t, $data['return_val']);

				if ($data['return_val'] == 0) {
					$ip = $this->input->ip_address();
					if ($ip != '127.0.0.1') {
						$this->Hmmer_log_model->index($ip, $directory);
					}

					$data['Hmmer_Sequence_Results'] = array();
					$results = file_get_contents($output);
					$results = explode("\n", $results, -1);
					if ($results != null) {
						$length = count($results);

						foreach ($results as $key => $value) {
							if ($key > 2 && $key < $length - 10) {
								$results[$key] = preg_replace("/\s(?=\s)/", "\\1", $value);
								$results[$key] = str_replace(" - ", " ", $results[$key]);
								$results[$key] = explode(" ", $results[$key]);
								array_push($data['Hmmer_Sequence_Results'], array("qseqid" => $results[$key][0], "Family_ID" => $results[$key][1], "f-E-value" => $results[$key][2], "f-score" => $results[$key][3], "f-bias" => $results[$key][4], "b-E-value" => $results[$key][5], "b-score" => $results[$key][6], "b-bias" => $results[$key][7]));
							}
						}
					}

					$data['Hmmer_Sequence_Results_File'] = $str . '/output.txt';
				}

				$this->output
					->set_status_header(200)
					->set_content_type('application/json')
					->set_output(json_encode($data));
			} else {
				$data['error'] = $this->upload->display_errors();
				$data['error'] = str_replace("<p>", '', $data['error']);
				$data['error'] = str_replace("</p>", '', $data['error']);
				$this->output
					->set_status_header(400)
					->set_output($data['error']);
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
