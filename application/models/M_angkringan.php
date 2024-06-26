<?php
class M_angkringan extends CI_model{

    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }

    public function tampil_data_angkringan()
    {
        $this->db->select('*');
        $this->db->from('menu');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function search_menu($keyword) {
        $this->db->like('NAMA_MENU', $keyword);
        return $this->db->get('menu')->result_array();
    }

    public function get_menu_by_angkringan_id($id_angkringan)
    {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('id_angkringan', $id_angkringan);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_karyawan()
    {
        // Mendapatkan id_angkringan dari session pengguna yang sedang login
        $username = $this->session->userdata('username');
        $id_angkringan = $this->M_login->get_angkringan_id($username);
    
        // Jika id_angkringan ditemukan, ambil data karyawan berdasarkan id_angkringan
        if ($id_angkringan) {
            $this->db->where('id_angkringan', $id_angkringan);
            $query = $this->db->get('karyawan');
            return $query->result();
        } else {
            return []; // Mengembalikan array kosong jika id_angkringan tidak ditemukan
        }
    }

    public function update_karyawan($id, $data) {
        if (isset($data['password'])) {
            $password = $data['password'];
            unset($data['password']);
            $this->db->set('password', $password);
        }
    
        $this->db->where('id_karyawan', $id);
        $this->db->update('karyawan', $data);
    }

    public function tambah_data_karyawan($data)
{
    return $this->db->insert('karyawan', $data);
}

public function update_menu($id, $data)
{
    $this->db->where('ID_MENU', $id);
    $this->db->update('menu', $data);
}


public function tampil_data_pemesanan_by_karyawan($id_karyawan) {
    $this->db->select('pemesanan.ID_PEMESANAN, pemesanan.NAMA_PEMBELI, karyawan.NAMA_KARYAWAN, pemesanan.TOTAL_PEMBELIAN, detail_pesanan.NAMA_MENU, detail_pesanan.jumlah');
    $this->db->from('pemesanan');
    $this->db->join('karyawan', 'pemesanan.ID_KARYAWAN = karyawan.ID_KARYAWAN');
    $this->db->join('detail_pesanan', 'pemesanan.ID_PEMESANAN = detail_pesanan.ID_PEMESANAN');
    $this->db->where('karyawan.ID_karyawan', $id_karyawan);
    $query = $this->db->get();

    $result = array();
    foreach ($query->result_array() as $row) {
        if (!isset($result[$row['ID_PEMESANAN']])) {
            $result[$row['ID_PEMESANAN']] = array(
                'ID_PEMESANAN' => $row['ID_PEMESANAN'],
                'NAMA_PEMBELI' => $row['NAMA_PEMBELI'],
                'NAMA_KARYAWAN' => $row['NAMA_KARYAWAN'],
                'TOTAL_PEMBELIAN' => $row['TOTAL_PEMBELIAN'],
                'detail_pesanan' => array()
            );
        }
        $result[$row['ID_PEMESANAN']]['detail_pesanan'][] = array(
            'NAMA_MENU' => $row['NAMA_MENU'],
            'jumlah' => $row['jumlah']
        );
    }

    return array_values($result);
}

public function tampil_data_pemesanan_by_angkringan($id_angkringan) {
    $this->db->select('pemesanan.ID_PEMESANAN, pemesanan.NAMA_PEMBELI, karyawan.NAMA_KARYAWAN, pemesanan.TOTAL_PEMBELIAN, detail_pesanan.NAMA_MENU, detail_pesanan.jumlah');
    $this->db->from('pemesanan');
    $this->db->join('karyawan', 'pemesanan.ID_KARYAWAN = karyawan.ID_KARYAWAN');
    $this->db->join('detail_pesanan', 'pemesanan.ID_PEMESANAN = detail_pesanan.ID_PEMESANAN');
    $this->db->where('karyawan.ID_ANGKRINGAN', $id_angkringan);
    $query = $this->db->get();

    $result = array();
    foreach ($query->result_array() as $row) {
        if (!isset($result[$row['ID_PEMESANAN']])) {
            $result[$row['ID_PEMESANAN']] = array(
                'ID_PEMESANAN' => $row['ID_PEMESANAN'],
                'NAMA_PEMBELI' => $row['NAMA_PEMBELI'],
                'NAMA_KARYAWAN' => $row['NAMA_KARYAWAN'],
                'TOTAL_PEMBELIAN' => $row['TOTAL_PEMBELIAN'],
                'detail_pesanan' => array()
            );
        }
        $result[$row['ID_PEMESANAN']]['detail_pesanan'][] = array(
            'NAMA_MENU' => $row['NAMA_MENU'],
            'jumlah' => $row['jumlah']
        );
    }

    return array_values($result);
}
public function hapus_pemesanan($id_pemesanan)
{
    // Lakukan operasi penghapusan pemesanan berdasarkan $id_pemesanan
    
        // Hapus dari tabel 'detail_pemesanan' terlebih dahulu jika ada ketergantungan
        $this->db->where('id_pemesanan', $id_pemesanan);
        $this->db->delete('detail_pesanan');
    
        // Setelah itu, hapus dari tabel 'pemesanan'
        $this->db->where('id_pemesanan', $id_pemesanan);
        $this->db->delete('pemesanan');
        return $this->db->affected_rows() > 0;
    
    
   
}







}
?>