<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_menu extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_menu_names()
    {
        $angkringan_id = $this->M_login->get_angkringan_id($this->session->userdata('username'));
        $query = $this->db->select('nama_menu')
                          ->from('menu')
                          ->where('ID_ANGKRINGAN', $angkringan_id)
                          ->get();
        return $query->result_array();
    }

     public function is_menu_exist($nama_menu, $angkringan_id)
    {
        $query = $this->db->select('1')
                          ->from('menu')
                          ->where('nama_menu', $nama_menu)
                          ->where('ID_ANGKRINGAN', $angkringan_id)
                          ->get();
        return $query->num_rows() > 0;
    }

    public function insert_menu($data) {
        return $this->db->insert('menu', $data);
    }
}


