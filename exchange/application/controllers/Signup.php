<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


/**
* 
*/
class Signup extends MY_Controller
{
	
	public function __construct() {


		parent::__construct();
		$this->checkLogin();
		$this->load->model('signupModel');
		$this->load->model('countryModel');



	}

	public function checkLogin() {

		if ($this->session->userdata('is_logged_in')) {
			
			return redirect('market');
		}
	}

	public function index() {

		$data['main_content'] = 'public/signup';

		$data['countries'] = $this->countryModel->get_countries();
		
		$this->load->view('includes/template',$data);

	}

	public function create_user() {

		if ($this->input->post()) {

			$output = $this->signupModel->create_user();

			echo json_encode($output);
			
		} else {

			return redirect('signup');
		}
	}


	public function verify_otp() {

		$data['main_content'] = 'public/otp_form';

		$this->load->view('includes/template',$data);

	}
}