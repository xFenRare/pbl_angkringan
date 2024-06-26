<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenuController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MenuModel');
        $this->load->model('M_login');
    }

    public function get_menu()
    {
        $result = $this->MenuModel->get_all_menus();
        echo json_encode($result);
    }

    public function buat_pesanan()
    {
        header('Content-Type: application/json');
        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input) {
            echo json_encode(['error' => 'Invalid JSON']);
            return;
        }

        // Validasi data
        $nama_pembeli = $input['nama_pembeli'];
        $total_pembelian = $input['total_pembelian'];
        $orders = $input['orders'];

        // Ambil ID_KARYAWAN dari session
        $username = $this->session->userdata('username');
        $id_karyawan = $this->M_login->get_karyawan_id($username);

        if (!$id_karyawan) {
            echo json_encode(['error' => 'ID_KARYAWAN is required']);
            return;
        }

        // Cek stok sebelum menyimpan pesanan
        foreach ($orders as $order) {
            if (!$this->MenuModel->check_stock($order)) {
                echo json_encode(['error' => 'Stok untuk menu ' . $order['nama_menu'] . ' tidak mencukupi']);
                return;
            }
        }

        // Lakukan penyimpanan ke dalam database
        $result = $this->MenuModel->create_order($input);

        if (isset($result['error'])) {
            echo json_encode(['error' => $result['error']]);
        } else {
            echo json_encode(['id_pemesanan' => $result['id_pemesanan'], 'message' => $result['message']]);
        }
    }
}
?>
