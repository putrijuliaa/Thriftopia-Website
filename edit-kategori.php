<?php
    session_start();
    include 'db.php';
    if ($_SESSION['s_login'] != true) {
        echo '<script>window.location="signup.php"</script>';
    }
    $kategori = mysqli_query($conn, "SELECT * FROM tb_category WHERE category_id = '".$_GET['id']."'");
    if (mysqli_num_rows($kategori) == 0) {
        echo '<script>window.location="data-kategori.php"</script>';
    }
    $k = mysqli_fetch_object($kategori);
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thriftopia - Admin Edit Kategori</title>
        <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/templatemo.css">
        <link rel="stylesheet" href="assets/css/custom.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
        <link rel="stylesheet" href="assets/css/fontawesome.min.css">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
       
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #eaeff0;
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
    
            header {
                background-color: #fff;
                color: #333;
                padding: 0px 0;
                margin-bottom: 20px;
            }
    
            header h1 a {
                color: #333;
                text-decoration: none;
            } 
        .btn-primary,
        .btn-primary:hover,
        .btn-primary:focus {
            background-color:  #8cd9a0  !important;
            border-color:  #8cd9a0  !important;
        }

        .btn-primary a {
            color: #fff;
        }
        .section {
            padding: 20px 0;
        }
        .box {
            background: #fff;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        footer {
            background-color: #807e91;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
        }

        footer small {
            font-size: 12px;
        }
        .logout-btn {
            background-color: transparent;
            border: none;
            cursor: pointer;
            color: #8cd9a0;
            font-size: 20px;
            position: absolute;
            top: 35px;
            right: 30px;
        }
        .logout-btn:hover {
            color: #264628;
        }

        .nav-link {
            position: relative;
        }
        @media (max-width: 767px) {
            .logout-btn {
                top: 40px;
                right: 10px;
                font-size: 16px;
            }
        }

        /* Responsif untuk layar dengan lebar kurang dari 576px (ukuran smartphone) */
        @media (max-width: 575px) {
            .logout-btn {
                top: 5px;
                right: 5px;
                font-size: 14px;
            }
        }

        
    </style>
</head>
<body>
<header>
        <!-- Header -->
        <nav class=" navbar navbar-expand-lg navbar-light shadow">
            <div class="container d-flex justify-content-between align-items-center">
                <a class="navbar-brand text-success logo h1 align-self-center" href="dashboard.php">
                    Thriftopia
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="align-self-center collapse navbar-collapse flex-fill d-lg-flex justify-content-lg-between"
                    id="templatemo_main_nav">
                    <div class="flex-fill">
                        <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="dashboard.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin-profil.php">Profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin-produk.php">Produk</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="data-kategori.php">Kategori</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="data-produk.php">Data Produk</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="daftar-pengguna.php">Pengguna</a>
                            </li> 
                            <button class="logout-btn" onclick="window.location.href='logout.php'">
                                <i class="fas fa-sign-out-alt"></i>
                                
                            </button>                          
                        </ul>
                    </div>
                </div>
                
            </div>
        </nav>
    </header>
    <!-- Close Header -->

    <!--content-->
    <div class="section">
        <div class="container">
            <h3>Edit Data Kategori</h3>
            <div class="box">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nama">Kategori</label>
                        <input type="text" name="nama" id="nama" placeholder="Kategori" class="form-control" value="<?php echo $k->category_name ?>" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Ubah</button>
                </form>
                <?php
                 if (isset($_POST['submit'])) {
                    $nama = ucwords($_POST['nama']);
                    $update = mysqli_query($conn, "UPDATE tb_category SET category_name = '".$nama."' WHERE category_id = '".$k->category_id."'");
                    if ($update) {
                        echo '<script>alert("Data berhasil diubah")</script>';
                        echo '<script>window.location="data-kategori.php"</script>';
                    } else {
                        echo 'gagal'.mysqli_error($conn);
                    }
                 }
                ?>
            </div>
        </div>
    </div>

    <!--footer-->
    <footer>
        <div class="container">
            <small>&copy; 2024 - Kelompok 4</small>
        </div>
    </footer>

    <!-- Link Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>

</body>

</html>
