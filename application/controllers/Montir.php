<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Montir extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('montir_m');
		$this->load->library('form_validation');
		isLogout();
    }

	public function index(){
        $data = array(
            'active_menu' => 'montir',
            'data' => $this->montir_m->get()->result()
        );
		$this->template->load('template', 'montir/montir-data', $data);
    }

    public function add(){
        $data = array(
            'active_menu' => 'montir'
        );
		$this->template->load('template', 'montir/montir-add', $data);
    }

    public function edit($id){
        $data = array(
            'active_menu' => 'montir',
            'data' => $this->montir_m->get($id)->row()
        );
		$this->template->load('template', 'montir/montir-edit', $data);
	}

    public function simpan(){
		$post = $this->input->post(null, true);

		$this->form_validation->set_rules('namamontir', 'Nama Montir', 'trim|required|max_length[40]');
        $this->form_validation->set_rules('nohp', 'Nomor Handphone', 'trim|required|numeric|max_length[15]');
		
        $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
        $this->form_validation->set_message('numeric', '{field} harus berupa angka.');
		$this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');

        if ($this->form_validation->run() == FALSE){
            $data = array(
                'active_menu' => 'montir'
            );
            $this->template->load('template', 'montir/montir-add', $data);
        }
        else{
            $data = array(
                'namamontir' => $post['namamontir'],
                'nohp' => $post['nohp'],
                'is_deleted' => 0
            );

            $this->montir_m->add($data);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
            }
            redirect('montir/index');	
        }
		
    }

    public function update(){
		$post = $this->input->post(null, true);

		$this->form_validation->set_rules('namamontir', 'Nama Montir', 'trim|required|max_length[40]');
        $this->form_validation->set_rules('nohp', 'No. HP', 'trim|required|numeric|max_length[15]');
		
        $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
        $this->form_validation->set_message('numeric', '{field} harus berupa angka.');
		$this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');

        if ($this->form_validation->run() == FALSE){
            $data = array(
                'active_menu' => 'montir',
                'data' => $this->montir_m->get($post['id'])->row()
            );
            $this->template->load('template', 'montir/montir-edit', $data);
        }
        else{
            $data = array(
                'namamontir' => $post['namamontir'],
                'nohp' => $post['nohp'],
                'is_deleted' => 0
            );

            $this->montir_m->update($data, $post['id']);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
            }
            redirect('montir/index');	
        }
		
    }
    
    public function delete($id){
		$this->montir_m->delete($id);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('danger', 'Data telah dihapus');			
        }
		
		redirect('montir/index');
	}

}
