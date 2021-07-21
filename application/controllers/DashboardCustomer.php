<?php defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardCustomer extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('tanggal');
		$this->load->model('jasamontir_m');
		isLogout();
	}

	public function index()
	{
		$data = array(
			'active_menu' => 'dashboard'
		);
		$this->template->load('template-customer', 'admin/dashboard', $data);

	}

	public function admin(){
		$this->template->load('template', 'admin/booking-list', null);
	}


	

}
