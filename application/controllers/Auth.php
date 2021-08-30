<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_M', 'user_model');
		
	}

	public function index()
	{
		isLogin();
		$this->load->view('auth/login');
	}

	public function login(){
		$post = $this->input->post(null, true);
		// var_dump($post);
		if(isset($post['login'])){
			$result = $this->user_model->login($post);
			if ($result->num_rows() > 0){
				$row = $result->row();

				$newdata = array(
					'userid' => $row->userid,
					'level' => $row->level,
					'image' => $row->image,
					'fullname' => $row->fullname,
					'nohp' => $row->nohp
				);

				$this->session->set_userdata($newdata);
				echo (json_encode($newdata));
				// redirect('dashboard');
				if($row->level == 1){
					redirect('dashboardadmin');
				} else {
					redirect('dashboardcustomer');
				}
			} else {
				echo "<script>
                    alert('Maaf username dan password anda salah');
                    window.location = '".site_url('auth/index')."';
                </script>";
			}

		}

	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('auth/index');
	}

    
}
