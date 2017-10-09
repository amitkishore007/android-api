<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/

class Home extends CI_Controller
{
	
	public function __construct() {

		parent::__construct();

	} 

	public function index() {

		
		$this->load->view('public/home/index');

	}

	// public function check_rpc() {

	// 	$bitcoin = new Bitcoin('blackdiamondcoinrpc','kishoreamit56400215','139.59.43.222','12755');
	// 	$bitcoin->getinfo();
	// 	echo '<pre>';
	// 	print_r($bitcoin);
	// 	echo '</pre>';
	// 	phpinfo();

	// }
	


}