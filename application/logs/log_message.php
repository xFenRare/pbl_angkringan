if ($this->Menu_model->insert_menu($data)) {
    log_message('info', 'Data menu berhasil dimasukkan: ' . $this->db->last_query());
    $this->session->set_flashdata('success', 'Menu berhasil ditambahkan!');
} else {
    log_message('error', 'Gagal memasukkan data menu: ' . $this->db->last_query());
    $this->session->set_flashdata('error', 'Gagal menambahkan menu ke database.');
}
