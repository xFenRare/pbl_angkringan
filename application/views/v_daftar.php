<!DOCTYPE html>
<html>
<head>
    <title>Halaman Daftar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #7C826B;
            font-family: Arial, sans-serif;
        }

        .login {
            margin-top: 50px;
            margin-bottom: 100px;
            text-align: center;
            font-size: 50px;
            font-weight: lighter;
            color: #fff;
        }
        .container {
            margin: 0 auto;
            width: 400px;
            padding: 20px;
            background-color: #EAEAEA;
            border-radius: 5px;
            margin-top: 50px;
        }
        .input-group {
            margin-bottom: 15px;
        }
        .input-group input {
            width: calc(100% - 30px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .input-group-prepend .input-group-text {
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 3px 0 0 3px;
            cursor: pointer;
        }

        .btn-login,
        .btn-register {
    background-color: #ffffff;
    color: #000000;
    border: 2;
    padding: 10px 15px;
    border-radius: 3px;
    cursor: pointer;
    width: 46%;
    margin-bottom: 10px;
    text-decoration: none;
    display: inline-block;
    text-align: center;
    transition: 0.2s ease;
    margin: 5px;
    box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.538);
    
}

.btn-register a {
    text-decoration: none;
    color: #000000;
    
}

.btn-register:hover {
    background-color: #800000;
    color: #ffffff;
    box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.538);
}

.btn-login:hover {
    background-color: #2980b9;
    color: #ffffff;
    box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.538);

.btn-register:focus {
    outline: none;
    
}


        .regis {
            text-decoration: none;
            color: #fff;
        }
        .regis:hover {
            text-decoration: none;
            color: #fff;
        }

        .btn-forgot {
            color: black;
            cursor: pointer;
            text-align: right;
            align: right;
            text-decoration: none;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
<h2 class="login">DAFTAR</h2>
<div class="container">
    <!-- Update form action to the new controller/method -->
    <form action="<?php echo base_url('daftar/process_daftar'); ?>" method="post" id="daftar-form">
        <div class="input-group">
            <span class="input-group-text"><i class="far fa-user"></i></span>
            <input type="text" id="nama_angkringan" name="nama_angkringan" placeholder="Nama Angkringan" class="form-control" required>
        </div>
        <div class="input-group">
            <span class="input-group-text"><i class="far fa-user"></i></span>
            <input type="text" id="username" name="username" placeholder="Username" class="form-control" required>
        </div>
        <div class="input-group">
            <span class="input-group-text" id="show-password"><i class="fas fa-eye-slash"></i></span>
            <input type="password" id="password" name="password" placeholder="Password" class="form-control" required>
        </div>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-home"></i></span>
            <input type="text" id="alamat" name="alamat" placeholder="Alamat" class="form-control" required>
        </div>
        <div class="input-group">
    <span class="input-group-text"><i class="fas fa-phone"></i></span>
    <input type="text" id="no_telp_angkringan" name="no_telp_angkringan" placeholder="No Telp" class="form-control" 
           pattern="[0-9]{11,15}" title="Nomor telepon harus terdiri dari 11 hingga 15 digit angka" required>
</div>

        <button type="submit" class="btn-login">DAFTAR</button>
        <button onclick="window.location.href='<?php echo base_url('login'); ?>';" class="btn-register"><i class="fas fa-arrow-left"></i> BACK</button>
    </form>
</div>

<script>
    document.getElementById("show-password").addEventListener("click", function() {
        var passwordInput = document.getElementById("password");
        var eyeIcon = this.querySelector("i");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        }
    });
    
</script>
</body>
</html>
