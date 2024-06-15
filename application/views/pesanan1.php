<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Angkringan PBL</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/styles.css'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .input_container {
            position: relative;
        }

        #suggestions {
            position: absolute;
            top: 100%;
            left: 0;
            width: 30%;
            background-color: white;
            border: 1px solid #ccc;
            z-index: 1000;
            max-height: 150px;
            overflow-y: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: none;
        }

        #suggestions li {
            padding: 8px;
            cursor: pointer;
            list-style-type: none;
        }

        #suggestions li:hover {
            background-color: #f0f0f0;
        }

        .tabel_pesanan tr td p {
            margin: 0;
        }

        .isi_tabel_makanan,
        .isi_tabel_jumlah,
        .isi_tabel_total_bayar,
        .isi_tabel_total_harga {
            color: black;
        }

        .tabel_pesanan tr td {
            background-color: white;
        }
    </style>
</head>

<body class="main_body">
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
                    <li><a href="stock_menu" onclick="closeMenu()"> <i class="fa fa-archive"></i>STOCK MENU</a></li>
                    <li><a href="pesanan" onclick="closeMenu()"> <i class="fa fa-bookmark"></i>PESANAN</a></li>
                    <li><a href="riwayat" onclick="closeMenu()"> <i class="fas fa-clipboard-list"></i>RIWAYAT</a></li>
                    <li><a href="#" onclick="showLogoutModal()" id="logoutButton"> <i class="fa fa-sign-out"></i>LOG OUT</a></li>
                </ul>
            </div>
        </div>
    </label>
        <script>
    function saveMenuStatus() {
            var isChecked = document.getElementById('toggleMenu').checked;
            sessionStorage.setItem('menuOpen', isChecked ? 'true' : 'false');
        }

        window.addEventListener('click', function (event) {
            var modal = document.getElementById('logoutModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        });

        window.addEventListener('DOMContentLoaded', function () {
            var menuOpen = sessionStorage.getItem('menuOpen');
            if (menuOpen === 'true') {
                document.getElementById('toggleMenu').checked = true;
            }
        });

        var modal = document.getElementById('logoutModal');

        document.getElementById('confirmLogout').addEventListener('click', function () {
            window.location.href = "<?php echo base_url('v_login.php'); ?>";
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
            window.location.href = "<?php echo base_url('v_login.php'); ?>";
        }

        function closeModal() {
            document.getElementById('logoutModal').style.display = 'none';
        }
        </script>

    <div id="logoutModal" class="logout-option">
        <div class="logout-option_content">
            <p>Apakah Anda yakin ingin Log Out dari Akun ini?</p>
            <div>
                <a class="tombol_confirm" type="button" href="" id="confirmLogout">ya, aku mau Keluar</a>
                <button class="tombol_batal" id="cancelLogout" onclick="closeModal()">gak jadi deh</button>
            </div>
        </div>
    </div>

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

    <div class="Copyright">
        <p>Copyright © Kelompok-4 PBL 2024</p>
    </div>

    < <script>
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
    const jumlah = document.getElementById('jumlah_menu').value.trim();

    if (namaMenu === '' || jumlah === '') {
        alert('Nama Menu dan Jumlah harus diisi');
        return;
    }

    const orderTable = document.getElementById('order_table');
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td><p class="isi_tabel_makanan">${namaMenu}</p></td>
        <td><p class="isi_tabel_jumlah">${jumlah}</p></td>
        <td><p><a href="#" onclick="deleteOrder(this)"><i class="fa fa-trash"></i></a></p></td>
    `;
    orderTable.appendChild(newRow);

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
    const rows = document.querySelectorAll('#order_table tr');
    let total = 0;

    for (let i = 1; i < rows.length - 1; i++) { // start from 1 to skip header and end before last row
        const jumlah = parseInt(rows[i].querySelector('.isi_tabel_jumlah').innerText.trim());
        total += jumlah;
    }

    document.querySelector('.isi_tabel_total_harga').innerText = `Rp. ${total.toLocaleString()}`;
}
</script></rows.length>

</body>

</html>
