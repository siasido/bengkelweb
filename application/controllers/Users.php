<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->model('User_M', 'user_m');
		
	}

	public function register()
	{
        isLogin();
		$this->load->view('users/register');
	}

    public function selfregistration(){
        $post = $this->input->post(null, true);

        // print_r($_FILES['image']);
        // exit();

        $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
		$this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
		$this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
		$this->form_validation->set_message('is_unique', '{field} sudah digunakan, silahkan ganti.');
		$this->form_validation->set_message('matches', '{field} tidak sesuai dengan kata sandi, silahkan ganti.'); 
        
        $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'trim|required|min_length[3]|max_length[40]');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[20]|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Kata Sandi', 'trim|required|min_length[4]|max_length[20]');
        $this->form_validation->set_rules('nohp', 'No. HP', 'trim|required|min_length[11]|max_length[15]');
        $this->form_validation->set_rules('password', 'Kata Sandi', 'trim|required|min_length[4]|max_length[20]');
        $this->form_validation->set_rules('passconf', 'Konfirmasi Sandi', 'trim|required|matches[password]');

        if ($this->form_validation->run() == FALSE){
            $this->load->view('users/register');
        } else {
            $data = array(
                'username' => $post['username'],
                'password' => sha1($post['password']),
                'nohp' => $post['nohp'],
                'level' => 2
            );

            if($_FILES['image']['name'] != null){ // check wheiter image is exist					
                // configurasi upload
                $configurasi['upload_path']          = './uploads/users/';
                $configurasi['allowed_types']        = 'jpg|png|jpeg';
                $configurasi['max_size']             = 2048;
                $configurasi['file_name'] = 'user-'.date('YmdHis');
            
                // do the upload
                $this->upload->initialize($configurasi, TRUE);
            
                if (!$this->upload->do_upload('image')){ //if upload failed
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('users/register',$error);
                }
                else{ //if upload image success

                    $data['image'] = $this->upload->data('file_name'); //get image name
            
                    $this->user_m->add($data);
                    if($this->db->affected_rows() > 0){
                        echo "<script>
                            alert('Data berhasil disimpan');
                            window.location = '".site_url('auth')."';
                        </script>";
                    }
                } 
                
            } else{
                $this->user_m->add($data);
                if($this->db->affected_rows() > 0){
                    echo "<script>
                        alert('Data berhasil disimpan');
                        window.location = '".site_url('auth')."';
                    </script>";
                }
            }
        }
    }

    public function index(){
		// $data['page_js'] = base_url().'custom-js/user/user-data.js';
        $data = array(
            'active_menu' => 'users',
            'data' => $this->user_m->get()->result(),
        );
		$this->template->load('template', 'users/users-list', $data);
    }

    public function edit($id){
        $data = array(
            'active_menu' => 'users',
            'row' => $this->user_m->get($id)->row(),
        );
		$this->template->load('template', 'users/user_form_edit', $data);

    }

    public function update(){
        $post = $this->input->post(null, true);

        $data = array(
            'fullname' => $post['fullname'],
            'username' => $post['username'],
            
            'nohp' => $post['nohp'],
            'level' => $post['level']
        );

        $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
		$this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
		$this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
		$this->form_validation->set_message('is_unique', '{field} sudah digunakan, silahkan ganti.');
		$this->form_validation->set_message('matches', '{field} tidak sesuai dengan kata sandi, silahkan ganti.'); 
        
        $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'trim|required|min_length[3]|max_length[40]');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[20]|callback_username_check');
        // $this->form_validation->set_rules('password', 'Kata Sandi', 'trim|required|min_length[4]|max_length[20]');
        $this->form_validation->set_rules('nohp', 'No. HP', 'trim|required|min_length[11]|max_length[15]');

        if($post['password']){
            $this->form_validation->set_rules('password', 'Kata Sandi', 'trim|required|min_length[4]|max_length[20]');
            $this->form_validation->set_rules('passconf', 'Konfirmasi Sandi', 'trim|required|matches[password]');
            $data['password'] = sha1($post['password']);
        }

        if($post['passconf']){
            $this->form_validation->set_rules('passconf', 'Konfirmasi Sandi', 'trim|required|matches[password]');
        }

        if ($this->form_validation->run() == FALSE){
            $data = array(
                'active_menu' => 'users',
                'row' => $this->user_m->get($post['userid'])->row(),
            );
            $this->template->load('template','users/user_form_edit', $data);
        } else {
            

            if($_FILES['image']['name'] != null){ // check wheiter image is exist					
                // configurasi upload
                $configurasi['upload_path']          = './uploads/users/';
                $configurasi['allowed_types']        = 'jpg|png|jpeg';
                $configurasi['max_size']             = 2048;
                $configurasi['file_name'] = 'user-'.date('YmdHis');
            
                // do the upload
                $this->upload->initialize($configurasi, TRUE);
            
                if (!$this->upload->do_upload('image')){ //if upload failed
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('users/user_form_edit',$error);
                }
                else{ //if upload image success

                    $data['image'] = $this->upload->data('file_name'); //get image name
            
                    $this->user_m->update($data, $post['userid']);
                    if($this->db->affected_rows() > 0){
                        echo "<script>
                            alert('Data berhasil disimpan');
                            window.location = '".site_url('users')."';
                        </script>";
                    }
                } 
                
            } else{
                $this->user_m->update($data, $post['userid']);
                if($this->db->affected_rows() > 0){
                    echo "<script>
                        alert('Data berhasil disimpan');
                        window.location = '".site_url('users')."';
                    </script>";
                }
            }
        }
    }

    public function username_check(){
		$post = $this->input->post(null, true);
		$query = $this->user_m->username_check($post['username'], $post['userid']);

		if ($query->num_rows() > 0 ){
			$this->form_validation->set_message('username_check', '{field} ini sudah digunakan, silahkan ganti.');
			return FALSE;
		} else {
			return TRUE;
		}
		
	}

    public function userprofile(){
        $data = array(
            'active_menu' => 'users',
            'row' => $this->user_m->get($this->session->userdata('userid'))->row(),
        );
		$this->template->load('template-customer', 'users/user_profile', $data);
    }

    public function updatemyprofile(){
        $post = $this->input->post(null, true);

        $data = array(
            'fullname' => $post['fullname'],
            'username' => $post['username'],
            
            'nohp' => $post['nohp']
        );

        $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
		$this->form_validation->set_message('min_length', '{field} minimal {param} karakter.');
		$this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
		$this->form_validation->set_message('is_unique', '{field} sudah digunakan, silahkan ganti.');
		$this->form_validation->set_message('matches', '{field} tidak sesuai dengan kata sandi, silahkan ganti.'); 
        
        $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'trim|required|min_length[3]|max_length[40]');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[20]|callback_username_check');
        // $this->form_validation->set_rules('password', 'Kata Sandi', 'trim|required|min_length[4]|max_length[20]');
        $this->form_validation->set_rules('nohp', 'No. HP', 'trim|required|min_length[11]|max_length[15]');

        if($post['password']){
            $this->form_validation->set_rules('password', 'Kata Sandi', 'trim|required|min_length[4]|max_length[20]');
            $this->form_validation->set_rules('passconf', 'Konfirmasi Sandi', 'trim|required|matches[password]');
            $data['password'] = sha1($post['password']);
        }

        if($post['passconf']){
            $this->form_validation->set_rules('passconf', 'Konfirmasi Sandi', 'trim|required|matches[password]');
        }

        if ($this->form_validation->run() == FALSE){
            $data = array(
                'active_menu' => 'users',
                'row' => $this->user_m->get($post['userid'])->row(),
            );
            $this->template->load('template','users/user_profile', $data);
        } else {
            

            if($_FILES['image']['name'] != null){ // check wheiter image is exist					
                // configurasi upload
                $configurasi['upload_path']          = './uploads/users/';
                $configurasi['allowed_types']        = 'jpg|png|jpeg';
                $configurasi['max_size']             = 2048;
                $configurasi['file_name'] = 'user-'.date('YmdHis');
            
                // do the upload
                $this->upload->initialize($configurasi, TRUE);
            
                if (!$this->upload->do_upload('image')){ //if upload failed
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('users/user_profile',$error);
                }
                else{ //if upload image success

                    $data['image'] = $this->upload->data('file_name'); //get image name
            
                    $this->user_m->update($data, $post['userid']);
                    if($this->db->affected_rows() > 0){
                        echo "<script>
                            alert('Data berhasil disimpan');
                            window.location = '".site_url('users/userprofile')."';
                        </script>";
                    }
                } 
                
            } else{
                $this->user_m->update($data, $post['userid']);
                if($this->db->affected_rows() > 0){
                    echo "<script>
                        alert('Data berhasil disimpan');
                        window.location = '".site_url('users/userprofile')."';
                    </script>";
                }
            }
        }
    }

    
}
