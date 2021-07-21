<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JasaMontir extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->model('User_M', 'user_m');
        $this->load->model('motor_m');
        $this->load->model('rekening_m');
        $this->load->model('jasamontir_m');
        date_default_timezone_set('Asia/Jakarta');
    	
	}

    public function mymontirorders(){
        $userid = $this->session->userdata('userid');
        $data = array(
            'active_menu' => 'jasa-montir',
            'result' => $this->jasamontir_m->getByUserId($userid)->result()
        );

        $this->template->load('template-customer','montirorders/customer-order-list',$data);

    }

    public function allmontirorders(){
        $data = array(
            'active_menu' => 'jasa-montir',
            'result' => $this->jasamontir_m->get()->result()
        );

        $this->template->load('template','montirorders/all-customer-order-list',$data);

    }

    public function orderMontir(){
        $data = array(
            'active_menu' => 'jasa-montir',
            'motors' => $this->motor_m->get()->result(),
            'datarekening' => $this->rekening_m->get()->result()
        );
        // echo json_encode($data);

        // exit();
		$this->template->load('template-customer', 'montirorders/customer-order-montir', $data);

    }

    public function submitmyorder(){
        $post = $this->input->post(null, true);

        // $this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[40]');
        // $this->form_validation->set_rules('nohp', 'No. HP', 'trim|required|numeric|max_length[15]');
        $this->form_validation->set_rules('alamatlengkap', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('orderdate', 'Tanggal Booking', 'trim|required');
        $this->form_validation->set_rules('jam', 'Jam Booking', 'trim|required|callback_orderdate_check');
		$this->form_validation->set_rules('idmerk', 'Merk Motor', 'trim|required');
        $this->form_validation->set_rules('idrekening', 'Rekening Pembayaran', 'trim|required');
        $this->form_validation->set_rules('type', 'Type Motor', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('kendala', 'Kendala', 'trim|required');

        $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
        $this->form_validation->set_message('numeric', '{field} harus berupa angka');
		$this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');

        if ($this->form_validation->run() == FALSE){
            $data = array(
                'active_menu' => 'jasa-montir',
                'motors' => $this->motor_m->get()->result(),
                'datarekening' => $this->rekening_m->get()->result()
            );
            $this->template->load('template-customer', 'montirorders/customer-order-montir', $data);
        }
        else{

            $tglBooking = $post['orderdate'].' '.$post['jam'];

            $postData = array(
                // 'nama' => $post['nama'],
                'userid' => $this->session->userdata('userid'),
                // 'nohp' => $post['nohp'],
                'alamatlengkap' => $post['alamatlengkap'],
                'orderdate' => $tglBooking,
                'idmerk' => $post['idmerk'],
                'type' => $post['type'],
                'kendala' => $post['kendala'],
                'idrekening' => $post['idrekening'],
                'status' => 'menunggu pembayaran',
                'created_at' => date("Y-m-d H:i:s")
            );

            $this->jasamontir_m->add($postData);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
                redirect('jasamontir/mymontirorders');
            }  
        }
    
    }

    public function updatemyorder(){
        $post = $this->input->post(null, true);

        // $this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[40]');
        // $this->form_validation->set_rules('nohp', 'No. HP', 'trim|required|numeric|max_length[15]');
        $this->form_validation->set_rules('alamatlengkap', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('orderdate', 'Tanggal Booking', 'trim|required');
        $this->form_validation->set_rules('jam', 'Jam Booking', 'trim|required|callback_orderdate_check');
		$this->form_validation->set_rules('idmerk', 'Merk Motor', 'trim|required');
        $this->form_validation->set_rules('idrekening', 'Rekening Pembayaran', 'trim|required');
        $this->form_validation->set_rules('type', 'Type Motor', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('kendala', 'Kendala', 'trim|required');

        $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
        $this->form_validation->set_message('numeric', '{field} harus berupa angka');
		$this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');

        if ($this->form_validation->run() == FALSE){
            $data = array(
                'active_menu' => 'jasa-montir',
                'motors' => $this->motor_m->get()->result(),
                'datarekening' => $this->rekening_m->get()->result()
            );
            $this->template->load('template-customer', 'montirorders/customer-update-order-montir', $data);
        }
        else{

            $tglBooking = $post['orderdate'].' '.$post['jam'];

            $postData = array(
                // 'nama' => $post['nama'],
                'userid' => $this->session->userdata('userid'),
                // 'nohp' => $post['nohp'],
                'alamatlengkap' => $post['alamatlengkap'],
                'orderdate' => $tglBooking,
                'idmerk' => $post['idmerk'],
                'type' => $post['type'],
                'kendala' => $post['kendala'],
                'idrekening' => $post['idrekening']
            );

            $this->jasamontir_m->update($postData, $post['id']);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
                redirect('jasamontir/mymontirorders');
            }  
        }
    
    }

    public function edit($id){

        $data = array(
            'active_menu' => 'jasa-montir',
            'motors' => $this->motor_m->get()->result(),
            'datarekening' => $this->rekening_m->get()->result(),
            'row' => $this->jasamontir_m->get($id)->row()
        );
		$this->template->load('template-customer', 'montirorders/customer-update-order-montir', $data);

    }


    public function getformbayar($id){
        $query = $this->jasamontir_m->get($id)->row();

        $time = DateTime::createFromFormat('Y-m-d H:i:s', $query->orderdate);
        $time->modify('+30 minutes');

        $data = array(
            'active_menu' => 'jasa-montir',
            'data' => $query,
            'deadline' => $time
        );

        
        // echo json_encode($data);

        // exit();
		$this->template->load('template-customer', 'montirorders/customer-upload-resi', $data);
    }


    public function submitresi(){

        $post = $this->input->post(null, true);
        // echo json_encode($post);
        // exit();
        $configurasi['upload_path']          = './uploads/resi/';
        $configurasi['allowed_types']        = 'jpg|png|jpeg';
        $configurasi['max_size']             = 2048;
        $configurasi['file_name'] = 'resi-'.$post['id'].date('YmdHis');
    
        // do the upload
        $this->upload->initialize($configurasi, TRUE);
    
        if (!$this->upload->do_upload('image')){ //if upload failed
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('montirorders/customer-upload-resi',$error);
        }
        else{ //if upload image success

            $postData = array(
                'resi' => $this->upload->data('file_name'),
                'status' => 'menunggu konfirmasi pembayaran'
            );

            // echo json_encode($postData);
            // exit();
    
            $this->jasamontir_m->update($postData, $post['id']);
            if($this->db->affected_rows() > 0){
                echo "<script>
                    alert('Data berhasil disimpan');
                    window.location = '".site_url('jasamontir/mymontirorders')."';
                </script>";
            }
        } 
    }

    public function lihatbuktibayar($id){
        $query = $this->jasamontir_m->get($id)->row();

        $time = DateTime::createFromFormat('Y-m-d H:i:s', $query->orderdate);
        $time->modify('+30 minutes');

        $data = array(
            'active_menu' => 'jasa-montir',
            'data' => $query,
            'deadline' => $time
        );

        $this->template->load('template', 'montirorders/form-acc-pembayaran', $data);
    }

    public function accpembayaran(){
        $post = $this->input->post(null, true);
        $postData = array(
            'status' => 'pembayaran diterima'
        );
        $this->jasamontir_m->update($postData, $post['id']);
        if($this->db->affected_rows() > 0){
            echo "<script>
                alert('Data berhasil disimpan');
                window.location = '".site_url('jasamontir/allmontirorders')."';
            </script>";
        }
    }

    public function reportmontirorders(){
        $data = array(
            'active_menu' => 'report-jasa-montir',
            'result' => $this->jasamontir_m->getByMonth(date('n'))->result()
        );
        
        $this->template->load('template','report/report-customer-order-montir',$data);
    }

    public function reportmontirbymonth(){
        $post = $this->input->post(null, true);
        $data = array(
            'active_menu' => 'report-jasa-montir',
            'result' => $this->jasamontir_m->getByMonth($post['month'])->result()
        );

        $this->template->load('template','report/report-customer-order-montir',$data);
    }

    public function orderdate_check(){
		$post = $this->input->post(null, true);
        $tglBooking = $post['orderdate'].' '.$post['jam'];
		$query = $this->jasamontir_m->orderdate_check($tglBooking);

		if ($query->num_rows() > 0 ){
			$this->form_validation->set_message('orderdate_check', '{field} ini sudah penuh');
			return FALSE;
		} else {
			return TRUE;
		}
	}

    public function jadwalmontir(){
        $data = array(
            'result' => $this->jasamontir_m->get()->result()
        );
        $this->load->view('jadwal_montir', $data);
    }
    
    public function cancel($id){
        $postData = array(
            'status' => 'batal order'
        );

        $this->jasamontir_m->update($postData, $id);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
            redirect('jasamontir/mymontirorders');
        } 

    }

    public function sendmontir($id){
        $query = $this->jasamontir_m->get($id)->row();
        $data = array(
            'active_menu' => 'jasa-montir',
            'data' => $query
        );

        $this->template->load('template', 'montirorders/form-kirim-montir', $data);
    }

    public function postsendmontir(){
        $post = $this->input->post(null, true);

        $postData = array(
            'namamontir' => $post['namamontir'],
            'status' => 'kirim montir'
        );

        $this->jasamontir_m->update($postData, $post['id']);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
            redirect('jasamontir/allmontirorders');
        }  
    }
    
}
