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
    public function get_menu_by_angkringan_id($angkringan_id)
{
    $this->db->where('id_angkringan', $angkringan_id);
    $query = $this->db->get('menu'); // Pastikan tabel menu memiliki kolom 'id_angkringan' sebagai foreign key
    return $query->result_array();
}

}
?>