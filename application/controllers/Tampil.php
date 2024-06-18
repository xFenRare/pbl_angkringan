<?php
class Tampil extends CI_controller
{
    public function index()
    {
        // Memeriksa apakah pengguna sudah login
        if (!$this->session->userdata('username') || !$this->session->userdata('login')) {
            redirect('login'); // Redirect ke halaman login jika belum login
        }

        // Mengambil username dari session
        $username = $this->session->userdata('username');

        if ($this->session->userdata('login') == 'oke') {
            // Jika yang login adalah angkringan, ambil data menu berdasarkan ID angkringan yang terkait dengan pengguna
            $angkringan_id = $this->M_login->get_angkringan_id($username);
            if ($angkringan_id) {
                $data['menu'] = $this->M_angkringan->get_menu_by_angkringan_id($angkringan_id);
            } else {
                // Tampilkan pesan error atau redirect ke halaman lain jika tidak ditemukan ID angkringan
                redirect('login'); // Contoh, redirect ke halaman login jika ada masalah
            }
        } elseif ($this->session->userdata('login') == 'karyawan') {
            // Jika yang login adalah karyawan, ambil ID angkringan dari tabel karyawan
            $karyawan_id = $this->M_login->get_karyawan_id($username);
            $angkringan_id = $this->M_login->get_angkringan_id_by_karyawan_id($karyawan_id);

            if ($angkringan_id) {
                $data['menu'] = $this->M_angkringan->get_menu_by_angkringan_id($angkringan_id);
            } else {
                // Tampilkan pesan error atau redirect ke halaman lain jika tidak ditemukan ID angkringan
                redirect('login'); // Contoh, redirect ke halaman login jika ada masalah
            }
        } else {
            // Redirect ke halaman login jika tipe login tidak valid (sebagai langkah pengamanan)
            redirect('login');
        }

        // Mengelompokkan data menu berdasarkan NAMA_MENU
        $data['grouped_menu'] = [];
        foreach ($data['menu'] as $menu_item) {
            $data['grouped_menu'][$menu_item['NAMA_MENU']][] = $menu_item;
        }

        // Memuat view v_tampil.php dengan data menu yang telah dikelompokkan
        $this->load->view('v_tampil', $data);
    }
       

    

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_angkringan');
        $this->load->model('M_login');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Karyawan_model');
    }
    public function pesanan_karyawan()
    {
        // Mendapatkan nama karyawan dari model
        $data['nama_karyawan'] = $this->Karyawan_model->getNamaByUserName($this->session->userdata('username'));
        
        // Memuat view pesanan_karyawan.php dengan data
        $this->load->view('pesanan_karyawan', $data);
    }

    public function stock_menu_admin()
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
        $this->load->view('stock_menu_admin', $data);


    }

    public function stock_menu_karyawan()
    {
        // Memeriksa apakah pengguna sudah login
        if (!$this->session->userdata('username') || !$this->session->userdata('login')) {
            redirect('login'); // Redirect ke halaman login jika belum login
        }

        // Mengambil username dari session
        $username = $this->session->userdata('username');

        if ($this->session->userdata('login') == 'oke') {
            // Jika yang login adalah angkringan, ambil data menu berdasarkan ID angkringan yang terkait dengan pengguna
            $angkringan_id = $this->M_login->get_angkringan_id($username);
            if ($angkringan_id) {
                $data['menu'] = $this->M_angkringan->get_menu_by_angkringan_id($angkringan_id);
            } else {
                // Tampilkan pesan error atau redirect ke halaman lain jika tidak ditemukan ID angkringan
                redirect('login'); // Contoh, redirect ke halaman login jika ada masalah
            }
        } elseif ($this->session->userdata('login') == 'karyawan') {
            // Jika yang login adalah karyawan, ambil ID angkringan dari tabel karyawan
            $karyawan_id = $this->M_login->get_karyawan_id($username);
            $angkringan_id = $this->M_login->get_angkringan_id_by_karyawan_id($karyawan_id);

            if ($angkringan_id) {
                $data['menu'] = $this->M_angkringan->get_menu_by_angkringan_id($angkringan_id);
            } else {
                // Tampilkan pesan error atau redirect ke halaman lain jika tidak ditemukan ID angkringan
                redirect('login'); // Contoh, redirect ke halaman login jika ada masalah
            }
        } else {
            // Redirect ke halaman login jika tipe login tidak valid (sebagai langkah pengamanan)
            redirect('login');
        }

        // Mengelompokkan data menu berdasarkan NAMA_MENU
        $data['grouped_menu'] = [];
        foreach ($data['menu'] as $menu_item) {
            $data['grouped_menu'][$menu_item['NAMA_MENU']][] = $menu_item;
        }

        // Memuat view v_tampil.php dengan data menu yang telah dikelompokkan

        $data['menu_items'] = $this->M_angkringan->tampil_data_angkringan();

    // Kirim data ke view
    $this->load->view('stock_menu_karyawan', $data);
    }

    

    public function karyawan_admin()
    {
        $this->load->view('karyawan_admin');
        $this->load->helper('url', 'file');

    }

    public function riwayat_admin()
    {
        $this->load->view('riwayat_admin');
        $this->load->helper('url', 'file');

    }

    public function riwayat_karyawan()
    {
        $this->load->view('riwayat_karyawan');
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