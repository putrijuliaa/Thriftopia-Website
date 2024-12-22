<?php
session_start();
include 'db.php'; // File ini harus berisi konfigurasi koneksi database

$error = ""; // Variabel untuk menampung pesan kesalahan

// Proses form login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    
    $cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '$user' AND password = '".MD5($pass)."'");
    if (mysqli_num_rows($cek) > 0) {
        $d = mysqli_fetch_object($cek);
        $_SESSION['s_login'] = true;
        $_SESSION['a_global'] = $d;
        $_SESSION['id'] = $d->admin_id;
        $_SESSION['user_level'] = $d->user_level;

        if ($d->user_level == 'admin') {
            header('Location: dashboard.php');
        } else {
            header('Location: user_dashboard.php');
        }
        exit();
    } else {
        $error = "Username atau password Anda salah!";
    }
}

// Proses form pendaftaran
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $user_level = mysqli_real_escape_string($conn, $_POST['user_level']);

    $query = "INSERT INTO tb_admin (admin_name, username, password, admin_telp, admin_email, admin_address, user_level) VALUES ('$name', '$username', '".MD5($password)."', '$phone', '$email', '$address', '$user_level')";
    
    if (mysqli_query($conn, $query)) {
        // Redirect to login with a success message
        header('Location: signup.php?registered=true');
        exit();
    } else {
        $error = "Terjadi kesalahan saat mendaftar!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
    <style>
        body, input, button {
            font-family: 'Poppins', sans-serif;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            background-color: #fff;
            color: green;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            position: absolute;  
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
                
        }

        .form-container input[type="text"],
        .form-container input[type="password"],
        .form-container input[type="email"],
        .form-container select {    
            width: 100%;
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 5px;
            border: 1px solid #ccc; /* Tambahkan border agar terlihat jelas */
        }

        .select-box {
            position: relative;
            margin-bottom: 10px;
        }

        .select-box select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
        }

        .select-box i {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .toggle-container {
            margin-top: 20px;
        }

        .toggle-panel {
            background-color: #8cd9a0;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .toggle button, .form-container button {
            background-color: #fff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .toggle button:hover, .form-container button:hover {
            background-color: #71A385;
        }

        @media screen and (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .form-container {
                padding: 15px;
            }

            .toggle-panel {
                padding: 15px;
            }

            .toggle button, .form-container button {
                padding: 8px 16px;
            }
        }
            *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            
        }
            body{
                background-color: #c9d6ff;
                background: linear-gradient(to right, #fff, #C0C2C1);
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                height: 100vh;
            }

            .container{
                background-color: #fff;
                border-radius: 30px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
                position: relative;
                overflow: hidden;
                width: 768px;
                max-width: 100%;
                min-height: 480px;
            }

            .container p{
                font-size: 14px;
                line-height: 20px;
                letter-spacing: 0.3px;
                margin: 20px 0;
            }

            .container span{
                font-size: 12px;
            }

            .container a{
                color: #333;
                font-size: 13px;
                text-decoration: none;
                margin: 15px 0 10px;
            }

            .container button{
                background-color: #fff ;
                color: #fff;
                font-size: 12px;
                padding: 10px 45px;
                border: 1px solid transparent;
                border-radius: 8px;
                font-weight: 600;
                letter-spacing: 0.5px;
                text-transform: uppercase;
                margin-top: 10px;
                cursor: pointer;
            }

            .container button.hidden{
                background-color: transparent;
                border-color: #fff;
            }

            .container form{
                background-color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                padding: 0 40px;
                height: 100%;
            }

            .container input{
                background-color: #fff;
                border: none;
                margin: 8px 0;
                padding: 10px 15px;
                font-size: 13px;
                border-radius: 8px;
                width: 100%;
                outline: none;
            }

            .form-container{
                position: absolute;
                top: 0;
                height: 100%;
                transition: all 0.6s ease-in-out;
            }

            .sign-in{
                left: 0;
                width: 50%;
                z-index: 2;
                background-color: #fff;
            }

            .container.active .sign-in{
                transform: translateX(100%);
            }

            .sign-up{
                left: 0;
                width: 50%;
                opacity: 0;
                z-index: 1;
            }

            .container.active .sign-up{
                transform: translateX(100%);
                opacity: 1;
                z-index: 5;
                animation: move 0.6s;
            }

            @keyframes move{
                0%, 49.99%{
                    opacity: 0;
                    z-index: 1;
                }
                50%, 100%{
                    opacity: 1;
                    z-index: 5;
                }
            }

            .social-icons{
                margin: 20px 0;
            }

            .social-icons a{
                border: 1px solid #ccc;
                border-radius: 20%;
                display: inline-flex;
                justify-content: center;
                align-items: center;
                margin: 0 3px;
                width: 40px;
                height: 40px;
            }

            .toggle-container{
                position: absolute;
                top: 0;
                left: 50%;
                width: 50%;
                height: 100%;
                overflow: hidden;
                transition: all 0.6s ease-in-out;
                border-radius: 150px 0 0 100px;
                z-index: 1000;
            }

            .container.active .toggle-container{
                transform: translateX(-100%);
                border-radius: 0 150px 100px 0;
            }

            .toggle{
                background-color: #fff ;
                height: 100%;
                background: linear-gradient(to right, #fff, #fff) !important;
                color: #fff;
                position: relative;
                left: -100%;
                height: 100%;
                width: 200%;
                transform: translateX(0);
                transition: all 0.6s ease-in-out;
            }

            .container.active .toggle{
                transform: translateX(50%);
            }

            .toggle-panel{
                position: absolute;
                width: 50%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                padding: 0 30px;
                text-align: center;
                top: 0;
                transform: translateX(0);
                transition: all 0.6s ease-in-out;
            }

            .toggle-left{
                transform: translateX(-200%);
            }

            .container.active .toggle-left{
                transform: translateX(0);
            }

            .toggle-right{
                right: 0;
                transform: translateX(0);
            }

            .container.active .toggle-right{
                transform: translateX(200%);
            }

    </style>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="POST" action=""> 
                <input type="text" name="name" placeholder="Name" required>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="text" name="phone" placeholder="No.Telp" required>
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="text" name="address" placeholder="Address" required>
                <div class="select-box">
                    <select name="user_level" id="user_level" required>
                        <option value="" selected disabled>Select User Level</option>
                        <option value="user">Pembeli/Penjual</option>
                    </select>
                </div>
                <button type="submit" name="register"style="background-color: #8cd9a0; color: white;">Sign Up</button>
            </form>
            <?php if (isset($error) && isset($_POST['register'])) { echo '<p style="color:red;">'.$error.'</p>'; } ?>
        </div>
        <div class="form-container sign-in ">
            <form method="POST" action="">
                <h1>Sign In</h1>
                <?php if (isset($_GET['registered'])) { echo '<p style="color:green;">Account successfully created. Please log in.</p>'; } ?>   
                <input type="text" name="user" placeholder="Username" required>
                <input type="password" name="pass" placeholder="Password" required> 
                <button type="submit" name="login" style="background-color: #8cd9a0; color: white;">Sign In</button>
            </form>
            <?php if (isset($error) && isset($_POST['login'])) { echo '<p style="color:red;">'.$error.'</p>'; } ?>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to become part of the thrifter</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Thrifter!</h1>
                    <p>Come on, register yourself immediately to explore our website!</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
