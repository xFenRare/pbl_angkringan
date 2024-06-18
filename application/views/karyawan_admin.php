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


    
    <p class="main_text_segmen_menu"><i class="fa fa-users" ></i> KARYAWAN <a href="tambah_menu" class="tombol_tambah_menu"> TAMBAH KARYAWAN</a></p>

        <div class="slide_menu">
            <div class="menu_content">


                
                    <ul>
            
                    
                        <li><a href="stock_menu_admin" onclick="closeMenu()"> <i class="fa fa-archive" ></i>STOCK MENU</a></li>
                        <li><a href="riwayat_admin" onclick="closeMenu()"> <i class="fas fa-clipboard-list" ></i>RIWAYAT</a></li>
                        <li><a href="karyawan_admin" onclick="closeMenu()"> <i class="fa fa-users" ></i>KARYAWAN</a></li>
                        

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
    
      <a class="tombol_confirm" type="button" href="<?php echo site_url('login/index'); ?>"  id="confirmLogout">ya, aku mau Keluar</a>
      <button class="tombol_batal" id="cancelLogout" onclick="closeModal()">gak jadi deh</button>

    </div>
  </div>
</div>

<p class="nama_karyawan_admin">Nama Karyawan</p>
<p class="edit_karyawan_admin">Edit</p>
<p class="hapus_karyawan_admin">Hapus</p>
<label class="container_lagi">
    <label class="container_label_karyawan_admin">
        <label class="label_karyawan_admin">
            <div class="container_tabel_karyawan_admin">
                <table class="tabel_karyawan_admin">
    
                    <tr>
    
                        <td>
                            <p class="isi_nama_karyawan_admin">(Nama Karyawan)</p>
                        </td>
    
                        <td>
                            <a class="tombol_edit" href="#"><i class="fa fa-pencil"></i></a>
                        </td>
    
                        <td>
                            <a class="tombol_edit" href="#"><i class="fa fa-trash"></i></a>
                        </td>
    
                    </tr>

                </table>
            </div>
    
    
        </label>
    </label>

</label>

    <p class="Copyright">Copyright © Kelompok-4 PBL 2024</p>


    


    