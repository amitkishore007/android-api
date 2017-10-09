<?php 


/**
* 
*/
class Test extends CI_Controller
{
	
	public function index() {

		$data['main_content'] = 'public/home';

		$this->load->view('includes/template',$data);
	}
}