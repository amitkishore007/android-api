<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


/**
* 
*/
require APPPATH . 'libraries'.DIRECTORY_SEPARATOR.'REST_Controller.php';

class Signup extends REST_Controller
{
	
	public function __construct() {


		parent::__construct();
		$this->load->model('signupModel');

	}


	public function create_user_post() {

		if ($this->input->post()) {

			$output = $this->signupModel->create_user();

			// echo json_encode($output);

			$this->response($output, REST_Controller::HTTP_OK);
                
			
		} else {
			
				$this->response([
                    'status' => FALSE,
                    'message' => 'Method not allowed'
                ], REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}


}