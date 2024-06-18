<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Upload extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_menu');
        $this->load->library('upload');
        $this->load->library('session');
        $this->load->model('M_login');
 // Load library session
    }

    public function index()
    {
        $this->load->view('tambah_menu');
    }

    public function process_upload()
    {
        $username = $this->session->userdata('username');
        $karyawan_id = $this->M_login->get_karyawan_id($username);
        $id_angkringan = $this->M_login->get_angkringan_id_by_karyawan_id($karyawan_id);
        

        // Pastikan id_angkringan tidak null sebelum dimasukkan ke database
        if (!$id_angkringan) {
            // Jika id_angkringan tidak ditemukan atau session tidak valid
            $this->session->set_flashdata('error', 'Gagal mengambil ID angkringan dari sesi');
            redirect(base_url('upload'));
        }

        // Konfigurasi upload
        $config['upload_path'] = './assets/images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 10240; // Ukuran maksimum dalam kilobita
        $config['encrypt_name'] = TRUE; // Enkripsi nama file

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('gambar')) { // 'gambar' sesuai dengan name pada input file
            // Jika upload gagal, tampilkan pesan error
            $data['error'] = $this->upload->display_errors();
            $this->load->view('tambah_menu', $data);
        } else {
            // Jika upload berhasil, ambil data form
            $upload_data = $this->upload->data();
            $nama_menu = $this->input->post('nama_menu');
            $harga_menu = $this->input->post('harga');
            $stock_menu = $this->input->post('stock');
            $foto_menu = 'assets/images/' . $upload_data['file_name']; // 'file_name' untuk mengambil nama file

            // Masukkan data ke database menggunakan model M_menu
            $data_menu = array(
                'NAMA_MENU' => $nama_menu,
                'ID_ANGKRINGAN' => $id_angkringan,
                'HARGA_MENU' => $harga_menu,
                'STOCK_MENU' => $stock_menu,
                'FOTO_MENU' => $foto_menu
            );

            // Debugging: log data yang akan dimasukkan
            log_message('debug', 'Data menu yang dimasukkan: ' . print_r($data_menu, true));

            $this->M_menu->insert_menu($data_menu);

            // Redirect atau tampilkan view sukses upload
            $this->session->set_flashdata('success', 'Menu berhasil ditambahkan');
            redirect(base_url('tampil/index')); // Menggunakan base_url untuk mengarahkan kembali ke halaman tampil
        }
    }
}
?>
