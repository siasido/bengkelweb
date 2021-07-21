<?php defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardAdmin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('tanggal');
		// $this->load->model('order_m');
		isLogout();
	}

	public function index()
	{
		$data = array(
			'active_menu' => 'dashboard'
		);
		$this->template->load('template', 'admin/dashboard', $data);
	}



	

}
