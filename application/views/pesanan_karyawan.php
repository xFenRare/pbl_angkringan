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

        <p class="main_text_segmen_menu"><i class="fa fa-bookmark" ></i> PESANAN </p>
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
              function saveMenuStatus()
            {
                var isChecked = document.getElementById('toggleMenu').checked;
                sessionStorage.setItem('menuOpen', isChecked ? 'true' : 'false');
            }

            window.addEventListener
            (
                'click', function(event) 
                    {
                        var modal = document.getElementById('logoutModal');
                        if (event.target == modal) 
                        {
                            modal.style.display = 'none';
                        }
                    }
            );

            window.addEventListener
            (  
                'DOMContentLoaded', function ()
                {
                    var menuOpen = sessionStorage.getItem('menuOpen');
                    if (menuOpen === 'true') 
                    {
                        document.getElementById('toggleMenu').checked = true;
                    }
                }
            );

            var modal = document.getElementById('logoutModal');

            document.getElementById('confirmLogout').addEventListener('click', function() 
            {
                window.location.href = "<?php echo base_url('log_in.php'); ?>";
            });

        

            document.getElementById('logoutButton').addEventListener('click', function () 
            {
                modal.style.display = 'block';
            });

            document.getElementById('cancelLogout').addEventListener('click', function () 
            {
                modal.style.display = 'none';
            });

            document.getElementById('confirmLogout').addEventListener('click', function () 
            {
                logout();
            });

            window.addEventListener('click', function (event) 
            {
                if (event.target == modal) 
                {
                    modal.style.display = 'none';
                }
            });

            function showLogoutModal() 
            {
                document.getElementById('logoutModal').style.display = 'block';
            }

            function hideLogoutModal() 
            {
                document.getElementById('logoutModal').style.display = 'none';
            }

            function logout() 
            {
                window.location.href = "<?php echo base_url('log_in.php'); ?>";
            }

            function closeModal() 
            {
                document.getElementById('logoutModal').style.display = 'none';
            }



        </script>

    <div id="logoutModal" class="logout-option">
      <div class="logout-option_content">
        <p>Apakah Anda yakin ingin Log Out dari Akun ini?</p>
        <div>
        
          <a class="tombol_confirm" type="button" href="log_in"  id="confirmLogout">ya, aku mau Keluar</a>
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
            <input type="text" class="input_nama_menu" placeholder="Nama Menu">
            <input type="text" class="input_tambah_jumlah" placeholder="Jumlah">
            <a href="#" class="tombol_tambah_pesanan"><i class="fa fa-plus-square"></i> Tambah</a>
        </div>


    <label class="label_pesanan">
        <div class="container_tabel_pesanan">
            <table class="tabel_pesanan">

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
                        <p class="isi_tabel_makanan">(Nama Makanan)</p>
                    </td>
                    <td>
                        <p class="isi_tabel_jumlah">(Jumlah Makanan)</p>
                    </td>
                    <td>
                        <p><a href="#"><i class="fa fa-trash"></i></a></p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <p class="isi_tabel_total_bayar">Total Bayar</p>
                    </td>
                    <td>
                        <p class="isi_tabel_total_harga">Rp. </p>
                    </td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <td>
                        <p><a class="tombol_buat_pesanan" href="#">Buat Pesanan</a></p>
                    </td>
                    <td>
                    </td>
                    
                </tr>
                </table>
                </div>


                </label>

                <div class="Copyright">
                    <p>Copyright © Kelompok-4 PBL 2024</p>
                </div>

    </body>
</html>