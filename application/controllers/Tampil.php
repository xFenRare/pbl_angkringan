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

    public function stock_menu_admin()
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
        $this->load->view('stock_menu_admin', $data);

    }

    public function stock_menu_karyawan()
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
        $this->load->view('stock_menu_karyawan', $data);

    }

    public function pesanan_karyawan()
    {
        $this->load->view('pesanan_karyawan');
        $this->load->helper('url', 'file');
        

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