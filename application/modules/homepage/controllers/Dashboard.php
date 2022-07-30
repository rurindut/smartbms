<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    var $data;
	
	public function __construct()
	{
		parent::__construct();
        $this->load->model('homepage/dashboard_model','dashboard_model');
	}

	public function index()
	{
		$this->data['page_title'] = "Dashboard";
		$this->data['jembatan'] = $this->dashboard_model->getDaftarJembatan();
		$this->render_page('homepage/dashboard',$this->data);
    }
	
}