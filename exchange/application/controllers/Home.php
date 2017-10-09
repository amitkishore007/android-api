<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


/**
* 
*/

require APPPATH.DIRECTORY_SEPARATOR.'third_party'.DIRECTORY_SEPARATOR.'easybitcoin.php';

class Home extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();

	}

	public function index() {

		$data['main_content'] = 'public/home';

		$this->load->view('includes/template',$data);
	}


	public function get_coins(){

		$get_coin = $this->input->get('coin');
		$output = array('status'=>'false','coin'=>$get_coin,'change'=>'','usd_price'=>'','icon'=>'');



		$coins = $this->get_coins_rpc($get_coin);
		
		
		if ($coins['status']=='success') {
			$output['status'] ='success';
		 	
			$result=  json_decode($coins['result']);
			// echo $coins['result'];
			$output['change']    = $result[0]->percent_change_1h;
			$output['usd_price'] = $result[0]->price_usd;
			
			$output['icon']     = '<span class="price-up"><img src="'.base_url('assets/images/up.png').'" > '.$result[0]->percent_change_1h.' </span>';                            
			if ($result[0]->percent_change_1h<0) {
			
				$output['icon']     = '<span class="price-down"><img src="'.base_url('assets/images/down.png').'" > '.$result[0]->percent_change_1h.' </span>';
				
			}
			
			echo json_encode($output);
			

		}

	}

	private function get_coins_rpc($coin) { 

			
				$url = 'https://api.coinmarketcap.com/v1/ticker/'.$coin.'/';
			
			 if(!function_exists("curl_init")) return "cURL extension is not installed";
			    if (trim($url) == "") die("@ERROR@");
			    $curl = curl_init($url);
			    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
			    
			    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);                    
			    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);                          
			    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);                       
			    $response = curl_exec($curl);                                          
			    $resultStatus = curl_getinfo($curl);                                   
			   	
			   	$output = array('status'=>'','result'=>'');

			    if($resultStatus['http_code'] == 200) {
			    
			       $output['status']= 'success';

			       $output['result'] = utf8_encode($response);
			        // All Ok
			    
			    }

			    $curl = null;
			    return $output;      
	} 


	public function refresh_trading(){

		$coins = array('litecoin'=>'ltc','bitcoin'=>'btc','ethereum'=>'eth','dash'=>'dash','ripple'=>'xrp','blackdiamondcoin'=>'bdc');

		$get_coin = $this->input->get('coin');

		$parent_coin_result = $this->get_coins_rpc($get_coin);

		$output = array('status'=>'false','result'=>'','against'=>$get_coin,'pairs'=>array());
		$row = '';
		if ($parent_coin_result['status']=='success') {
			
			$parent_result = json_decode($parent_coin_result['result']);

			$parent_price = $parent_result[0]->price_usd;


			$price = array(); 


			foreach ($coins as $coin => $symbol) {


					$pair_class = '';

					if ($this->session->userdata('pair') == $get_coin.'_'.$coin  ) {
					
						$pair_class = 'selected';		
						
					}

					



				if ($coin!='blackdiamondcoin') {
						
				$result = $this->get_coins_rpc($coin);

				if ($result['status']=='success' && $coin != $get_coin) {

					$output['status'] = 'success';

					$rslt = json_decode($result['result']);

					$curr_price = $rslt[0]->price_usd / $parent_price;

					$class = 'success';

					if ($rslt[0]->percent_change_1h<0) {

						$class = 'danger';
					
					}

					$row .= '<tr class="'.$pair_class.'" data-pair="'.$get_coin.'_'.$coin.'">';
					$row .= '<td><i class="fa fa-star"></i></td>';
					$row .= '<td>'.strtoupper($symbol).'</td>';
					$row .= '<td>'.number_format($curr_price,8,'.','').'</td>';
					$row .= '<td>0.000</td>';
					$row .= '<td> <span class="text-'.$class.'"> '.$rslt[0]->percent_change_1h.'</span></td>';
					$row .= '<td>'.strtoupper($coin).' </td>';
					$row .= '</tr>';

					$output['result'] = $row;
					$output['pairs'][$get_coin.'_'.$coin] = number_format($curr_price,8,'.','') ;
				}


				} else {

					$curr_price = 1 / $parent_price;
					$row .= '<tr class="'.$pair_class.'" data-pair="'.$get_coin.'_'.$coin.'">';
					$row .= '<td><i class="fa fa-star"></i></td>';
					$row .= '<td> BDC </td>';
					$row .= '<td>'.number_format($curr_price,8,'.','').'</td>';
					$row .= '<td>0.000</td>';
					$row .= '<td> <span class="text-success"> 0.00</span></td>';
					$row .= '<td> '.strtoupper($coin).' </td>';
					$row .= '</tr>';
					$output['result'] = $row;
					$output['pairs'][$get_coin.'_'.$coin] = number_format($curr_price,8,'.','') ;
				}

		    }


		}
	    echo json_encode($output);	


	}



	public function usd_price(){

		$coins = array('litecoin'=>'ltc','bitcoin'=>'btc','ethereum'=>'eth','dash'=>'dash','ripple'=>'xrp','blackdiamondcoin'=>'bdc');


			$row = '';

			$output = array('status'=>'false','result'=>'');


			foreach ($coins as $coin => $symbol) {


					

				if ($coin!='blackdiamondcoin') {
						
				$result = $this->get_coins_rpc($coin);

				if ($result['status']=='success') {

					$output['status'] = 'success';

					$rslt = json_decode($result['result']);

					$class = 'success';

					if ($rslt[0]->percent_change_1h<0) {

						$class = 'danger';
					
					}


					$row .= '<tr>';
					$row .= '<td><i class="fa fa-star"></i></td>';
					$row .= '<td>'.strtoupper($symbol).'</td>';
					$row .= '<td>$'.$rslt[0]->price_usd.'</td>';
					$row .= '<td>0.000</td>';
					$row .= '<td> <span class="text-'.$class.'"> '.$rslt[0]->percent_change_1h.'</span></td>';
					$row .= '<td>'.strtoupper($coin).' </td>';
					$row .= '</tr>';


					$output['result'] = $row;
					
				}


				} else {

			
					$row .= '<tr >';
					$row .= '<td><i class="fa fa-star"></i></td>';
					$row .= '<td> BDC </td>';
					$row .= '<td>$1</td>';
					$row .= '<td>0.000</td>';
					$row .= '<td> <span class="text-success"> 0.00</span></td>';
					$row .= '<td> '.strtoupper($coin).' </td>';
					$row .= '</tr>';
					$output['result'] = $row;
					
				}

		    }


		
	    echo json_encode($output);	


	}


	public function set_coin_session() {

		$pair  = $this->input->get('pair');

		$this->session->set_userdata('pair',$pair);

		echo 'success';
	}



		
}