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
        // Memastikan pengguna sudah login
        if (!$this->session->userdata('username') || !$this->session->userdata('login')) {
            redirect('login');
        }

        // Mengambil semua data karyawan sesuai dengan id_angkringan yang login
        $data['karyawan'] = $this->M_angkringan->get_all_karyawan();

        // Memuat view karyawan_admin.php dengan data karyawan
        $this->load->view('karyawan_admin', $data);
    }

    public function riwayat_admin()
    {
        $username = $this->session->userdata('username');
        $id_angkringan = $this->M_login->get_angkringan_id($username);

        // Cek apakah username berasal dari karyawan
        if (!$id_angkringan) {
            $id_karyawan = $this->M_login->get_karyawan_id($username);
            if ($id_karyawan) {
                $id_angkringan = $this->M_login->get_angkringan_id_by_karyawan_id($id_karyawan);
            }
        }

        if ($id_angkringan) {
            $data['pemesanan'] = $this->M_angkringan->tampil_data_pemesanan_by_angkringan($id_angkringan);
            $this->load->view('riwayat_admin', $data);
        } else {
            // Handle case where no angkringan id was found
            $data['pemesanan'] = [];
            $this->load->view('riwayat_admin', $data);
        }
    }

    public function riwayat_karyawan() {
        $username = $this->session->userdata('username');
        $id_karyawan = $this->M_login->get_karyawan_id($username);
    
        if ($id_karyawan) {
            $data['pemesanan'] = $this->M_angkringan->tampil_data_pemesanan_by_karyawan($id_karyawan);
            $this->load->view('riwayat_karyawan', $data);
        } else {
            // Handle case where no karyawan id was found
            $data['pemesanan'] = [];
            $this->load->view('riwayat_karyawan', $data);
        }
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

    public function update_karyawan()
    {
        $id = $this->input->post('id_karyawan');
        $data = array(
            'nama_karyawan' => $this->input->post('nama_karyawan'),
            'alamat_karyawan' => $this->input->post('alamat'),
            'no_telp_karyawan' => $this->input->post('no_telp'),
            'username' => $this->input->post('username')
        );

        $password = md5($this->input->post('password'));
        if (!empty($password)) {
            $data['password'] = $password;
        }

        $this->M_angkringan->update_karyawan($id, $data);
        redirect('Tampil/karyawan_admin');
    }


    public function hapus_karyawan($id)
    {
        if ($this->input->post('confirm') === 'true') {
            $this->db->where('id_karyawan', $id);
            $this->db->delete('karyawan');
        }
        redirect('Tampil/karyawan_admin');
    }

    public function tambah_karyawan()
    {
        $this->load->view('tambah_karyawan');
        $this->load->helper('url', 'file');

    }

    public function update_menu()
    {
        $id = $this->input->post('id_menu');
        $data = array(
            'NAMA_MENU' => $this->input->post('nama_menu'),
            'HARGA_MENU' => $this->input->post('harga_menu'),
            'STOCK_MENU' => $this->input->post('stock_menu')
        );
    
        if (!empty($_FILES['foto_menu']['name'])) {
            $config['upload_path'] = './assets/images/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['file_name'] = time() . '_' . $_FILES['foto_menu']['name'];  // Rename file to avoid overwriting
    
            $this->load->library('upload', $config);
    
            if ($this->upload->do_upload('foto_menu')) {
                $uploadData = $this->upload->data();
                $data['FOTO_MENU'] = 'assets/images/' . $uploadData['file_name'];
    
                // Update data in database
                $this->M_angkringan->update_menu($id, $data);
                redirect('Tampil/stock_menu_karyawan'); // Redirect to stock_menu_admin after update
            } else {
                $error = $this->upload->display_errors();
                // Handle upload error
                echo $error;
            }
        } else {
            // Update data in database without changing the photo
            $this->M_angkringan->update_menu($id, $data);
            redirect('Tampil/stock_menu_karyawan'); // Redirect to stock_menu_admin after update
        }
    }
    
    public function hapus_pesanan($id_pemesanan)
{
    // Pastikan request datang dari POST
    if ($this->input->server('REQUEST_METHOD') === 'POST') {
        // Lakukan penghapusan pemesanan berdasarkan $id_pemesanan
        $result = $this->M_angkringan->hapus_pemesanan($id_pemesanan);

        if ($result) {
            // Redirect atau kirim response sukses
            echo json_encode(['success' => 'Pesanan berhasil dihapus']);
            redirect('Tampil/riwayat_admin');
        } else {
            // Kirim response error jika gagal menghapus
            echo json_encode(['error' => 'Gagal menghapus pesanan']);
        }
    } else {
        // Kirim response error jika bukan request POST
        echo json_encode(['error' => 'Metode request tidak diizinkan']);
    }
}

   
}

?>