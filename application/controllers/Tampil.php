<?php
class Tampil extends CI_controller
{
    public function index()
    {
        $this->load->view('v_tampil');
        $this->load->helper('url', 'file');
        
    }

    public function stock_menu()
    {
        $this->load->view('stock_menu');
        $data["menu"] = $this->M_angkringan->tampil_data_angkringan();
        $this->load->helper('url', 'file');
        print_r($data["menu"]);
        

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

    public function log_in()
    {
        $this->load->view('log_in');
        $this->load->helper('url', 'file');
        
    }

    public function daftar()
    {
        $this->load->view('daftar');
        $this->load->helper('url', 'file');
        
    }

}

?>