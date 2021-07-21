<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LandingPage extends CI_Controller {

	public function index()
	{
		$this->load->view('landing-page/landing-page');
	}

    public function about(){
        $this->load->view('landing-page/about-page');
    }

    public function aboutUs(){
        $this->load->view('landing-page/about-us');
    }
}
