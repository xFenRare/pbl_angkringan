<!DOCTYPE html>
<html>
<head>
    <title>Halaman Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #7C826B;
            font-family: Arial, sans-serif;
        }

        .login{
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
            height: 250px;
            padding: 20px;
            background-color: #EAEAEA;
            border-radius: 5px;
            margin-top: 50px;
            
        }
        .input-group {
            margin-bottom: 15px;
            
            
        }
        .input-group input {
            width: calc(100% - 30px); /* Mengurangi lebar input untuk memuat ikon mata */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .input-group-prepend .input-group-text {
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 3px 0 0 3px;
            cursor: pointer; /* Menjadikan kursor menjadi tanda tangan saat mengklik ikon */
        }

        .btn-login,
        .btn-register
        {
            background-color: #eaeaea;
            color: #000000;
            border: 2;
            padding: 10px 15px;
            border-radius: 3px;
            cursor: pointer;
            width: 49%;
            margin-bottom: 10px;
            text-decoration: none; 
            display: inline-block;
            box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.538); 
            transition: 0.2s ease;
        }

        .btn-register:hover
        {
            background-color: #52ff00;
            color: #ffffff;
            border: 2;
            padding: 10px 15px;
            border-radius: 3px;
            cursor: pointer;
            width: 49%;
            margin-bottom: 10px;
            text-decoration: none; 
            display: inline-block;
            box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.538); 
        }

        .btn-login:hover
        {
            background-color: #53a7d8;
            color: #ffffff;
            border: 2;
            padding: 10px 15px;
            border-radius: 3px;
            cursor: pointer;
            width: 49%;
            margin-bottom: 10px;
            text-decoration: none; 
            display: inline-block;
            box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.538);
        }
        .regis{
            text-decoration: none;
            color: #000000;
            transition: 0.2s ease; 
            display: block;
            
            
        }

        .regis:hover
        {
            text-decoration: none;
            color: #ffffff;
        }
        .btn-forgot{
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


<h2 class="login">LOGIN'</h2>
<div class="container">
    
    <form id="loginForm" action="process_login.php" method="post">
    <div class="input-group">
    <span style="padding-left: 18px;" class="input-group-text"><i class="far fa-user"></i></span>
    <input type="text" name="username" placeholder="Username" class="form-control">
</div>
<div class="input-group" style="margin-top: -5px;">
    <span class="input-group-text" id="show-password"><i class="fas fa-eye-slash"></i></span>
    <input type="password" name="password" id="password" placeholder="Password" class="form-control">
</div>

        <a href="forgot_password.php" class="btn-forgot"><p>Lupa password?</p></a>
        <button type="submit" onclick="checkLogin()" class="btn-login">LOGIN</button>
        <button class="btn-register"><a href="register.php" class="regis">DAFTAR</a></button>
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
