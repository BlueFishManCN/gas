<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Amp_card
 */
class Amp_card extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Amp_family_model');
		$this->load->model('Amp_feature_model');
		$this->load->model('Amp_country_model');
		$this->load->model('Amp_environment_model');
		$this->load->model('Amp_metagenome_model');
		$this->load->model('Amp_prediction_model');
	}

	/**
	 *
	 */
	public function index()
	{
		if ($this->input->method(TRUE) == 'GET' or $this->input->method(TRUE) == 'OPTIONS') {
			$ampId = $this->input->get('ampId', TRUE);

			if ($ampId != '') {
				$data['AMP_Family'] = $this->Amp_family_model->index($ampId);
				$data['AMP_Feature'] = $this->Amp_feature_model->index($ampId);
				$data['AMP_Country'] = $this->Amp_country_model->index($ampId);
				$data['AMP_Environment'] = $this->Amp_environment_model->index($ampId);
				$data['AMP_Metagenome'] = $this->Amp_metagenome_model->index($ampId);
				$data['AMP_Prediction'] = $this->Amp_prediction_model->index($ampId);

				if ($data['AMP_Family'] != null) {
					$data['AMP_Feature'][0]["tinyAA"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["tinyAA"]), '0'), '.');
					$data['AMP_Feature'][0]["smallAA"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["smallAA"]), '0'), '.');
					$data['AMP_Feature'][0]["aliphaticAA"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["aliphaticAA"]), '0'), '.');
					$data['AMP_Feature'][0]["aromaticAA"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["aromaticAA"]), '0'), '.');
					$data['AMP_Feature'][0]["nonpolarAA"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["nonpolarAA"]), '0'), '.');
					$data['AMP_Feature'][0]["polarAA"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["polarAA"]), '0'), '.');
					$data['AMP_Feature'][0]["chargedAA"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["chargedAA"]), '0'), '.');
					$data['AMP_Feature'][0]["basicAA"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["basicAA"]), '0'), '.');
					$data['AMP_Feature'][0]["acidicAA"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["acidicAA"]), '0'), '.');
					$data['AMP_Feature'][0]["charge"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["charge"]), '0'), '.');
					$data['AMP_Feature'][0]["pI"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["pI"]), '0'), '.');
					$data['AMP_Feature'][0]["aindex"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["aindex"]), '0'), '.');
					$data['AMP_Feature'][0]["instaindex"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["instaindex"]), '0'), '.');
					$data['AMP_Feature'][0]["boman"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["boman"]), '0'), '.');
					$data['AMP_Feature'][0]["hydrophobicity"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["hydrophobicity"]), '0'), '.');
					$data['AMP_Feature'][0]["hmoment"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["hmoment"]), '0'), '.');
					$data['AMP_Feature'][0]["SA_Group1_residue0"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["SA_Group1_residue0"]), '0'), '.');
					$data['AMP_Feature'][0]["SA_Group2_residue0"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["SA_Group2_residue0"]), '0'), '.');
					$data['AMP_Feature'][0]["SA_Group3_residue0"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["SA_Group3_residue0"]), '0'), '.');
					$data['AMP_Feature'][0]["HB_Group1_residue0"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["HB_Group1_residue0"]), '0'), '.');
					$data['AMP_Feature'][0]["HB_Group2_residue0"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["HB_Group2_residue0"]), '0'), '.');
					$data['AMP_Feature'][0]["HB_Group3_residue0"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["HB_Group3_residue0"]), '0'), '.');
					$data['AMP_Feature'][0]["AGG"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["AGG"]), '0'), '.');
					$data['AMP_Feature'][0]["AMYLO"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["AMYLO"]), '0'), '.');
					$data['AMP_Feature'][0]["TURN"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["TURN"]), '0'), '.');
					$data['AMP_Feature'][0]["HELIX"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["HELIX"]), '0'), '.');
					$data['AMP_Feature'][0]["HELAGG"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["HELAGG"]), '0'), '.');
					$data['AMP_Feature'][0]["BETA"] = trim(rtrim(sprintf("%.4f", $data['AMP_Feature'][0]["BETA"]), '0'), '.');

					$data['AMP_Prediction'][0]["AMP_Probability"] = trim(rtrim(sprintf("%.4f", $data['AMP_Prediction'][0]["AMP_Probability"]), '0'), '.');
					$data['AMP_Prediction'][0]["Hemolysis_Probability"] = trim(rtrim(sprintf("%.4f", $data['AMP_Prediction'][0]["Hemolysis_Probability"]), '0'), '.');

					$this->output
						->set_status_header(200)
						->set_content_type('application/json')
						->set_output(json_encode($data));
				} else {
					$this->output
						->set_status_header(204)
						->set_content_type('application/json');
				}
			} else {
				$this->output
					->set_status_header(204)
					->set_content_type('application/json');
			}
		} else {
			$this->output
				->set_status_header(405)
				->set_content_type('application/json');
		}
	}
}
