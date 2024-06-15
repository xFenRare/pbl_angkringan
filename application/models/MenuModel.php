<?php
class MenuModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_menus() {
        $this->db->select('id_menu, nama_menu');
        $this->db->from('menu');
        $query = $this->db->get();
        return $query->result();
    }
}
?>
