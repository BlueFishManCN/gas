<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Family extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Amp_family_model');
		$this->load->model('Amp_environment_model');
		$this->load->model('Family_avg_feature_model');
		$this->load->model('Family_std_feature_model');
	}

	public function index()
	{
		if ($this->input->method(TRUE) == 'GET') {
			$familyId = $this->input->get('familyId', TRUE);

			if ($familyId != '') {
				$data['Family_AMP'] = $this->Amp_family_model->getByFamilyID($familyId);
				$data['Family_Environment'] = $this->Amp_environment_model->getByFamilyID($familyId);
				$data['Family_Avg_Feature'] = $this->Family_avg_feature_model->index($familyId);
				$data['Family_Std_Feature'] = $this->Family_std_feature_model->index($familyId);

				if ($data['Family_AMP'] != null) {
					$data['Family_AMP'][0]["Length_Avg"] = trim(rtrim(sprintf("%.4f", $data['Family_AMP'][0]["Length_Avg"]), '0'), '.');
				}

				if ($data['Family_Avg_Feature'] != null) {
					$data['Family_Avg_Feature'][0]["tinyAA"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["tinyAA"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["smallAA"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["smallAA"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["aliphaticAA"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["aliphaticAA"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["aromaticAA"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["aromaticAA"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["nonpolarAA"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["nonpolarAA"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["polarAA"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["polarAA"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["chargedAA"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["chargedAA"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["basicAA"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["basicAA"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["acidicAA"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["acidicAA"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["charge"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["charge"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["pI"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["pI"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["aindex"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["aindex"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["instaindex"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["instaindex"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["boman"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["boman"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["hydrophobicity"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["hydrophobicity"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["hmoment"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["hmoment"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["SA_Group1_residue0"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["SA_Group1_residue0"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["SA_Group2_residue0"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["SA_Group2_residue0"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["SA_Group3_residue0"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["SA_Group3_residue0"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["HB_Group1_residue0"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["HB_Group1_residue0"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["HB_Group2_residue0"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["HB_Group2_residue0"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["HB_Group3_residue0"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["HB_Group3_residue0"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["AGG"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["AGG"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["AMYLO"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["AMYLO"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["TURN"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["TURN"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["HELIX"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["HELIX"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["HELAGG"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["HELAGG"]), '0'), '.');
					$data['Family_Avg_Feature'][0]["BETA"] = trim(rtrim(sprintf("%.4f", $data['Family_Avg_Feature'][0]["BETA"]), '0'), '.');
				}

				if ($data['Family_Std_Feature'] != null) {
					$data['Family_Std_Feature'][0]["tinyAA"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["tinyAA"]), '0'), '.');
					$data['Family_Std_Feature'][0]["smallAA"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["smallAA"]), '0'), '.');
					$data['Family_Std_Feature'][0]["aliphaticAA"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["aliphaticAA"]), '0'), '.');
					$data['Family_Std_Feature'][0]["aromaticAA"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["aromaticAA"]), '0'), '.');
					$data['Family_Std_Feature'][0]["nonpolarAA"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["nonpolarAA"]), '0'), '.');
					$data['Family_Std_Feature'][0]["polarAA"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["polarAA"]), '0'), '.');
					$data['Family_Std_Feature'][0]["chargedAA"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["chargedAA"]), '0'), '.');
					$data['Family_Std_Feature'][0]["basicAA"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["basicAA"]), '0'), '.');
					$data['Family_Std_Feature'][0]["acidicAA"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["acidicAA"]), '0'), '.');
					$data['Family_Std_Feature'][0]["charge"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["charge"]), '0'), '.');
					$data['Family_Std_Feature'][0]["pI"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["pI"]), '0'), '.');
					$data['Family_Std_Feature'][0]["aindex"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["aindex"]), '0'), '.');
					$data['Family_Std_Feature'][0]["instaindex"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["instaindex"]), '0'), '.');
					$data['Family_Std_Feature'][0]["boman"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["boman"]), '0'), '.');
					$data['Family_Std_Feature'][0]["hydrophobicity"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["hydrophobicity"]), '0'), '.');
					$data['Family_Std_Feature'][0]["hmoment"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["hmoment"]), '0'), '.');
					$data['Family_Std_Feature'][0]["SA_Group1_residue0"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["SA_Group1_residue0"]), '0'), '.');
					$data['Family_Std_Feature'][0]["SA_Group2_residue0"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["SA_Group2_residue0"]), '0'), '.');
					$data['Family_Std_Feature'][0]["SA_Group3_residue0"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["SA_Group3_residue0"]), '0'), '.');
					$data['Family_Std_Feature'][0]["HB_Group1_residue0"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["HB_Group1_residue0"]), '0'), '.');
					$data['Family_Std_Feature'][0]["HB_Group2_residue0"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["HB_Group2_residue0"]), '0'), '.');
					$data['Family_Std_Feature'][0]["HB_Group3_residue0"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["HB_Group3_residue0"]), '0'), '.');
					$data['Family_Std_Feature'][0]["AGG"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["AGG"]), '0'), '.');
					$data['Family_Std_Feature'][0]["AMYLO"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["AMYLO"]), '0'), '.');
					$data['Family_Std_Feature'][0]["TURN"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["TURN"]), '0'), '.');
					$data['Family_Std_Feature'][0]["HELIX"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["HELIX"]), '0'), '.');
					$data['Family_Std_Feature'][0]["HELAGG"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["HELAGG"]), '0'), '.');
					$data['Family_Std_Feature'][0]["BETA"] = trim(rtrim(sprintf("%.4f", $data['Family_Std_Feature'][0]["BETA"]), '0'), '.');
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

	public function download()
	{
		if ($this->input->method(TRUE) == 'GET') {
			$url = $this->input->get('url', TRUE);

			$this->output
				->set_status_header(200)
				->set_content_type('blob')
				->set_output(file_get_contents(base_url("/assets/" . $url)));
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
