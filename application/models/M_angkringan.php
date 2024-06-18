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

    public function get_all_karyawan()
    {
        $query = $this->db->get('karyawan');
        return $query->result();
    }

    public function update_karyawan($id, $data) {
        if (isset($data['password'])) {
            $password = $data['password'];
            unset($data['password']);
            $this->db->set('password', $password);
        }
    
        $this->db->where('id_karyawan', $id);
        $this->db->update('karyawan', $data);
    }

    public function tambah_data_karyawan($data)
    {
        return $this->db->insert('karyawan', $data);
    }
    
}
?>