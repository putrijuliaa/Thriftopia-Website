<?php
error_reporting(); // Menampilkan semua error untuk debugging
session_start();
include 'db.php';
if ($_SESSION['s_login'] != true) {
    echo '<script>window.location="signup.php"</script>';
}
    $kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id=4");
    $a = mysqli_fetch_object($kontak);

    // Ambil nilai search dan kat dari URL
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $kat = isset($_GET['kat']) ? $_GET['kat'] : '';
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thriftopia - User Produk</title>
        <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/templatemo.css">
        <link rel="stylesheet" href="assets/css/custom.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
        <link rel="stylesheet" href="assets/css/fontawesome.min.css">
       
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

        .container {
            margin: 0 auto;
        }

        .section {
            padding: 30px 0;
        }

        .box {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .box table {
            width: 100%;
            height: 350px;
            border-collapse: collapse;
        }

        .box th,
        .box td {
            padding: 10px;
            text-align: center;
        }

        .box th {
            background-color: #f8f9fa;
            color: #333;
        }

        .box tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .box tbody tr:hover {
            background-color: #e8e8e8;
        }

        .btn-primary,
        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #8cd9a0  !important;
            border-color: #8cd9a0 !important;
        }

        .btn-primary a {
            color: #fff;
        }

        .btn-secondary,
        .btn-secondary:hover,
        .btn-secondary:focus {
            background-color: #ffc107 !important;
            border-color: #ffc107 !important;
        }
        .btn-danger,
        .btn-danger:hover,
        .btn-danger:focus {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }
        .search {
            background-color: #eaeff0;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            border: none;
        }
        .search input[type="text"] {
            padding: 10px;
            width: 50%;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
        }
        .search input[type="submit"] {
            padding: 10px 10px;
            background-color: #8cd9a0;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .footer {
            background-color: #807e91;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            
            left: 0;
            bottom: 0;
            width: 100%;
        }

        .footer small {
            font-size: 12px;
        }
        .col-4 {
            width: 25%;
            height: 430px;
            border: 1px solid #ccc;
            float: left;
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        .col-5 {
            width: 23%;
            height: 100px;
            float: left;
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 10px;
            color: #206030;

        }
    
        .box {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 15px;
            box-sizing: border-box;
            margin:10px 0 25px 0;
            overflow: auto;
            
        }
        .box::after {
            content: '';
            display: block;
            clear: both;
        }
        .table {
            width: 100%;
            border-collapse: collapse;  
        }
        .table tr {
        height: 30px;
        }
        .table tr td {
            padding: 5px 10px;
            
        }
        .col-4 img {
            width: 100%;
        }
        .col-4 .nama {
            color: #666;
            margin-bottom: 5px;
        }
        .col-4 .harga {
            font-weight: bold;
            color: #C70039;
            float: right;
        }
        .logout-btn {
            background-color: transparent;
            border: none;
            cursor: pointer;
            color: #8cd9a0;
            font-size: 20px;
            position: absolute;
            top: 30px;
            right: 30px;
        }

        .logout-btn:hover {
            color: #264628;
        }

        .nav-link {
            position: relative;
        }
        .logout-btn {
            background-color: transparent;
            border: none;
            cursor: pointer;
            color: #8cd9a0;
            font-size: 20px;
            position: absolute;
            top: 30px;
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
                top: 30px;
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
        @media (max-width: 767px) {
            .col-5 {
                width: 49%;
                margin: 0 auto;
                text-align: center;
                float: none;
            }
        }

        @media (max-width: 575px) {
            .col-5 {
                width: 100%;
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
    <!--search-->
    <div>
        <div class="container">
        <form action="admin-produk.php" class="search">
                <input type="text" name="search" placeholder="Cari Produk" value="<?php echo htmlspecialchars($search); ?>">
                <input type="hidden" name="kat" value="<?php echo htmlspecialchars($kat); ?>">
                <input type="submit" name="cari" value="Cari Produk">
            </form>
        </div>
    </div>

<!--category-->
<div class="section">
        <div class="container">
            <h3>Kategori</h3>
            <div class="box">
                <?php 
                    $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                    if(mysqli_num_rows($kategori) > 0){
                        while($k = mysqli_fetch_array($kategori)){                  
                ?>
                    <a href="admin-produk1.php?kat=<?php echo $k['category_id'] ?>">
                        <div class="col-5">
                            <img src="gambar6.jpg" width="60px" style="margin-bottom: 5px;">
                            <p><?php echo $k['category_name']?></p>
                        </div>
                    </a>
                <?php }}else{ ?>
                    <p>Kategori tidak ada</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <!--new product-->
    <div class="section">
        <div class="container">
            <h3>Produk Terbaru</h3>
            <div class="box">
                <?php
                $query = "SELECT * FROM tb_product WHERE product_status = 1";
                if ($search) {
                    $query .= " AND product_name LIKE '%$search%'";
                }
                if ($kat) {
                    $query .= " AND category_id = '$kat'";
                }
                $query .= " ORDER BY product_id DESC";
                $produk = mysqli_query($conn, $query);

                if (mysqli_num_rows($produk) > 0) {
                    while ($p = mysqli_fetch_array($produk)) {
                ?>
                    <a href="admin-detail-produk.php?id=<?php echo $p['product_id'] ?>">
                        <div class="col-4">
                            <img src="produk/<?php echo $p['product_image'] ?>">
                            <p class="nama"><?php echo $p['product_name'] ?></p>
                            <p class="harga">Rp. <?php echo $p['product_price'] ?></p>
                        </div>
                    </a>
                <?php 
                    }
                } else { 
                ?>
                    <p>Produk tidak ada</p>
                <?php 
                } 
                ?>
            </div>
        </div>
    </div>
    <!--footer-->
    <div class="footer">
        <div class="container">
            <h4>Alamat</h4>
            <p><?php echo $a->admin_address ?></p>

            <h4>Email</h4>
            <p><?php echo $a->admin_email ?></p>

            <h4>No.Hp</h4>
            <p><?php echo $a->admin_telp ?></p>
            <small>Copyright &copy 2024 - Kelompok 4</small>
        </div>
    </div>
    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
</body>
</html>
