<?php 


/**
* 
*/
 
class LoginModel extends CI_Model
{

	var $sms_api = '171789AYBkainQ59a1540e';

	public function login() {

		$info  = $this->input->post();

		
		$this->load->library('form_validation');

		$output = array();
		
		$output['status'] = "false";
		
		$output['error']    = '';
		
				

		if ($this->form_validation->run('login_form_validation')==FALSE) {
				
			
			$output['error']    = form_error('username') . ' '.form_error('password');
			

		} else {

		
			$info['password'] = md5($info['password']);
			
			$result = $this->db->where($info)->get('users');

			if ($result->num_rows()) {
					
				$user  = $result->row();
				
 			
						
						$output['status']		 = "success";
						$output['user_id']      = $user->id;
						$output['user_email']   = $user->email;
						$output['username']     = $user->username;
						$output['phone']        = $user->phone;
						$output['is_logged_in'] = 1;
						
							

					
			} else {
				
				$output['error']  = "Username/password did not matched !";
				
			}


		}

		return $output;

	}



private function send_message($otp_code,$number) {

			$auth_key = $this->sms_api;
			$url = 'https://control.msg91.com/api/sendotp.php?authkey='.$auth_key.'&mobile='.$number.'&message=Your%20otp%20is%20'.$otp_code.'&sender=OTPSMS&otp='.$otp_code;
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


	public function set_active($user_id) {

		$user_id = (int) $user_id;

		$this->db->set('is_active',1)->where(['id'=>$user_id])->update('users');

		$output = array('status'=>'false','username'=>'','email'=>'','phone'=>'','is_active'=>'','current_wallet'=>'');

		if ($this->db->affected_rows()==1) {
		
				$q = $this->db->where(['id'=>$user_id])->get('users');

				if ($q->num_rows()) {
						
					$user = $q->row();

					$output['status']          = 'success';
					$output['username']        = $user->username;
					$output['email']           = $user->email;
					$output['phone']           = $user->phone;
					$output['is_active']       = $user->is_active;
					$output['current__wallet'] = $user->current_wallet;
					

				}	
		}

		return $output;
	}

}