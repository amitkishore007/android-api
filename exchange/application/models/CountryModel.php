<?php 
defined('BASEPATH') OR exit('No direct script access allowed');



/**
* 
*/
class CountryModel extends MY_Model
{
	
	
	public function get_countries() {

		$q = $this->db->select('id,name')->from('country')->order_by('name','ASC')->get();
		
		if ($q->num_rows()) {
			
			return $q->result();
		}
	}

}