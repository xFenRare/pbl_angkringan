<?php
class M_angkringan extends CI_model{


    public function tampil_data_angkringan()
    {
        $hasil = $this->db->get('menu')->result_array();
        return $hasil;
    }
}
?>