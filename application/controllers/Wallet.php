<?php 
// defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Wallet extends CI_Controller
{
	
	// public function __construct() {

	// 	parent::__construct();

	// } 

	public function index() {

		$data['main_content'] = 'public/wallet/index';
		$this->load->view('includes/template',$data);

	}
}