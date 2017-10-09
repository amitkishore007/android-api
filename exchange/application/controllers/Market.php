<?php 
defined('BASEPATH') OR exit('No direct script access allowed');



/**
* 
*/
class Market extends MY_Controller
{
	
	

	public function index() {

		$data['main_content'] = 'public/market';

		$this->load->view('includes/template',$data);
	}

}