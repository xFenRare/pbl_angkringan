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
    
    <p class="main_text_segmen_menu"><i class="fa fa-users" ></i> KARYAWAN <a href="tambah_karyawan" class="tombol_tambah_menu"> TAMBAH KARYAWAN</a></p>
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

        function confirmDelete(id) {
        var modal = document.getElementById('deleteModal');
        modal.style.display = 'block';
        document.getElementById('deleteConfirmButton').onclick = function() {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '<?php echo site_url('Tampil/hapus_karyawan/'); ?>' + id;

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'confirm';
            input.value = 'true';
            form.appendChild(input);

            document.body.appendChild(form);
            form.submit();
        };
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }

    function showEditModal(id, nama, alamat, no_telp, username, password) {
    var modal = document.getElementById('editModal');
    document.getElementById('editId').value = id;
    document.getElementById('editNama').value = nama;
    document.getElementById('editAlamat').value = alamat;
    document.getElementById('editNoTelp').value = no_telp;
    document.getElementById('editUsername').value = username;
    
    modal.style.display = 'block';
}

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    function toggleDetails(id) {
    var details = document.getElementById('details_' + id);
    if (details.style.display === 'none') {
        details.style.display = 'block';
    } else {
        details.style.display = 'none';
    }
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

<div id="deleteModal" class="delete-modal">
  <div class="delete-modal_content">
    <p>emang ente yakin mau hapus ni karyawan ?</p>
    <div>
      <button class="tombol_confirm" id="deleteConfirmButton">iya, gw yakin</button>
      <button class="tombol_batal" onclick="closeDeleteModal()">gak jadi deh wkwk</button>
    </div>
  </div>
</div>

<div id="editModal" class="edit-modal">
  <div class="edit-modal_content">
    <form method="post" action="<?php echo site_url('Tampil/update_karyawan'); ?>">
        
        <input class="input_edit_karyawan" type="hidden" id="editId" name="id_karyawan">
        <p>Nama:</p>
        <input class="input_edit_karyawan" type="text" id="editNama" name="nama_karyawan">
        <p>Alamat:</p>
        <input class="input_edit_karyawan" type="text" id="editAlamat" name="alamat">
        <p>No Telepon:</p>
        <input class="input_edit_karyawan" type="text" id="editNoTelp" name="no_telp">
        <p>Username:</p>
        <input class="input_edit_karyawan" type="text" id="editUsername" name="username">
        <p>Password:</p>
        <input class="input_edit_karyawan" type="password" id="editPassword" name="password">
        <div>
            <button class="tombol_confirm" type="submit">Simpan</button>
            <button class="tombol_batal" type="button" onclick="closeEditModal()">Batal</button>
        </div>
    </form>
  </div>
</div>


<label class="container_lagi">
    <label class="container_label_karyawan_admin">
<p class="nama_karyawan_admin">Nama Karyawan</p>
<p class="edit_karyawan_admin">Edit</p>
<p class="hapus_karyawan_admin">Hapus</p>

        <label class="label_karyawan_admin">
            <div class="container_tabel_karyawan_admin">
                <table class="tabel_karyawan_admin">

                <?php foreach ($karyawan as $k) : ?>
                    <tr>
    <td>
        <p class="isi_nama_karyawan_admin"><a href="javascript:void(0);" onclick="toggleDetails('<?php echo $k->ID_KARYAWAN; ?>')"><i class='fas fa-angle-right'></i></a> <?php echo $k->NAMA_KARYAWAN; ?></p>
        <div id="details_<?php echo $k->ID_KARYAWAN; ?>" clASS="details" style="display: none;">
            <table class="tabel_detail_karyawan">
                <tr>
                    <td class="data_karyawan">Alamat:</td>
                    <td class="data_karyawan_database"><?php echo $k->ALAMAT_KARYAWAN; ?></td>
                </tr>
                <tr>
                    <td class="data_karyawan">No Telepon:</td>
                    <td class="data_karyawan_database"><?php echo $k->NO_TELP_KARYAWAN; ?></td>
                </tr>
                <tr>
                    <td class="data_karyawan">Username:</td>
                    <td class="data_karyawan_database"><?php echo $k->USERNAME; ?></td>
                </tr>

            </table>
        </div>
    </td>
    <td>
        <a class="tombol_edit" href="#" onclick="showEditModal('<?php echo $k->ID_KARYAWAN; ?>', '<?php echo $k->NAMA_KARYAWAN; ?>', '<?php echo $k->ALAMAT_KARYAWAN; ?>', '<?php echo $k->NO_TELP_KARYAWAN; ?>', '<?php echo $k->USERNAME; ?>', '<?php echo $k->PASSWORD; ?>')"><i class="fa fa-pencil"></i></a>
    </td>
    <td>
        <a class="tombol_edit" href="javascript:void(0);" onclick="confirmDelete(<?php echo $k->ID_KARYAWAN; ?>)"><i class="fa fa-trash"></i></a>
    </td>
</tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </label>
    </label>
</label>

    <p class="Copyright">Copyright © Kelompok-4 PBL 2024</p>

</body>
</html>