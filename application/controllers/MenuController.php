<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MenuController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load model yang diperlukan
        $this->load->model('M_menu');
        $this->load->model('M_login');
        
    }

    public function index()
    {
        $angkringan_id = $this->M_login->get_angkringan_id($this->session->userdata('username'));
        $data['menuList'] = $this->M_menu->get_menu_names($angkringan_id);
        $this->load->view('pesanan', $data);
    }

    public function get_menu()
    {
        $angkringan_id = $this->M_login->get_angkringan_id($this->session->userdata('username'));
        $data = $this->M_menu->get_menu_names($angkringan_id);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function check_menu()
    {
        $nama_menu = $this->input->post('nama_menu');
        $angkringan_id = $this->M_login->get_angkringan_id($this->session->userdata('username'));
        $is_exist = $this->M_menu->is_menu_exist($nama_menu, $angkringan_id);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['exists' => $is_exist]));
    }

    public function check_menu_frontend() {
        $nama_menu = $this->input->post('nama_menu');
        $angkringan_id = $this->M_login->get_angkringan_id($this->session->userdata('username'));
        $is_exist = $this->M_menu->is_menu_exist($nama_menu, $angkringan_id);
        echo json_encode(['exists' => $is_exist]);
    }
    
    
}
