<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Angkringan PBL</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/styles.css'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="main_body" >
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
        <p class="main_text_segmen_menu"><i class="fas fa-clipboard-list"></i> RIWAYAT </p>
        <div class="slide_menu">
            <div class="menu_content">
                <ul>
                    <li><a href="stock_menu_admin" onclick="closeMenu()"><i class="fa fa-archive"></i>STOCK MENU</a></li>
                    <li><a href="riwayat_admin" onclick="closeMenu()"><i class="fas fa-clipboard-list"></i>RIWAYAT</a></li>
                    <li><a href="karyawan_admin" onclick="closeMenu()"><i class="fa fa-users"></i>KARYAWAN</a></li>
                    <li><a href="#" onclick="showLogoutModal()" id="logoutButton"><i class="fa fa-sign-out"></i>LOG OUT</a></li>
                </ul>
            </div>
        </div>
    </label>

    <script>
        function saveMenuStatus() {
            var isChecked = document.getElementById('toggleMenu').checked;
            sessionStorage.setItem('menuOpen', isChecked ? 'true' : 'false');
        }

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

        function toggleDetails(id) {
            var details = document.getElementById('details_' + id);
            if (details.style.display === "none" || details.style.display === "") {
                details.style.display = "block";
            } else {
                details.style.display = "none";
            }
        }
    </script>

    <div id="logoutModal" class="logout-option">
        <div class="logout-option_content">
            <p>Apakah Anda yakin ingin Log Out dari Akun ini?</p>
            <div>
                <a class="tombol_confirm" type="button" href="<?php echo site_url('login/index'); ?>" id="confirmLogout">ya, aku mau Keluar</a>
                <button class="tombol_batal" id="cancelLogout" onclick="closeModal()">gak jadi deh</button>
            </div>
        </div>
    </div>

    <label class="container_lagi">
        <label class="container_label_riwayat">
        <p class="nama_karyawan_admin">Nama Pembeli</p>
<p class="hapus_karyawan_admin2">Hapus</p>
            <label class="label_riwayat">
                <div class="container_tabel_riwayat">
                    <table class="tabel_riwayat">
                    <?php foreach ($pemesanan as $pesanan): ?>
    <tr>
    <td>
        <p class="isi_nama_pembeli">
            <a href="#" onclick="toggleDetails(<?php echo $pesanan['ID_PEMESANAN']; ?>)"><i class='fas fa-angle-right'></i></a>
            <?php echo isset($pesanan['NAMA_PEMBELI']) ? $pesanan['NAMA_PEMBELI'] : ''; ?>
        </p>
    </td>
    


    <td>
   
    <a class="tombol_edit" href="javascript:void(0);" onclick="confirmDeletePesanan('<?php echo $pesanan['ID_PEMESANAN']; ?>')"><i class="fa fa-trash"></i></a>


    </td>
</tr>
    <tr class="table_detail_riwayat" id="details_<?php echo $pesanan['ID_PEMESANAN']; ?>" style="display: none;">
        <td colspan="3">
            <p class="NamaKasir_riwayat">Kasir <?php echo isset($pesanan['NAMA_KARYAWAN']) ? $pesanan['NAMA_KARYAWAN'] : ''; ?></p>
            <p class="isiNama_menu_riwayat">Menu</p>
            <p class="isiNama_menu_riwayat">
            <?php if (isset($pesanan['detail_pesanan']) && is_array($pesanan['detail_pesanan'])): ?>
                <?php foreach ($pesanan['detail_pesanan'] as $detail): ?>
                    <?php echo isset($detail['NAMA_MENU']) ? $detail['NAMA_MENU'] . '<br>' : ''; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            </p>
            <p class="isiTotal_menu_riwayat">Total</p>
        </td>
        <td>
            <p><br></p>
            <p class="isiNama_menu_riwayat">Satuan</p>
            <?php if (isset($pesanan['detail_pesanan']) && is_array($pesanan['detail_pesanan'])): ?>
                <?php foreach ($pesanan['detail_pesanan'] as $detail): ?>
                    <?php echo isset($detail['jumlah']) ? $detail['jumlah'] . '<br>' : ''; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <p class="isiTotal_menu_riwayat">Rp.<?php echo isset($pesanan['TOTAL_PEMBELIAN']) ? number_format($pesanan['TOTAL_PEMBELIAN'], 0, ',', '.') : ''; ?></p>
        </td>
    </tr>
<?php endforeach; ?>

                    </table>
                </div>
            </label>
        </label>
    </label>

    <p class="Copyright">Copyright © Kelompok-4 PBL 2024</p>
    <script>
    function confirmDeletePesanan(id_pemesanan) {
    var modal = document.getElementById('deletePesananModal');
    modal.style.display = 'block';

    document.getElementById('deletePesananConfirmButton').onclick = function () {
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?php echo site_url('tampil/hapus_pesanan/'); ?>' + id_pemesanan;

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'confirm';
        input.value = 'true';
        form.appendChild(input);

        document.body.appendChild(form);
        form.submit();
    };
    
}
function closeDeletePesananModal() {
    var modal = document.getElementById('deletePesananModal');
    modal.style.display = 'none';
}
function printOrder(id_pemesanan) {
            // Contoh implementasi untuk membuka jendela pop-up cetak dengan menggunakan ID pesanan
            var url = '<?php echo site_url('cetak/pesanan/'); ?>' + id_pemesanan;
            window.open(url, '_blank');
        }
</script>
<div id="deletePesananModal" class="delete-modal">
    <div class="delete-modal_content">
        <p>Apakah Anda yakin ingin menghapus pesanan ini?</p>
        <div>
            <button class="tombol_confirm" id="deletePesananConfirmButton">Ya, Hapus</button>
            <button class="tombol_batal" onclick="closeDeletePesananModal()">Batal</button>
        </div>
    </div>
</div>

</body>
</html>