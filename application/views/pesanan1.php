


<label class="container_kasir_n_pembeli">
        <p class="text_kasir_n_pembeli">Nama Kasir</p>
        <select class="nama_kasir">
            <option class="nama_kasir" value="option1">Karyawan 1</option>
            <option class="nama_kasir" value="option2">Karyawan 2</option>
            <option class="nama_kasir" value="option3">Karyawan 3</option>
        </select>
        <p class="text_kasir_n_pembeli">Nama Pembeli</p><input type="text" class="nama_pembeli">
    </label>

    <div class="input_container">
        <input type="text" class="input_nama_menu" placeholder="Nama Menu" id="nama_menu" oninput="showSuggestions(this.value)">
        <ul id="suggestions"></ul>
        <input type="text" class="input_tambah_jumlah" placeholder="Jumlah" id="jumlah_menu">
        <a href="#" class="tombol_tambah_pesanan" onclick="addOrder()"><i class="fa fa-plus-square"></i> Tambah</a>
    </div>

    <label class="label_pesanan">
        <div class="container_tabel_pesanan">
            <table class="tabel_pesanan" id="order_table">
                <tr>
                    <td><p>Pesanan</p></td>
                    <td><p>Jumlah</p></td>
                    <td><p>Hapus</p></td>
                </tr>
            </table>
        </div>
    </label>


<script>
        let menuList = [];

        // Fetch menu data from the backend
        fetch("<?php echo base_url('get_menu'); ?>")
            .then(response => response.json())
            .then(data => {
                menuList = data.map(menu => menu.nama_menu);
            });

        function showSuggestions(value) {
            const suggestions = document.getElementById('suggestions');
            if (value.length === 0) {
                suggestions.innerHTML = '';
                suggestions.style.display = 'none';
                return;
            }

            let suggestionItems = '';
            menuList.forEach(menu => {
                if (menu.toLowerCase().includes(value.toLowerCase())) {
                    suggestionItems += `<li onclick="selectMenu('${menu}')">${menu}</li>`;
                }
            });

            suggestions.innerHTML = suggestionItems;
            suggestions.style.display = suggestionItems ? 'block' : 'none';
        }
        function selectMenu(menu) {
    document.getElementById('nama_menu').value = menu;
    document.getElementById('suggestions').style.display = 'none';
}

function addOrder() {
        const namaMenu = document.getElementById('nama_menu').value.trim();
        const jumlahMenu = document.getElementById('jumlah_menu').value.trim();

        // Validasi input
        if (namaMenu === '' || jumlahMenu === '') {
            alert('Harap masukkan nama menu dan jumlah dengan benar.');
            return;
        }

        // Periksa apakah nama menu ada di daftar menu
        if (!menuList.includes(namaMenu)) {
            alert(`Menu '${namaMenu}' tidak ada dalam daftar menu.`);
            return;
        }

        // Tambahkan pesanan ke tabel pesanan
        const orderTable = document.getElementById('order_table');
        const newRow = orderTable.insertRow();
        newRow.innerHTML = `
            <td><p>${namaMenu}</p></td>
            <td><p>${jumlahMenu}</p></td>
            <td><p><a href="#" onclick="deleteOrder(this)"><i class="fa fa-trash"></i></a></p></td>
        `;

        // Bersihkan input setelah pesanan ditambahkan
        document.getElementById('nama_menu').value = '';
        document.getElementById('jumlah_menu').value = '';
    }

    // Fungsi untuk menghapus baris pesanan dari tabel
    function deleteRow(button) {
        const row = button.closest('tr');
        row.remove();
    }

function deleteOrder(row) {
    const rowIndex = row.parentNode.parentNode.parentNode.rowIndex;
    document.getElementById('order_table').deleteRow(rowIndex);
    calculateTotal();
}

function calculateTotal() {
    const rows = document.querySelectorAll('#order_table tr');
    let total = 0;

    for (let i = 1; i < rows.length - 1; i++) { // start from 1 to skip header and end before last row
        const jumlah = parseInt(rows[i].querySelector('.isi_tabel_jumlah').innerText.trim());
        total += jumlah;
    }

    document.querySelector('.isi_tabel_total_harga').innerText = `Rp. ${total.toLocaleString()}`;
}
</script>
