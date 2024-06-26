<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #7C826B;
            font-family: Arial, sans-serif;
        }
        .tambah-menu {
            margin: 0 auto;
            width: 70%;
            padding: 40px;
            background-color: #EAEAEA;
            border-radius: 5px;
            margin-top: 50px;
        }
        .jdl {
            text-align: center;
            font-size: 50px;
            font-weight: lighter;
            color: #ffffff;
            margin-top: 30px;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .form-group label {
            flex: 1;
            margin-bottom: 0;
            font-weight: bold;
        }
        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group input[type="file"] {
            flex: 2;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .tambah-menu .btn {
            width: 100%;
            padding: 10px;
            margin: 5px 5px 0 0;
            border: none;
            border-radius: 3px;
            color: white;
            font-size: 16px;
        }
        .tambah-menu .tombol_kembali {
            background-color: #ff5757;
            text-decoration: none;
            color: #ffffff;
            border-radius: 3px;
            padding: 10px 80px 10px 80px;
            margin-top: 20px;
            box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);
            transition: 0.2s ease;
            border: 1.5px solid black;
        }
        .tambah-menu .tombol_simpan_karyawan {
            background-color: #007BFF;
            text-decoration: none;
            color: #ffffff;
            border-radius: 3px;
            padding: 10px 80px 10px 80px;
            margin-top: 20px;
            box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);
            transition: 0.2s ease;
        }
        .tombol_simpan_karyawan:hover {
            background-color: #141cfa;
        }
        .tombol_kembali:hover {
            background-color: #ff0000;
        }
        .tombol_simpan_karyawan:hover, .tombol_kembali:hover {
            transform: translateY(-3px);
        }
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .preview-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 200px;
            border: 2px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
            margin-top: 10px;
        }
        .preview-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }
        .input_alamat {
            padding-bottom: 70px;
        }
        .input_nama_karyawan, .input_no_telp, .input_username, .input_password {
            padding: 10px 10px 10px 0px;
        }
    </style>
</head>
<body>
    <h1 class="jdl">Tambah Karyawan</h1>
    <div class="tambah-menu">
        <form action="<?php echo site_url('karyawan/simpan_karyawan'); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama_karyawan">Nama Karyawan:</label>
                <input class="input_nama_karyawan" type="text" id="nama_karyawan" name="nama_karyawan" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input class="input_alamat" type="text" id="alamat" name="alamat" required>
            </div>
            <div class="form-group">
                <label for="no_telp">No. Telp:</label>
                <input class="input_no_telp" type="number" id="no_telp" name="no_telp" min="0" 
                pattern="[0-9]{11,15}" title="Nomor telepon harus terdiri dari 11 hingga 15 digit angka" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input class="input_username" type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input class="input_password" type="password" id="password" name="password" required>
            </div>
            <div class="Btn.tambahmenu" style="display: flex; justify-content: space-between;">
                <a type="button" class="tombol_kembali" onclick="history.back()">Kembali</a>
                <button type="submit" class="tombol_simpan_karyawan">Simpan</button>
            </div>
        </form>
    </div>
    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onloadend = () => {
                preview.src = reader.result;
                preview.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }
    </script>
</body>
</html>
