<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Angkringan PBL</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/styles.css'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .nama_kasir[disabled="disabled"] {
            background-color: #f0f0f0;
            /* Atur warna latar belakang untuk disabled */
        }

        .nama_kasir:not([disabled="disabled"]) {
            background-color: #ffffff;
            /* Atur warna latar belakang untuk non-disabled */
        }

        #suggestions {
            position: absolute;
            background-color: #EDE6C4;
            border: 1px solid #black;
            max-height: 150px;
            overflow-y: auto;
            width: calc(63.2%);
            /* Adjust width based on parent element */
            z-index: 1000;
            /* Ensure it appears on top of other elements */
            display: none;
            /* Initially hide suggestions */
            margin-left: 65px;
            margin-top: 45px;
        }

        #suggestions li {
            list-style-type: none;
            padding: 8px 12px;
            cursor: pointer;
        }

        #suggestions li:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body class="main_body">
    
    <!-- HTML Content -->
    <div class="header_container">
        <div class="main_header">
            <div class="container_main_title">
                <img class="main_title" src="<?php echo base_url('assets/images/main_title.png'); ?>" />
            </div>
        </div>
    </div>

    <label for="toggleMenu" id="menuLabel" onclick="saveMenuStatus()">
        <input type="checkbox" id="toggleMenu">
        <div class="toggle">
            <span class="top_line common"></span>
            <span class="middle_line common"></span>
            <span class="bottom_line common"></span>
        </div>
        <p class="main_text_segmen_menu"><i class="fa fa-bookmark"></i> PESANAN </p>
        <div class="slide_menu">
            <div class="menu_content">
                <ul>
                    <li><a href="index" onclick="closeMenu()"><i class="fa fa-bars"></i>MENU</a></li>
                    <li><a href="stock_menu_karyawan" onclick="closeMenu()"> <i class="fa fa-archive"></i>STOCK MENU</a></li>
                    <li><a href="pesanan_karyawan" onclick="closeMenu()"> <i class="fa fa-bookmark"></i>PESANAN</a></li>
                    <li><a href="riwayat_karyawan" onclick="closeMenu()"> <i class="fas fa-clipboard-list"></i>RIWAYAT</a></li>
                    <li><a href="#" onclick="showLogoutModal()" id="logoutButton"> <i class="fa fa-sign-out"></i>LOG OUT</a></li>
                </ul>
            </div>
        </div>
    </label>

    <div id="logoutModal" class="logout-option">
        <div class="logout-option_content">
            <p>Apakah Anda yakin ingin Log Out dari Akun ini?</p>
            <div>
                <a class="tombol_confirm" type="button" href="<?php echo site_url('login/index'); ?>" id="confirmLogout">ya, aku mau Keluar</a>
                <button class="tombol_batal" id="cancelLogout" onclick="closeModal()">gak jadi deh</button>
            </div>
        </div>
    </div>
    <script>
        function saveMenuStatus() {
            var isChecked = document.getElementById('toggleMenu').checked;
            sessionStorage.setItem('menuOpen', isChecked ? 'true' : 'false');
        }

        window.addEventListener(
            'click', function (event) {
                var modal = document.getElementById('logoutModal');
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            }
        );

        window.addEventListener(
            'DOMContentLoaded', function () {
                var menuOpen = sessionStorage.getItem('menuOpen');
                if (menuOpen === 'true') {
                    document.getElementById('toggleMenu').checked = true;
                }
            }
        );

        var modal = document.getElementById('logoutModal');

        document.getElementById('confirmLogout').addEventListener('click', function () {
            window.location.href = "<?php echo base_url('log_in.php'); ?>";
        });

        document.getElementById('logoutButton').addEventListener('click', function () {
            modal.style.display = 'block';
        });

        document.getElementById('cancelLogout').addEventListener('click', function () {
            modal.style.display = 'none';
        });

        document.getElementById('confirmLogout').addEventListener('click', function () {
            logout();
        });

        window.addEventListener('click', function (event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        });

        function showLogoutModal() {
            document.getElementById('logoutModal').style.display = 'block';
        }

        function hideLogoutModal() {
            document.getElementById('logoutModal').style.display = 'none';
        }

        function logout() {
            window.location.href = "<?php echo base_url('log_in.php'); ?>";
        }

        function closeModal() {
            document.getElementById('logoutModal').style.display = 'none';
        }
    </script>

    <label class="container_kasir_n_pembeli">
        <p class="text_kasir_n_pembeli">Nama Kasir</p>
        <input class="nama_kasir" type="text" value="<?php echo $nama_karyawan; ?>" disabled>

        <p class="text_kasir_n_pembeli">Nama Pembeli</p>
        <input type="text" class="nama_pembeli">
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
                    <td>
                        <p>Pesanan</p>
                    </td>
                    <td>
                        <p>Jumlah</p>
                    </td>
                    <td>
                        <p>Hapus</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="isi_tabel_total_bayar">Total Bayar</p>
                    </td>
                    <td>
                        <p class="isi_tabel_total_harga">Rp. </p>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                    <p><a class="tombol_buat_pesanan" href="#" onclick="buatPesanan()">Buat Pesanan</a></p>
                    </td>
                    <td></td>
                </tr>
            </table>
        </div>
    </label>

    <div class="Copyright">
        <p>Copyright © Kelompok-4 PBL 2024</p>
    </div>

    <script>
    let menuList = [];
    let menus = [];


    // Fungsi untuk mendapatkan data menu dari backend (contoh penggunaan fetch)
    fetch("<?php echo base_url('get_menu'); ?>")
        .then(response => response.json())
        .then(data => {
            menuList = data.map(menu => ({
                nama_menu: menu.nama_menu,
                stock_menu: menu.stock_menu,
                harga_menu: menu.harga_menu
            }));
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
            if (menu.nama_menu.toLowerCase().includes(value.toLowerCase())) {
                suggestionItems += `<li onclick="selectMenu('${menu.nama_menu}')">${menu.nama_menu}</li>`;
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
    const jumlah = document.getElementById('jumlah_menu').value.trim();
    

    // Validasi input
    if (namaMenu === '' || jumlah === '') {
        alert('Nama Menu dan Jumlah harus diisi');
        return;
    }

    if (isNaN(jumlah) || parseInt(jumlah) <= 0) {
        alert('Jumlah harus berupa angka yang lebih besar dari 0');
        return;
    }

    const jumlahInt = parseInt(jumlah);

    if (jumlahInt > 1000) {
        alert('Jumlah tidak boleh lebih dari 1000');
        return;
    }

    const menu = menuList.find(menu => menu.nama_menu === namaMenu);
    if (!menu) {
        alert('Menu tidak ditemukan');
        return;
    }

    if (jumlahInt > menu.stock_menu) {
        alert('Jumlah melebihi stok yang tersedia');
        return;
    }
    const isMenuExist = menus.some(function (menu) {
        return menu.nama === namaMenu;
    });

    if (isMenuExist) {
        alert("Menu sudah ditambahkan."); // Pesan peringatan
        return;
    }

    // Tambahkan menu ke array menus
    menus.push({ nama: namaMenu, jumlah: jumlahInt });
    
    const orderTable = document.getElementById('order_table');
    const newRow = orderTable.insertRow(orderTable.rows.length - 2);

    const cell1 = newRow.insertCell(0);
    const cell2 = newRow.insertCell(1);
    const cell3 = newRow.insertCell(2);

    cell1.innerHTML = `<p class="isi_tabel_makanan">${namaMenu}</p>`;
    cell2.innerHTML = `<p class="isi_tabel_jumlah">${jumlah}</p>`;
    cell3.innerHTML = `<p><a href="#" onclick="deleteOrder(this)"><i class="fa fa-trash"></i></a></p>`;

    // Reset nilai input
    document.getElementById('nama_menu').value = '';
    document.getElementById('jumlah_menu').value = '';

    calculateTotal();
}

    function deleteOrder(row) {
        const rowIndex = row.parentNode.parentNode.parentNode.rowIndex;
        document.getElementById('order_table').deleteRow(rowIndex);
        calculateTotal();
    }

    function calculateTotal() {
        const rows = document.querySelectorAll('#order_table tr:not(:last-child)');
        let totalBayar = 0;

        rows.forEach(row => {
            const jumlahElement = row.querySelector('.isi_tabel_jumlah');

            if (jumlahElement) {
                const jumlah = parseInt(jumlahElement.textContent);

                if (!isNaN(jumlah)) {
                    const namaMenu = row.querySelector('.isi_tabel_makanan').textContent.trim();
                    const menu = menuList.find(menu => menu.nama_menu === namaMenu);

                    if (menu) {
                        const hargaMenu = parseFloat(menu.harga_menu);
                        totalBayar += hargaMenu * jumlah;
                    }
                }
            }
        });

        const totalBayarElement = document.querySelector('.isi_tabel_total_harga');
        totalBayarElement.textContent = `Rp. ${totalBayar.toFixed(2)}`;
    }

    function buatPesanan() {
        const namaPembeli = document.querySelector('.nama_pembeli').value.trim();
    
    // Validasi input nama pembeli
    if (namaPembeli === '') {
        alert('Nama pembeli harus diisi');
        return;
    }
    
        const orderRows = document.querySelectorAll('#order_table tr:not(:last-child)');
    let orders = [];
    let totalBayar = 0;

    orderRows.forEach(row => {
        const namaMenuElement = row.querySelector('.isi_tabel_makanan');
        const jumlahElement = row.querySelector('.isi_tabel_jumlah');

        if (namaMenuElement && jumlahElement) {
            const namaMenu = namaMenuElement.textContent.trim();
            const jumlah = parseInt(jumlahElement.textContent);

            if (namaMenu && jumlah) {
                orders.push({ nama_menu: namaMenu, jumlah: jumlah });
                const menu = menuList.find(menu => menu.nama_menu === namaMenu);
                if (menu) {
                    totalBayar += menu.harga_menu * jumlah;
                }
            }
        }
    });
 
    
   
    const orderData = {
        nama_pembeli: namaPembeli,
        total_pembelian: totalBayar,
        orders: orders
    };

    fetch("<?php echo base_url('MenuController/buat_pesanan'); ?>", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(orderData)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.id_pemesanan) {
            alert('Pesanan berhasil dibuat');

            // Reset input nama pembeli
            document.querySelector('.nama_pembeli').value = '';

            // Hapus semua baris pesanan dari tabel
            const orderTable = document.getElementById('order_table');
            const rowCount = orderTable.rows.length - 3; // Menghitung jumlah baris pesanan
            for (let i = 0; i < rowCount; i++) {
                orderTable.deleteRow(1); // Hapus baris ke-1 (indeks 0) setiap kali
            }

            // Reset total bayar
            document.querySelector('.isi_tabel_total_harga').textContent = 'Rp. 0.00';
        } else {
            alert('Gagal membuat pesanan: ' + (data.error || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat membuat pesanan: ' + error.message);
    });
}


</script>
</body>

</html>
