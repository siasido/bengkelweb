<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JasaService extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->model('User_M', 'user_m');
        $this->load->model('motor_m');
        $this->load->model('rekening_m');
        $this->load->model('jasaservice_m');
        date_default_timezone_set('Asia/Jakarta');
        
		
	}

    public function myservicelist(){
        $userid = $this->session->userdata('userid');
        $data = array(
            'active_menu' => 'service-motor',
            'result' => $this->jasaservice_m->getByUserId($userid)->result()
        );

        $this->template->load('template-customer','service-motor/my-service-list',$data);

    }

    public function allservicebooking(){
        $data = array(
            'active_menu' => 'service',
            'result' => $this->jasaservice_m->get()->result()
        );

        $this->template->load('template','service-motor/all-customer-service-list',$data);

    }

    public function bookingservice(){
        $data = array(
            'active_menu' => 'service-motor',
            'motors' => $this->motor_m->get()->result(),
            'datarekening' => $this->rekening_m->get()->result()
        );
        // echo json_encode($data);

        // exit();
		$this->template->load('template-customer', 'service-motor/customer-booking-service', $data);

    }

    public function updatestatus($id){
        $data = array(
            'active_menu' => 'service',
            // 'motors' => $this->motor_m->get()->result(),
            // 'datarekening' => $this->rekening_m->get()->result(),
            'row' => $this->jasaservice_m->get($id)->row()
        );
		$this->template->load('template', 'service-motor/update-status-pengerjaan', $data);
    }

    public function submitmybooking(){
        $post = $this->input->post(null, true);

        // $this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[40]');
        // $this->form_validation->set_rules('nohp', 'No. HP', 'trim|required|numeric|max_length[15]');
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
            $this->template->load('template-customer', 'service-motor/customer-booking-service', $data);
        }
        else{

            $tglBooking = $post['orderdate'].' '.$post['jam'];

            $postData = array(
                // 'nama' => $post['nama'],
                'userid' => $this->session->userdata('userid'),
                // 'nohp' => $post['nohp'],
                'orderdate' => $tglBooking,
                'idmerk' => $post['idmerk'],
                'type' => $post['type'],
                'kendala' => $post['kendala'],
                'idrekening' => $post['idrekening'],
                'status' => 'menunggu pembayaran',
                'created_at' => date("Y-m-d H:i:s")
            );

            $this->jasaservice_m->add($postData);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
                redirect('jasaservice/myservicelist');
            }  
        }
    
    }

    public function edit($id){

        $data = array(
            'active_menu' => 'service-motor',
            'motors' => $this->motor_m->get()->result(),
            'datarekening' => $this->rekening_m->get()->result(),
            'row' => $this->jasaservice_m->get($id)->row()
        );
		$this->template->load('template-customer', 'service-motor/customer-update-service', $data);

    }

    public function updatemybooking(){
        $post = $this->input->post(null, true);

        // $this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[40]');
        // $this->form_validation->set_rules('nohp', 'No. HP', 'trim|required|numeric|max_length[15]');
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
            $this->template->load('template-customer', 'service-motor/customer-booking-service', $data);
        }
        else{

            $tglBooking = $post['orderdate'].' '.$post['jam'];

            $postData = array(
                // 'nama' => $post['nama'],
                'userid' => $this->session->userdata('userid'),
                // 'nohp' => $post['nohp'],
                'orderdate' => $tglBooking,
                'idmerk' => $post['idmerk'],
                'type' => $post['type'],
                'kendala' => $post['kendala'],
                'idrekening' => $post['idrekening'],
                'status' => 'menunggu pembayaran'
            );

            $this->jasaservice_m->update($postData,$post['id']);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
                redirect('jasaservice/myservicelist');
            }  
        }
    
    }

    public function updatestatuspengerjaan(){
        $post = $this->input->post(null, true);
        // print_r($post);
        // exit();
        $postData = array (
            'status' => $post['status']
        );
        $this->jasaservice_m->update($postData, $post['id']);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
            redirect('jasaservice/allservicebooking');
        }  
    }



    public function getformbayar($id){
        $query = $this->jasaservice_m->get($id)->row();

        $time = DateTime::createFromFormat('Y-m-d H:i:s', $query->orderdate);
        $time->modify('+30 minutes');

        $data = array(
            'active_menu' => 'service-motor',
            'data' => $query,
            'deadline' => $time
        );

		$this->template->load('template-customer', 'service-motor/customer-upload-resi', $data);
    }


    public function submitresi(){

        $post = $this->input->post(null, true);

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
    
            $this->jasaservice_m->update($postData, $post['id']);
            if($this->db->affected_rows() > 0){
                echo "<script>
                    alert('Data berhasil disimpan');
                    window.location = '".site_url('jasaservice/myservicelist')."';
                </script>";
            }
        } 
    }

    public function lihatbuktibayar($id){
        $query = $this->jasaservice_m->get($id)->row();

        // echo json_encode($query);
        // exit();

        $time = DateTime::createFromFormat('Y-m-d H:i:s', $query->orderdate);
        $time->modify('+30 minutes');

        $data = array(
            'active_menu' => 'service',
            'data' => $query,
            'deadline' => $time
        );

        $this->template->load('template', 'service-motor/form-acc-pembayaran', $data);
    }

    public function accpembayaran(){
        $post = $this->input->post(null, true);
        $postData = array(
            'status' => 'pembayaran diterima',
            'statusbayar' => 1
        );
        $this->jasaservice_m->update($postData, $post['id']);
        if($this->db->affected_rows() > 0){
            echo "<script>
                alert('Data berhasil disimpan');
                window.location = '".site_url('jasaservice/allservicebooking')."';
            </script>";
        }
    }

    public function reportservicebooking(){
        $data = array(
            'active_menu' => 'report-service',
            'result' => $this->jasaservice_m->getByMonth(date('n'))->result()
        );
        
        $this->template->load('template','report/report-customer-service',$data);
    }

    public function searchreportservicebymonth(){
        $post = $this->input->post(null, true);
        $data = array(
            'active_menu' => 'report-service',
            'result' => $this->jasaservice_m->getByMonth($post['month'])->result()
        );

        $this->template->load('template','report/report-customer-service',$data);
    }

    public function orderdate_check(){
		$post = $this->input->post(null, true);
        $tglBooking = $post['orderdate'].' '.$post['jam'];
		$query = $this->jasaservice_m->orderdate_check($tglBooking);

		if ($query->num_rows() > 0 ){
			$this->form_validation->set_message('orderdate_check', '{field} ini sudah penuh');
			return FALSE;
		} else {
			return TRUE;
		}
	}

    public function jadwalservice(){
        $data = array(
            'result' => $this->jasaservice_m->get()->result()
        );
        $this->load->view('jadwal_service', $data);
    }

    public function cancel($id){
        $postData = array(
            'status' => 'batal order'
        );

        $this->jasaservice_m->update($postData, $id);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
            redirect('jasaservice/myservicelist');
        } 

    }


    
}
