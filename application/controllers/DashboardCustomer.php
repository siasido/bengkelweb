<?php defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardCustomer extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('tanggal');
		$this->load->model('jasamontir_m');
		$this->load->model('jasaservice_m');
		isLogout();
	}

	public function index()
	{
		$data = array(
			'active_menu' => 'dashboard',
			'totalOrderMontir' => $this->jasamontir_m->getOrdersCount($this->session->userdata('userid')),
			'totalService' => $this->jasaservice_m->getOrdersCount($this->session->userdata('userid')),
		);
		$this->template->load('template-customer', 'customer/dashboard', $data);

	}

	public function admin(){
		$this->template->load('template', 'admin/booking-list', null);
	}

	


	

}
