<?php
class Tampil extends CI_controller
{
    public function index()
    {
        $this->load->model('M_angkringan');
        $data['menu'] = $this->M_angkringan->tampil_data_angkringan();
        $this->load->helper('url', 'file');
        //print_r($data["menu"]);
        
        $data['grouped_menu'] = [];
        foreach ($data['menu'] as $menu_item) 
        {
            $data['grouped_menu'][$menu_item['NAMA_MENU']][] = $menu_item;
        }
        $this->load->view('v_tampil', $data);
        
    }

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('M_angkringan');
    }

    public function stock_menu()
    {
        $this->load->model('M_angkringan');
        $data['menu'] = $this->M_angkringan->tampil_data_angkringan();
        $this->load->helper('url', 'file');
        //print_r($data["menu"]);
        
        $data['grouped_menu'] = [];
        foreach ($data['menu'] as $menu_item) 
        {
            $data['grouped_menu'][$menu_item['NAMA_MENU']][] = $menu_item;
        }
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

    public function tambah_menu()
    {
        $this->load->view('tambah_menu');
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