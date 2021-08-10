<?php defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardAdmin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('tanggal');
		// $this->load->model('order_m');
		// isLogout();
	}

	public function index()
	{
		
		$data = array(
			'active_menu' => 'dashboard',
			'totalMontir' => $this->db->count_all('montir'),
			'totalOrderMontir' => $this->db->count_all('montirorders'),
			'totalService' => $this->db->count_all('serviceorders'),
			'totalCustomer' => $this->getTotalActiveData()
		);
		$this->template->load('template', 'admin/dashboard', $data);
		
	}

	public function getTotalActiveData(){
		$this->db->like('level', '2');
		$this->db->from('users');
		return $this->db->count_all_results();
	}





	

}
