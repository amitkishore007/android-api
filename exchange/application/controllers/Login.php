<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


/**
* 
*/
// require APPPATH.DIRECTORY_SEPARATOR.'third_party'.DIRECTORY_SEPARATOR.'easybitcoin.php';

class Login extends MY_Controller
{

	public function __construct() {


		parent::__construct();
		
		$this->checkLogin();
		$this->load->model('loginModel');
		$this->load->model('signupModel');



	}


	public function checkLogin() {

		if ($this->session->userdata('is_logged_in')) {
			
			return redirect('market');
		}
	}


	public function index() {

		$data['main_content'] = 'public/login';
		$this->load->view('includes/template',$data);

	}


	public function login() {

		if ($this->input->post()) {

			$user = $this->loginModel->login();
			  
			echo json_encode($user);

				
		} else {

			return redirect('shop');
		}

	}


	public function check_password() {

		if ($this->input->post()) {
				
			$output = $this->validate_password($this->input->post('password'));

			echo $output ? 'success' : 'false';
					
		} else {

			return redirect('signup');
		}

	}

	private function validate_password($password) {

		   $r1='/[A-Z]/';  //Uppercase
		   $r2='/[a-z]/';  //lowercase
		   $r3='/[!@#$%^&*()\-_=+{};:,<.>]/';  // whatever you mean by 'special char'
		   $r4='/[0-9]/';  //numbers

		   if(preg_match_all($r1,$password, $o)<1) return FALSE;

		   if(preg_match_all($r2,$password, $o)<1) return FALSE;

		   if(preg_match_all($r3,$password, $o)<1) return FALSE;

		   if(preg_match_all($r4,$password, $o)<1) return FALSE;

		   if(strlen($password)<8) return FALSE;

		   return TRUE;
	}


	

	public function check_otp(){

		if ($this->input->post()) {
				
				$output = $this->check_sent_otp($this->input->post('otp'),$this->session->userdata('phone'));

				$result = json_decode($output);

				if ($result->type=='success') {
					
					$output = $this->signupModel->user_signup();

					echo $output;
					
				} else {

					echo 'error';
				}
		} else {

			return redirect('login');
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


	public function destroy(){

		$this->session->sess_destroy();
	}

}