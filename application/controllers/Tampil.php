<?php
class Tampil extends CI_controller
{
    public function index()
    {
        
        // Memeriksa apakah pengguna sudah login
    if (!$this->session->userdata('username') || !$this->session->userdata('login')) {
        redirect('login'); // Redirect ke halaman login jika belum login
    }

    // Memeriksa apakah yang login adalah angkringan atau karyawan
    if ($this->session->userdata('login') == 'oke') {
        // Jika yang login adalah angkringan, ambil data menu berdasarkan ID angkringan yang terkait dengan pengguna
        $angkringan_id = $this->M_login->get_angkringan_id($this->session->userdata('username'));
        if ($angkringan_id) {
            $data['menu'] = $this->M_angkringan->get_menu_by_angkringan_id($angkringan_id);
        } else {
            // Tampilkan pesan error atau redirect ke halaman lain jika tidak ditemukan ID angkringan
            redirect('login'); // Contoh, redirect ke halaman login jika ada masalah
        }
    } elseif ($this->session->userdata('login') == 'karyawan') {
        // Jika yang login adalah karyawan, ambil data menu dari semua angkringan (sesuai kebijakan)
        $data['menu'] = $this->M_angkringan->tampil_data_angkringan();
    } else {
        // Redirect ke halaman login jika tipe login tidak valid (sebagai langkah pengamanan)
        redirect('login');
    }

    // Mengelompokkan data menu berdasarkan NAMA_MENU
    $data['grouped_menu'] = [];
    foreach ($data['menu'] as $menu_item) {
        $data['grouped_menu'][$menu_item['NAMA_MENU']][] = $menu_item;
    }

    // Memuat view stock_menu.php dengan data menu yang telah dikelompokkan
    $this->load->view('v_tampil', $data);

    }

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_angkringan');
    }

    public function stock_menu()
    {
        // Memeriksa apakah pengguna sudah login
    if (!$this->session->userdata('username') || !$this->session->userdata('login')) {
        redirect('login'); // Redirect ke halaman login jika belum login
    }

    // Memeriksa apakah yang login adalah angkringan atau karyawan
    if ($this->session->userdata('login') == 'oke') {
        // Jika yang login adalah angkringan, ambil data menu berdasarkan ID angkringan yang terkait dengan pengguna
        $angkringan_id = $this->M_login->get_angkringan_id($this->session->userdata('username'));
        if ($angkringan_id) {
            $data['menu'] = $this->M_angkringan->get_menu_by_angkringan_id($angkringan_id);
        } else {
            // Tampilkan pesan error atau redirect ke halaman lain jika tidak ditemukan ID angkringan
            redirect('login'); // Contoh, redirect ke halaman login jika ada masalah
        }
    } elseif ($this->session->userdata('login') == 'karyawan') {
        // Jika yang login adalah karyawan, ambil data menu dari semua angkringan (sesuai kebijakan)
        $data['menu'] = $this->M_angkringan->tampil_data_angkringan();
    } else {
        // Redirect ke halaman login jika tipe login tidak valid (sebagai langkah pengamanan)
        redirect('login');
    }

    // Mengelompokkan data menu berdasarkan NAMA_MENU
    $data['grouped_menu'] = [];
    foreach ($data['menu'] as $menu_item) {
        $data['grouped_menu'][$menu_item['NAMA_MENU']][] = $menu_item;
    }

    // Memuat view stock_menu.php dengan data menu yang telah dikelompokkan
    $this->load->view('stock_menu', $data);

    }

    public function pesanan()
    {
        $this->load->view('pesanan');
        $this->load->helper('url', 'file');


    }

    public function karyawan()
    {
        $this->load->view('karyawan');
        $this->load->helper('url', 'file');

    }

    public function riwayat()
    {
        $this->load->view('riwayat');
        $this->load->helper('url', 'file');

    }


    public function log_in()
    {
        $this->load->view('log_in');
        $this->load->helper('url', 'file');

    }

    public function v_daftar()
    {
        $this->load->view('v_daftar');
        $this->load->helper('url', 'file');

    }

}

?>