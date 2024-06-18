<?php
class M_angkringan extends CI_model{

    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }

    public function tampil_data_angkringan()
    {
        $this->db->select('*');
        $this->db->from('menu');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function search_menu($keyword) {
        $this->db->like('NAMA_MENU', $keyword);
        return $this->db->get('menu')->result_array();
    }
    public function get_menu_by_angkringan_id($id_angkringan)
    {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('id_angkringan', $id_angkringan);
        $query = $this->db->get();
        return $query->result_array();
    }

}
?>