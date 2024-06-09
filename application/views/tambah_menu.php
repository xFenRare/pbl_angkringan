<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #7C826B;
            font-family: Arial, sans-serif;
        }
        .tambah-menu {
            margin: 0 auto;
            width: 80%;
            padding: 80px;
            background-color: #EAEAEA;
            border-radius: 5px;
            margin-top: 50px;
        }
        .jdl {
            text-align: center;
        }
        .tambah-menu label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .tambah-menu input[type="text"],
        .tambah-menu input[type="number"],
        .tambah-menu input[type="file"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .tambah-menu .btn {
            width: ;100%
            padding: 10px;
            margin: 5px 5px 0 0;
            border: none;
            border-radius: 3px;
            color: white;
            font-size: 16px;
        }
        .tambah-menu .btn-back {
            background-color: orangered;
        }
        .tambah-menu .btn-submit {
            background-color: #007BFF;
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
        .input-group-addon {
            padding: 6px 12px;
            font-size: 14px;
            font-weight: 400;
            line-height: 1;
            color: #555;
            text-align: center;
            background-color: #eee;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 60px;
        }
    </style>
</head>
<body>
<h1 class="jdl">Tambah Menu Baru</h1>
    <div class="tambah-menu">
        <form action="tambah_menu.php" method="post" enctype="multipart/form-data">
            <label for="nama_menu">Nama Menu:</label>
            <input type="text" id="nama_menu" name="nama_menu" required>

            <label for="harga">Harga:</label>
            <div class="input-group">
                <input type="number" id="harga" name="harga" min="0" placeholder="Rp." required>
            </div>

            <label for="gambar">Gambar:</label>
            <input type="file" id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)" required>

            <div class="preview-container">
                <img id="preview" class="preview-image" src="#" alt="Preview Image">
            </div>

            <div class="Btn.tambahmenu" style="display: flex; justify-content: space-between;">
                <button type="button" class="btn btn-back" onclick="history.back()">Back</button>
                <input type="submit" class="btn btn-submit" value="Submit">
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
