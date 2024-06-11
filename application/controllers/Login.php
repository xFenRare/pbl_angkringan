<?php

class Login extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_login');  // Load model M_login
    }

    public function index(){
        $this->load->view('v_login');
    }

    public function login_aksi(){
        // Mengambil input dari form dengan metode POST
        $user = $this->input->post('username', true);
        $pass = md5($this->input->post('password', true));

        // Aturan validasi form
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run() != FALSE){
            $where = array(
                'username' => $user,
                'password' => $pass
            );

            // Cek login dari model
            $cek_login_angkringan = $this->M_login->cek_login_angkringan($where);
            $cek_login_karyawan = $this->M_login->cek_login_karyawan($where);

            if($cek_login_angkringan->num_rows() > 0){
                $sess_data = array(
                    'username' => $user,
                    'login' => 'oke'
                );

                // Mengatur data sesi
                $this->session->set_userdata($sess_data);

                // Redirect ke halaman tampil/stock_menu
                redirect(base_url('tampil/stock_menu'));
            } elseif ($cek_login_karyawan->num_rows() > 0) {
                $sess_data = array(
                    'username' => $user,
                    'login' => 'oke'
                );

                // Mengatur data sesi
                $this->session->set_userdata($sess_data);

                // Redirect ke halaman tampil/karyawan
                redirect(base_url('tampil/karyawan'));
            } else {
                $this->session->set_flashdata('error', 'Username atau password salah!'); 
                redirect(base_url("login"));
            }
        } else {
            // Menampilkan halaman login kembali jika validasi gagal
            $this->load->view('v_login');
        }
    }
}
?>
