<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class MY_Controller extends MX_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}

	/*
	function tampilan view untuk halaman admin (semua page)
	*/
	public function render_page($content, $data = NULL){
		$data['userlevel'] = $this->session->userdata('userlevel');
		$data['head'] = $this->load->view('template/head', $data, TRUE);
		$data['header'] = $this->load->view('template/header', $data, TRUE);
		$data['left_panel'] = $this->load->view('template/left_panel', $data, TRUE);
        $data['isi'] = $this->load->view($content, $data, TRUE);
        $data['footer'] = $this->load->view('template/footer', $data, TRUE);
        
        $this->load->view('template/main', $data);
	}
	
	/*
	function tampilan view untuk halaman login
	*/
	public function render_login_page($content, $data = NULL){

		$data['head'] = $this->load->view('template/head', $data, TRUE);
		$data['isi'] = $this->load->view($content, $data, TRUE);
        
        $this->load->view('template/main_login', $data);
	}

}
