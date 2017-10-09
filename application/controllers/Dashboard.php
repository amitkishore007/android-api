<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
require APPPATH . 'libraries'.DIRECTORY_SEPARATOR.'REST_Controller.php';
require APPPATH.DIRECTORY_SEPARATOR.'third_party'.DIRECTORY_SEPARATOR.'easybitcoin.php';



class Dashboard extends REST_Controller
{
	var $token = '3a3983b264f14785b119e903e66eaec2';
	var $actual_currency = 'USD';
	var $wallet = array('BTC','LTC','DOGE','DASH','ETH','BDC');
	var $data  = array();

	var $rpc_user     ='blackdiamondcoinrpc';
	var $rpc_password ='kishoreamit56400215';
	var $rpc_url      ='139.59.43.222';
	var $rpc_port     ='12755';
	var $bdc_usd_price = '1';
	var $output_array = array(
			
			"status"=>'false',
			"current_wallet"=>'',
			"wallet_address"=> '',
			"wallet_type"=> '',
			'balance' => '',
			'current_price_usd'=>'',
			'wallets'=>array()
		);


	public function __construct() {

		parent::__construct();
		$this->load->model('dashboardModel');
	}

	private function wallet_init($user_id) {

		$this->data['current_wallet'] = $this->dashboardModel->get_current_wallet($user_id);

		 // print_r($this->data['current_wallet']);
		
		 // die();
		if($this->data['current_wallet']->current_wallet !='BDC'){


			$result = $this->get_price($this->data['current_wallet']->current_wallet);
			
			$this->output_array['current_price_usd'] = '';
			
			if ($result) {
				

				$p = json_decode($result);
		
				$this->output_array['current_price_usd'] = $p->USD;

			}

		
			 $balance = $this->get_balance(strtolower($this->data['current_wallet']->current_wallet),$this->data['current_wallet']->wallet_address);

			 $this->output_array['balance'] = '';
			 if ($balance['status']=='success') {

			 		$this->output_array['balance'] = $balance['result'];

			 }


		    $this->output_array['status'] = 'succcess';
		
			$this->output_array['current_wallet'] = $this->data['current_wallet']->current_wallet;
			$this->output_array['wallet_type'] = $this->data['current_wallet']->wallet_type;
		
			$this->output_array['wallet_address'] = $this->data['current_wallet']->wallet_address;
			
		} else {

			$blackdiamond = new Bitcoin($this->rpc_user,$this->rpc_password,$this->rpc_url,$this->rpc_port);

			$balance = $blackdiamond->getbalance($this->data['current_wallet']->wallet_address);
		
			$this->output_array['status'] = 'succcess';
			$this->output_array['current_price_usd'] = $this->bdc_usd_price;
			$this->output_array['current_wallet'] = $this->data['current_wallet']->current_wallet;
			$this->output_array['wallet_type'] = $this->data['current_wallet']->wallet_type;
			$this->output_array['balance'] = $balance ? $balance : '';
			$this->output_array['wallet_address'] = $this->data['current_wallet']->wallet_address;
			
			

		}

		

		
	}

	public function home_get($user_id) {


		if ($user_id==NULL) {
				
			$this->response([
                    'status' => FALSE,
                    'message' => 'Access Not allowed'
                ], REST_Controller::HTTP_OK);
					
		} else {

			$user_id = (int) $user_id;
			$this->wallet_init($user_id);
			$this->response($this->output_array, REST_Controller::HTTP_OK);
			
		}

	}

	public function wallet_get($user_id) {


		if ($user_id==NULL) {
			
			$this->response([
                    'status' => FALSE,
                    'message' => 'Access Not allowed'
                ], REST_Controller::HTTP_OK);
		}

		$user_id = (int) $user_id;

		$this->wallet_init($user_id);

		$all_wallets = $this->dashboardModel->get_all_the_wallet($user_id);
		// print_r($all_wallets);

		$all_wallet_balance = array();


		if ($all_wallets) {
			
			foreach ($all_wallets as $wallet) {
				
				$wallet_array = array(

					"wallet_id"=>'',
					"current_wallet"=>'',
					"wallet_address"=> '',
					"wallet_type"=> '',
					'balance' => '',
					'current_price_usd'=>''

				);

				//$all_wallet_balance[] = array('wallet_type'=>$wallet->wallet_type,)
				// print_r($wallet);
				if ($wallet->wallet_type != 'BDC') {
					
					 $balance = $this->get_balance(strtolower($wallet->wallet_type),$wallet->wallet_address);

					 $result = $balance['result'];

					 $wallet_array['wallet_id']=$wallet->id;
					 $wallet_array['wallet_address']=$wallet->wallet_address;
					 $wallet_array['wallet_type']=$wallet->wallet_type;
					 $wallet_array['balance']=$result->balance;
					 $this->output_array['wallets'][] = $wallet_array;
					 // print_r($balance);

					 // $all_wallet_balance[] = (object) array('wallet_type'=>$wallet->wallet_type,'balance'=>$result->balance);
					
					 
				} else {

					$blackdiamond = new Bitcoin($this->rpc_user,$this->rpc_password,$this->rpc_url,$this->rpc_port);

					$balance = $blackdiamond->getbalance($this->data['current_wallet']->wallet_address);

					$amount  = $balance  ? $balance : '0';
					// $all_wallet_balance[] = (object)array('wallet_type'=>'BDC','balance'=>$amount);

					 $wallet_array['wallet_id']=$wallet->id;
					 $wallet_array['wallet_address']=$wallet->wallet_address;
					 $wallet_array['wallet_type']=$wallet->wallet_type;
					 $wallet_array['balance']=$amount;
					 $this->output_array['wallets'][] = $wallet_array;
					 

				}


			}


		}


		// $this->data['all_wallet_balance'] = $all_wallet_balance;
		// $this->data['wallets'] = $this->dashboardModel->get_wallets($user_id);
		$this->response($this->output_array, REST_Controller::HTTP_OK);


	}

	public function change_wallet_post(){

		if ($this->input->post()) {
				
			$output = $this->dashboardModel->change_wallet();
			if($output['wallet'] != 'BDC'){

					$result = $this->get_price($output['wallet']);
		
					
					if ($result) {

						$result = json_decode($result);
						// $output['price'] = $result->USD;

						$balance = $this->get_balance(strtolower($output['wallet']),$output['wallet_address']);

						$this->output_array['balance'] = 0;
						if ($balance['status']=='success') {
								
								$rslt = $balance['result'];

								// $output['balance'] = $rslt->balance;
								// print_r($rslt->balance);
								
								$this->output_array['status'] = 'success';
								$this->output_array['wallet_address'] = $output['wallet_address'];
								
								$this->output_array['current_price_usd'] = $result->USD;
								$this->output_array['current_wallet'] = $output['wallet'];
								$this->output_array['wallet_type'] = $output['wallet'];
								$this->output_array['balance'] = $rslt->balance;
						}
					} else {

						$this->output_array['current_price_usd'] = '';
					}

			} else {

				$blackdiamond = new Bitcoin($this->rpc_user,$this->rpc_password,$this->rpc_url,$this->rpc_port);

				$balance = $blackdiamond->getbalance($output['wallet_address']);

				$output['status'] = 'success';		
				// $output['price'] = $this->bdc_usd_price;
				$this->output_array['wallet_address'] = $output['wallet_address'];
				$this->output_array['current_price_usd'] = $this->bdc_usd_price;
				$this->output_array['current_wallet'] = $output['wallet'];
				$this->output_array['wallet_type'] = $output['wallet'];
				$this->output_array['balance'] = $balance ? $balance : '0';

			}
			


			// echo json_encode($output);
			$this->response($this->output_array, REST_Controller::HTTP_OK);

				
		} else {

			$this->response([
                    'status' => FALSE,
                    'message' => 'Method not allowed'
                ], REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}


	private function get_price($crypto) { 

			$url = 'https://min-api.cryptocompare.com/data/price?fsym='.$crypto.'&tsyms=USD';
			 if(!function_exists("curl_init")) return "cURL extension is not installed";
			    if (trim($url) == "") die("@ERROR@");
			    $curl = curl_init($url);
			    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
			    // curl_setopt($curl, CURLOPT_POST, 1);                        
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

	public function settings_get($user_id) {

	

		if ($user_id==NULL) {
			
			$this->response([
                    'status' => FALSE,
                    'message' => 'Access Not allowed'
                ], REST_Controller::HTTP_OK);
		}

		$user_id = (int) $user_id;
		$this->wallet_init($user_id);

		
	}

	public function faq() {

	
		if ($user_id==NULL) {
			
			$this->response([
                    'status' => FALSE,
                    'message' => 'Access Not allowed'
                ], REST_Controller::HTTP_OK);
		}

		$user_id = (int) $user_id;

		$this->wallet_init($user_id);
		

	}


	public function checkaddress_post() {

		if ($this->input->post()) {
			$wallet = strtolower($this->input->post('wallet'));
			if ($wallet!='bdc') {

				$output = $this->get_balance($wallet,$this->input->post('wallet_address'));


				$this->response($output, REST_Controller::HTTP_OK);
			
				// echo json_encode($output);
				# code...
			} else {

				$blackdiamond = new Bitcoin($this->rpc_user,$this->rpc_password,$this->rpc_url,$this->rpc_port);

				$balance = $blackdiamond->getaccount($this->input->post('wallet_address'));
				
				if ( is_bool($balance) && $balance==false) {
					# code...
						$output = array('status'=>'false');
				} else {

						$output = array('status'=>'success');

				}

			$this->response($output, REST_Controller::HTTP_OK);
				// echo json_encode($output);

			}
			
			
		} else {

			$this->response([
                    'status' => FALSE,
                    'message' => 'Method not allowed'
                ], REST_Controller::HTTP_METHOD_NOT_ALLOWED);
		}
	}

	private function get_balance($crypto,$address) {

		$url = 'https://api.blockcypher.com/v1/'.$crypto.'/main/addrs/'.$address.'/balance';
		$result = array('status'=>'false','result'=>'');
		if(in_array(strtoupper($crypto),$this->wallet)){
			 if(!function_exists("curl_init")) return "cURL extension is not installed";
				    if (trim($url) == "") die("@ERROR@");
				    $curl = curl_init($url);
				    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
				
				    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);                    
				    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);                          
				    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);                       
				    $response = curl_exec($curl);                                          
				    $resultStatus = curl_getinfo($curl);                                   
				   	
				    if($resultStatus['http_code'] == 200) {
				       
				        // All Ok
				    	$result['status'] = 'success';
				    	$result['result'] = json_decode($response);
				    } 
				
				    $curl = null;
				}
			    return $result; 
	}
	
}