<?php 

/**
* 
*/
class BalancesModel extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function get_my_cryptos() {

		$user_id = (int) $this->session->userdata('user_id');
		$this->db->select('id,crypto_type,crypto_address,crypto_name')->from('wallets');
		$q =  $this->db->where(['user_id'=>$user_id])->order_by('crypto_name','ASC')->get();

		if ($q->num_rows()) {
			
			return $q->result();
		}
	}
}