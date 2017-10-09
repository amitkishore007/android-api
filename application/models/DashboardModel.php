<?php 



/**
* 
*/
class DashboardModel extends CI_Model
{
	
	var $wallets = array('BTC','LTC','DOGE','DASH','ETH','BDC');
	var $token = '3a3983b264f14785b119e903e66eaec2';

	public function get_wallets($user_id) {

		$user_id  =  (int) $user_id;
		$q = $this->db->where(['user_id'=>$user_id])->get('wallet');

		if ($q->num_rows()) {
			
			return $q->result();
		}
	}


	public function get_current_wallet($user_id){
		
		$user_id  =  (int) $user_id;

		$q = $this->db->select('users.current_wallet,wallet.wallet_public_key,wallet.wallet_address,wallet.wallet_type')->from('users')->where(['users.id'=>$user_id])->join('wallet','wallet.user_id = users.id AND wallet.wallet_type =  users.current_wallet')->get();

		if ($q->num_rows()) {
		
			return $q->row();
		}
	}

	public function change_wallet() {

		$coin = $this->input->post('wallet');
		$user_id  =  (int) $this->input->post('user_id');
		
		$output = array('status'=>'false','wallet'=>$coin,'wallet_address'=>'');
		if (in_array($coin, $this->wallets)) {
			

			$this->db->set('current_wallet',$coin)->where(['id'=>$user_id])->update('users');
			
			if ($this->db->affected_rows()>=0) {

				$q = $this->db->where(['user_id'=>$user_id,'wallet_type'=>$coin])->get('wallet');
				
				if ($q->num_rows()) {
					
					$output['wallet_address'] = $q->row()->wallet_address;	
					
					// if($coin!='BDC'){

					// 	$output['wallet_public_key'] = $q->row()->wallet_public_key;
					// }

					$output['status'] = 'success';
				}
			}

		}

		return $output;

	}


	public function get_all_the_wallet($user_id) {

		$q = $this->db->select('id,user_id,wallet_address,wallet_type')->from('wallet')->where(['user_id'=>$user_id])->get();

		if ($q->num_rows()) {

			return $q->result();

		}
	}
}