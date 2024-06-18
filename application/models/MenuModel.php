<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenuModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_menus()
{
    $id_angkringan = $this->get_angkringan_id_for_current_user(); // Mengambil id_angkringan berdasarkan karyawan yang login

    $this->db->select('id_menu, nama_menu, stock_menu, harga_menu'); // Menambahkan kolom harga_menu
    $this->db->from('menu');
    $this->db->where('id_angkringan', $id_angkringan);
    $query = $this->db->get();
    
    return $query->result();
    
    
}


    private function get_angkringan_id_for_current_user()
    {
        // Ambil username dari sesi
        $username = $this->session->userdata('username');

        // Panggil M_login untuk mendapatkan id_angkringan berdasarkan username karyawan
        $karyawan_id = $this->M_login->get_karyawan_id($username);
        if ($karyawan_id) {
            $id_angkringan = $this->M_login->get_angkringan_id_by_karyawan_id($karyawan_id);
            if ($id_angkringan) {
                return $id_angkringan;
            } else {
                // Jika tidak ditemukan id_angkringan untuk karyawan ini
                return null; // Atau lakukan penanganan kesalahan sesuai kebutuhan Anda
            }
        } else {
            // Jika tidak ditemukan karyawan dengan username ini
            return null; // Atau lakukan penanganan kesalahan sesuai kebutuhan Anda
        }
    }
    public function create_order($order_data)
{
    $id_angkringan = $this->get_angkringan_id_for_current_user(); // Ambil ID Angkringan dari model
    $waktu_pemesanan = date('Y-m-d H:i:s'); // Waktu pemesanan saat ini
    $total_pembelian = 0; // Inisialisasi total pembelian
    
    // Hitung total pembelian berdasarkan order_data yang diterima
    foreach ($order_data as $order) {
        $total_pembelian += $order['jumlah'] * $order['harga_menu'];
    }

    // Data untuk dimasukkan ke dalam tabel pemesanan
    $data = array(
        'id_angkringan' => $id_angkringan,
        'waktu_pemesanan' => $waktu_pemesanan,
        'total_pembelian' => (int)$total_pembelian // Pastikan total_pembelian diubah ke integer sebelum dimasukkan ke database
    );

    // Masukkan data ke dalam tabel pemesanan
    $this->db->insert('pemesanan', $data);
    $id_pemesanan = $this->db->insert_id(); // Ambil ID pemesanan yang baru saja dimasukkan

    // Masukkan detail pesanan ke dalam tabel pemesanan_detail
    foreach ($order_data as $order) {
        $order_detail = array(
            'id_pemesanan' => $id_pemesanan,
            'id_menu' => $order['id_menu'],
            'jumlah' => $order['jumlah']
        );
        $this->db->insert('pemesanan_detail', $order_detail);
    }

    return $id_pemesanan; // Kembalikan ID pemesanan yang baru saja dibuat
}
}
?>
