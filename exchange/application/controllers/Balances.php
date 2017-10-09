<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


/**
* 
*/
class Balances extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->load->model('balancesModel');
	}

	public function index() {

		$data['main_content'] = 'public/deposit_withdrow';
		
		$data['my_cryptos']   = $this->balancesModel->get_my_cryptos();

		$this->load->view('includes/template',$data);

	}


}
