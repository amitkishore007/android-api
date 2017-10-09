<?php 
defined('BASEPATH') OR exit('No direct script access allowed');



/**
* 
*/


class MY_Model extends CI_Model
{
	
	var $sms_api = '171789AYBkainQ59a1540e';
	var $crypto = array('btc'=>'Bitcoin','ltc'=>'Litecoin','bdc'=>'Black diamondcoin','dash'=>'Dashcoin');
	var $rpc = array(
			
			'ltc_user'  => 'litecoinrpc',
			'ltc_pwd'   => 'kishoreamit56400215',
			'ltc_host'  => '165.227.187.144',
			'ltc_port'  => '9432',
			'btc_user'  => 'bitcoinrpc',
			'btc_pwd'   => 'kishoreamit56400215',
			'btc_host'  => '165.227.187.144',
			'btc_port'  => '8332',
			'dash_user' => 'dashrpc',
			'dash_pwd'  => 'kishoreamit56400215',
			'dash_host' => '165.227.187.144',
			'dash_port' => '9998',
			'bdc_host'	=> '159.203.86.151',
			'bdc_port'	=> '12742',
			'bdc_user'	=> 'blackdiamondcoinrpc',
			'bdc_pwd'	=> 'kishoreamit56400215'

	);
	


	function __construct()
	{
		parent::__construct();
	}


}