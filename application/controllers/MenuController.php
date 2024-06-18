<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenuController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MenuModel');
    }

    public function get_menu()
    {
        $result = $this->MenuModel->get_all_menus();
        echo json_encode($result);
    }
    public function buat_pesanan()
{
    $order_data = $this->input->post('order_data'); // Ambil data pesanan dari POST request

    // Panggil method create_order dari MenuModel untuk membuat pesanan
    $id_pemesanan = $this->MenuModel->create_order($order_data);

    // Response JSON untuk memberitahu ID pemesanan yang baru saja dibuat
    $response = array(
        'id_pemesanan' => $id_pemesanan,
        'message' => 'Pesanan berhasil dibuat'
    );

    echo json_encode($response);
}

}
?>
