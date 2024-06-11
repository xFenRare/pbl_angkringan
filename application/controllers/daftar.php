<?php

class Daftar extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('M_daftar');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }

    public function index(){
        $this->load->view('v_daftar');
    }

    public function process_daftar(){
        // Aturan validasi form
        $this->form_validation->set_rules('nama_angkringan', 'Nama Angkringan', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_telp_angkringan', 'No Telp', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('v_daftar');
        } else {
            $data = array(
                'nama_angkringan' => $this->input->post('nama_angkringan'),
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')), // Enkripsi password dengan md5
                'alamat' => $this->input->post('alamat'),
                'no_telp_angkringan' => $this->input->post('no_telp_angkringan')
            );

            $insert = $this->M_daftar->insert_data($data);

            if ($insert) {
                $this->session->set_flashdata('success', 'Pendaftaran berhasil, silakan login.');
                redirect(base_url('login'));
            } else {
                $this->session->set_flashdata('error', 'Pendaftaran gagal, silakan coba lagi.');
                $this->load->view('v_daftar');
            }
        }
    }
}
?>
