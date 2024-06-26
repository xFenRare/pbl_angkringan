<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenuModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('M_login'); // Load M_login model
    }

    public function get_all_menus()
    {
        $id_angkringan = $this->get_angkringan_id_for_current_user();
        $this->db->select('id_menu, nama_menu, stock_menu, harga_menu');
        $this->db->from('menu');
        $this->db->where('id_angkringan', $id_angkringan);
        $query = $this->db->get();
        
        return $query->result();
    }

    private function get_angkringan_id_for_current_user()
    {
        $username = $this->session->userdata('username');
        $karyawan_id = $this->M_login->get_karyawan_id($username);
        
        if ($karyawan_id) {
            $id_angkringan = $this->M_login->get_angkringan_id_by_karyawan_id($karyawan_id);
            if ($id_angkringan) {
                return $id_angkringan;
            } else {
                return null; // Handle error accordingly
            }
        } else {
            return null; // Handle error accordingly
        }
    }

    public function create_order($order_data)
    {
        $this->db->trans_start(); // Start transaction

        // Insert order into pemesanan table
        $data_pembelian = array(
            'ID_KARYAWAN' => $this->M_login->get_karyawan_id($this->session->userdata('username')),
            'WAKTU_PEMBELIAN' => date('Y-m-d H:i:s'),
            'NAMA_PEMBELI' => $order_data['nama_pembeli'],
            'TOTAL_PEMBELIAN' => $order_data['total_pembelian']
        );
        $this->db->insert('pemesanan', $data_pembelian);
        $id_pemesanan = $this->db->insert_id();

        // Insert order details into detail_pesanan table
        foreach ($order_data['orders'] as $order) {
            // Reduce stock in menu table
            $this->db->set('stock_menu', 'stock_menu - ' . $order['jumlah'], FALSE);
            $this->db->where('nama_menu', $order['nama_menu']);
            $this->db->update('menu');

            // Insert order detail
            $data_detail = array(
                'ID_PEMESANAN' => $id_pemesanan,
                'NAMA_MENU' => $order['nama_menu'],
                'JUMLAH' => $order['jumlah']
            );
            $this->db->insert('detail_pesanan', $data_detail);
        }

        $this->db->trans_complete(); // Complete transaction

        if ($this->db->trans_status() === FALSE) {
            return array('error' => 'Failed to save order');
        } else {
            return array('id_pemesanan' => $id_pemesanan, 'message' => 'Pesanan berhasil dibuat');
        }
    }

    public function check_stock($order)
    {
        $this->db->select('stock_menu');
        $this->db->from('menu');
        $this->db->where('nama_menu', $order['nama_menu']);
        $query = $this->db->get();
        $result = $query->row();

        if ($result && $result->stock_menu >= $order['jumlah']) {
            return true;
        } else {
            return false;
        }
    }
}
?>
