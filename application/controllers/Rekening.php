<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('rekening_m');
		$this->load->library('form_validation');
		isLogout();
    }

	public function index(){
        $data = array(
            'active_menu' => 'rekening',
            'data' => $this->rekening_m->get()->result()
        );
		$this->template->load('template', 'rekening/rekening-data', $data);
    }

    public function add(){
        $data = array(
            'active_menu' => 'rekening'
        );
		$this->template->load('template', 'rekening/rekening-add', $data);
    }

    public function edit($id){
        $data = array(
            'active_menu' => 'rekening',
            'data' => $this->rekening_m->get($id)->row()
        );
		$this->template->load('template', 'rekening/rekening-edit', $data);
	}

    public function simpan(){
		$post = $this->input->post(null, true);

		$this->form_validation->set_rules('namabank', 'Nama Bank', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('norek', 'Nomor Rekening', 'trim|required|numeric|max_length[20]');
        $this->form_validation->set_rules('namaakun', 'Nama Pemilik akun', 'trim|required|max_length[40]');
		
        $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
        $this->form_validation->set_message('numeric', '{field} harus berupa angka.');
		$this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');

        if ($this->form_validation->run() == FALSE){
            $data = array(
                'active_menu' => 'rekening'
            );
            $this->template->load('template', 'rekening/rekening-add', $data);
        }
        else{
            $data = array(
                'namabank' => $post['namabank'],
                'norek' => $post['norek'],
                'namaakun' => $post['namaakun'],
                'is_deleted' => 0
            );

            $this->rekening_m->add($data);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
            }
            redirect('rekening/index');	
        }
		
    }

    public function update(){
		$post = $this->input->post(null, true);

		$this->form_validation->set_rules('namabank', 'Nama Bank', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('norek', 'Nomor Rekening', 'trim|required|numeric|max_length[20]');
        $this->form_validation->set_rules('namaakun', 'Nama Pemilik akun', 'trim|required|max_length[40]');
		
        $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
        $this->form_validation->set_message('numeric', '{field} harus berupa angka.');
		$this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');

        if ($this->form_validation->run() == FALSE){
            $data = array(
                'active_menu' => 'rekening',
                'data' => $this->rekening_m->get($post['id'])->row()
            );
            $this->template->load('template', 'rekening/rekening-edit', $data);
        }
        else{
            $data = array(
                'namabank' => $post['namabank'],
                'norek' => $post['norek'],
                'namaakun' => $post['namaakun'],
                'is_deleted' => 0
            );

            $this->rekening_m->update($data, $post['id']);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
            }
            redirect('rekening/index');	
        }
		
    }
    
    public function delete($id){
		$this->rekening_m->delete($id);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('danger', 'Data telah dihapus');			
        }
		
		redirect('rekening/index');
	}

}
