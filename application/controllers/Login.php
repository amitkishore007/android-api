<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


/**
* 
*/
require APPPATH . 'libraries'.DIRECTORY_SEPARATOR.'REST_Controller.php';

require APPPATH.DIRECTORY_SEPARATOR.'third_party'.DIRECTORY_SEPARATOR.'easybitcoin.php';

class Login extends REST_Controller
{
	var $sms_api = '171789AYBkainQ59a1540e';

	public function __construct() {


		parent::__construct();
	
		$this->load->model('loginModel');


	}


	public function login_post() {

		if ($this->input->post()) {

			$user = $this->loginModel->login();
			  
			$this->response($user, REST_Controller::HTTP_OK); 

				
		} else {

			$this->response([
                    'status' => FALSE,
                    'message' => 'Method not allowed'
                ], REST_Controller::HTTP_METHOD_NOT_ALLOWED); 
		}

	}




	public function check_otp_post(){

		if ($this->input->post()) {
				
				$output = $this->check_sent_otp($this->input->post('otp'),$this->input->post('phone'));

				$result = json_decode($output);

				if ($result->type=='success') {
					
					// $this->session->set_userdata('is_logged_in',1);
					// $this->session->unset_userdata('otp');
						$output = $this->loginModel->set_active($this->input->post('user_id'));
						# code...

						$this->response($output, REST_Controller::HTTP_OK);
						

				} else {
					
						$this->response(['status'=>FALSE,'error'=>'Please provide correct OTP'], REST_Controller::HTTP_OK);

				}

		} else {

				$this->response([
		                    'status' => FALSE,
		                    'message' => 'Method not allowed'
		                ], REST_Controller::HTTP_METHOD_NOT_ALLOWED); 
				}
	}


	private function check_sent_otp($otp,$mobile) {

			$auth_key = $this->sms_api;
			$url = 'https://control.msg91.com/api/verifyRequestOTP.php?authkey='.$auth_key.'&mobile='.$mobile.'&otp='.$otp;
			 if(!function_exists("curl_init")) return "cURL extension is not installed";
			    if (trim($url) == "") die("@ERROR@");
			    $curl = curl_init($url);
			    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
			    curl_setopt($curl, CURLOPT_POST, 1);                        
			    // curl_setopt($curl, CURLOPT_USERPWD, 'username:password');
			    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);                    
			    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);                          
			    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);                       
			    $response = curl_exec($curl);                                          
			    $resultStatus = curl_getinfo($curl);                                   
			   	
			    if($resultStatus['http_code'] == 200) {
			       
			        // All Ok
			    
			    } else {

			        return json_encode($resultStatus);                            
				}

			    $curl = null;
			    return utf8_encode($response);

	}


	

}