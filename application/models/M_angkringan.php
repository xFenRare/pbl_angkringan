<?php
class M_angkringan extends CI_model{

    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }

    public function tampil_data_angkringan()
    {
        $query = $this->db->get('menu');
        return $query->result_array();
    }

    public function search_menu($keyword) {
        $this->db->like('NAMA_MENU', $keyword);
        return $this->db->get('menu')->result_array();
    }
}
?>