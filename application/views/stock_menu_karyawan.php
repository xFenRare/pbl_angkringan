<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Angkringan PBL</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/styles.css'); ?>" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="main_body">

<div class="header_container">
    <div class="main_header">
        <div class=container_main_title>
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
    <p class="main_text_segmen_menu"><i class="fa fa-archive" ></i> STOCK MENU <a href="<?php echo site_url('upload/index'); ?>" class="tombol_tambah_menu"> TAMBAH MENU</a></p>
    <div class="slide_menu">
        <div class="menu_content">
            <ul>
                <li><a href="index" onclick="closeMenu()"><i class="fa fa-bars" ></i>MENU</a></li>
                <li><a href="stock_menu_karyawan" onclick="closeMenu()"> <i class="fa fa-archive" ></i>STOCK MENU</a></li>
                <li><a href="pesanan_karyawan" onclick="closeMenu()"> <i class="fa fa-bookmark" ></i>PESANAN</a></li>
                <li><a href="riwayat_karyawan" onclick="closeMenu()"> <i class="fas fa-clipboard-list" ></i>RIWAYAT</a></li>
                <li><a href="#" onclick="showLogoutModal()" id="logoutButton"> <i class="fa fa-sign-out" ></i>LOG OUT</a></li>
            </ul>
        </div>
    </div>
</label>

<script>
    function saveMenuStatus() {
        var isChecked = document.getElementById('toggleMenu').checked;
        sessionStorage.setItem('menuOpen', isChecked ? 'true' : 'false');
    }

    window.addEventListener('click', function(event) {
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

    document.getElementById('confirmLogout').addEventListener('click', function() {
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

<div id="logoutModal" class="logout-option">
    <div class="logout-option_content">
        <p>Apakah Anda yakin ingin Log Out dari Akun ini?</p>
        <div>
            <a class="tombol_confirm" type="button" href="<?php echo site_url('login/index'); ?>"  id="confirmLogout">ya, aku mau Keluar</a>
            <button class="tombol_batal" id="cancelLogout" onclick="closeModal()">gak jadi deh</button>
        </div>
    </div>
</div>

<div class="card_container">
    <?php foreach ($grouped_menu as $menu_name => $menu_items) { ?>
        <?php foreach ($menu_items as $d) { ?>
            <label class="card_stockmenu">
                <h3 class="nama_menu"><?php echo $d['NAMA_MENU']; ?></h3>
                <table class="table table-bordered">
                    <tr>
                        <td>
                        <img src="<?php echo base_url($d['FOTO_MENU']); ?>" alt="Nama Gambar" width="280px" height="200px">
                            
                            <span><?php echo $d['STOCK_MENU']; ?></span>
                        </td>
                    </tr>
                </table>
                <h4 class="harga_menu">Rp<?php echo number_format($d['HARGA_MENU'], 0, ',', '.'); ?></h4>
                <a href="#" class="tombol_edit_stock" data-id="<?php echo $d['ID_MENU']; ?>" data-nama="<?php echo $d['NAMA_MENU']; ?>" data-harga="<?php echo $d['HARGA_MENU']; ?>" data-stock="<?php echo $d['STOCK_MENU']; ?>" data-foto="<?php echo $d['FOTO_MENU']; ?>" onclick="showEditMenuModal(this)">Edit Menu</a>
                <p class="kuantitas_stock_menu" data-stock="<?php echo $d['STOCK_MENU']; ?>" ></p>
            </label>
        <?php } ?>
    <?php } ?>
</div>

<div id="editMenuModal" class="modal">
    <div class="modal-content">
        <a class="close" onclick="closeEditMenuModal()">&times;</a>
        <form id="editMenuForm" action="<?php echo site_url('Tampil/update_menu'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_menu" id="edit_id_menu">
            <div class="form-group">
                <label for="edit_nama_menu">Nama Menu:</label>
                <input type="text" name="nama_menu" id="edit_nama_menu" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_harga_menu">Harga Menu:</label>
                <input type="number" name="harga_menu" id="edit_harga_menu" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_stock_menu">Stock Menu:</label>
                <input type="number" name="stock_menu" id="edit_stock_menu" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_foto_menu">Foto Menu:</label>
                <input type="file" name="foto_menu" id="edit_foto_menu" class="form-control">
                <img id="current_foto_menu" src="" alt="Current Foto Menu" class="img-thumbnail" width="500" height="500">
            </div>
            <button type="submit" class="tombol_simpan_menu">Simpan</button>
        </form>
    </div>
</div>

<p class="Copyright">Copyright © Kelompok-4 PBL 2024</p>

<script>
    
    function showEditMenuModal(element) {
        var id = element.getAttribute('data-id');
        var nama = element.getAttribute('data-nama');
        var harga = element.getAttribute('data-harga');
        var stock = element.getAttribute('data-stock');
        var foto = element.getAttribute('data-foto');

        document.getElementById('edit_id_menu').value = id;
        document.getElementById('edit_nama_menu').value = nama;
        document.getElementById('edit_harga_menu').value = harga;
        document.getElementById('edit_stock_menu').value = stock;
        document.getElementById('current_foto_menu').src = "<?php echo base_url('uploads/menu/'); ?>" + foto;

        document.getElementById('editMenuModal').style.display = 'block';
    }

    function closeEditMenuModal() {
        document.getElementById('editMenuModal').style.display = 'none';
    }



    window.onclick = function(event) {
        var modal = document.getElementById('editMenuModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 4;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
        
    }
    
    .modal-content {
        
        background-color: #fefefe;
        margin: 100px auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 40px;
        font-weight: bold;
        text-decoration: none;
        
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .tombol_simpan_menu
    {
        background-color: #28a745;
        border-radius: 5px;
        transition: 0.2s ease;
        font-weight: bold;
    }

    .tombol_simpan_menu:hover
    {
        background-color: #218838;
        transform: translateY(-3px);
    }

    .form-group
    {
        margin: 10px;
    }

    .form-group input
    {
        margin-top: 5px;
    }

    
</style>

</body>
</html>