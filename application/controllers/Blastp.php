<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Blastp
 */
class Blastp extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Blast_log_model');
	}

	/**
	 *
	 */
	public function index()
	{
		if ($this->input->method(TRUE) == 'POST') {
			$sequence = $this->input->post('sequence', TRUE);
			$evalue = $this->input->post('evalue', TRUE);
			$resultType = $this->input->post('resultType', TRUE);

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

			if ($resultType == 'false') {
				$command = escapeshellcmd(BLASTP_PATH . ' -db ' . BLAST_DB . ' -query ' . $input . ' -out ' . $output . ' -evalue ' . $evalue . ' -outfmt "10 qseqid sseqid evalue score qcovs" -num_threads 2');
				exec($command, $data['output'], $data['return_val']);

				if ($data['return_val'] == 0) {
					$ip = $this->input->ip_address();
					if ($ip != '127.0.0.1') {
						$this->Blast_log_model->index($ip, $directory);
					}
					$data['Blastp_Sequence_Results'] = array();
					$results = file_get_contents($output);
					$results = explode("\n", $results, -1);
					if ($results != null) {
						foreach ($results as $key => $value) {
							$results[$key] = str_replace('|', ',', $value);
							$results[$key] = explode(",", $results[$key]);
							if (count($results[$key]) == 6) {
								array_push($data['Blastp_Sequence_Results'], array("qseqid" => $results[$key][0], "AMP_ID" => $results[$key][1], "Family_ID" => $results[$key][2], "evalue" => $results[$key][3], "score" => $results[$key][4], "qcovs" => $results[$key][5]));
							} else {
								array_push($data['Blastp_Sequence_Results'], array("qseqid" => $results[$key][0], "AMP_ID" => $results[$key][1], "Family_ID" => "", "evalue" => $results[$key][2], "score" => $results[$key][3], "qcovs" => $results[$key][4]));
							}
						}
					}
				}
			} else {
				$command = escapeshellcmd(BLASTP_PATH . ' -db ' . BLAST_DB . ' -query ' . $input . ' -out ' . $output . ' -evalue ' . $evalue . ' -num_threads 2');
				exec($command, $data['output'], $data['return_val']);

				if ($data['return_val'] == 0) {
					$ip = $this->input->ip_address();
					if ($ip != '127.0.0.1') {
						$this->Blast_log_model->index($ip, $directory);
					}
					$data['Blastp_Sequence_Results'] = $str . '/output.txt';
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
	public function file()
	{
		if ($this->input->method(TRUE) == 'POST') {
			$evalue = $this->input->post('evalue', TRUE);
			$resultType = $this->input->post('resultType', TRUE);

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

				if ($resultType == 'false') {
					$command = escapeshellcmd(BLASTP_PATH . ' -db ' . BLAST_DB . ' -query ' . $input . ' -out ' . $output . ' -evalue ' . $evalue . ' -outfmt "10 qseqid sseqid evalue score qcovs" -num_threads 2');
					exec($command, $data['output'], $data['return_val']);

					if ($data['return_val'] == 0) {
						$ip = $this->input->ip_address();
						if ($ip != '127.0.0.1') {
							$this->Blast_log_model->index($ip, $directory);
						}

						$data['Blastp_Sequence_Results'] = array();
						$results = file_get_contents($output);
						$results = explode("\n", $results, -1);
						if ($results != null) {
							foreach ($results as $key => $value) {
								$results[$key] = str_replace('|', ',', $value);
								$results[$key] = explode(",", $results[$key]);
								if (count($results[$key]) == 6) {
									array_push($data['Blastp_Sequence_Results'], array("qseqid" => $results[$key][0], "AMP_ID" => $results[$key][1], "Family_ID" => $results[$key][2], "evalue" => $results[$key][3], "score" => $results[$key][4], "qcovs" => $results[$key][5]));
								} else {
									array_push($data['Blastp_Sequence_Results'], array("qseqid" => $results[$key][0], "AMP_ID" => $results[$key][1], "Family_ID" => "", "evalue" => $results[$key][2], "score" => $results[$key][3], "qcovs" => $results[$key][4]));
								}
							}
						}
					}
				} else {
					$command = escapeshellcmd(BLASTP_PATH . ' -db ' . BLAST_DB . ' -query ' . $input . ' -out ' . $output . ' -evalue ' . $evalue . ' -num_threads 2');
					exec($command, $data['output'], $data['return_val']);

					if ($data['return_val'] == 0) {
						$ip = $this->input->ip_address();
						if ($ip != '127.0.0.1') {
							$this->Blast_log_model->index($ip, $directory);
						}
						$data['Blastp_Sequence_Results'] = $str . '/output.txt';
					}
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

	/**
	 *
	 */
	public function download()
	{
		if ($this->input->method(TRUE) == 'GET') {
			$url = $this->input->get('url', TRUE);

			$this->output
				->set_status_header(200)
				->set_content_type('blob')
				->set_output(file_get_contents(base_url('/shell/run/' . $url)));
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
