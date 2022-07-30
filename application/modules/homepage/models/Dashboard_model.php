<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

    public function __construct()
	{
		parent::__construct();
    }

    public function getDaftarJembatan(){
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get('jembatan');
        return $query->result_array();
    }

}