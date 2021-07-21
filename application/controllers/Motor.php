<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Motor extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('motor_m');
		$this->load->library('form_validation');
		isLogout();
    }

	public function index(){
        $data = array(
            'active_menu' => 'motor',
            'data' => $this->motor_m->get()->result()
        );
		$this->template->load('template', 'motor/motor-data', $data);
    }

    public function add(){
        $data = array(
            'active_menu' => 'motor'
        );
		$this->template->load('template', 'motor/motor-add', $data);
    }

    public function edit($id){
        $data = array(
            'active_menu' => 'motor',
            'data' => $this->motor_m->get($id)->row()
        );
		$this->template->load('template', 'motor/motor-edit', $data);
	}

    public function simpan(){
		$post = $this->input->post(null, true);

		$this->form_validation->set_rules('merk', 'Merk Motor', 'trim|required|max_length[40]');
		
        $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
		$this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');

        if ($this->form_validation->run() == FALSE){
            $data = array(
                'active_menu' => 'motor'
            );
            $this->template->load('template', 'motor/motor-add', $data);
        }
        else{
            $data = array(
                'merk' => $post['merk'],
                'keterangan' => $post['keterangan'],
                'is_deleted' => 0
            );

            $this->motor_m->add($data);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
            }
            redirect('motor/index');	
        }
		
    }

    public function update(){
		$post = $this->input->post(null, true);

		$this->form_validation->set_rules('merk', 'Merk Motor', 'trim|required|max_length[40]');
		
        $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
		$this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');

        if ($this->form_validation->run() == FALSE){
            $data = array(
                'active_menu' => 'motor',
                'data' => $this->motor_m->get($post['id'])->row()
            );
            $this->template->load('template', 'motor/motor-edit', $data);
        }
        else{
            $data = array(
                'merk' => $post['merk'],
                'keterangan' => $post['keterangan'],
                'is_deleted' => 0
            );

            $this->motor_m->update($data, $post['id']);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
            }
            redirect('motor/index');	
        }
		
    }
    
    public function delete($id){
		$this->motor_m->delete($id);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('danger', 'Data telah dihapus');			
        }
		
		redirect('motor/index');
	}

}
