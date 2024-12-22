

<?php
error_reporting(); // Menampilkan semua error untuk debugging
session_start();
include 'db.php';
if ($_SESSION['s_login'] != true) {
    echo '<script>window.location="signup.php"</script>';
}
$product_id = $_GET['id'];
// Mengakses admin_id dari objek a_global
$admin_id = $_SESSION['a_global']->admin_id;

$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id='$product_id'");
$p = mysqli_fetch_object($produk);

// Cek apakah link sudah diklik untuk produk ini
$linkClicked = $p->link_clicked;
$clickCount = $p->link_click_count;


// Cek apakah user yang login adalah admin yang menambahkan produk ini
$isAddedByCurrentAdmin = ($p->added_by == $admin_id);

// Ambil informasi admin yang menambahkan produk ini
$kontakAdmin = mysqli_query($conn, "SELECT admin_telp FROM tb_admin WHERE admin_id='$p->added_by'");
$admin = mysqli_fetch_object($kontakAdmin);

// Ambil informasi kontak untuk footer
$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id=4");
$a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thriftopia - Admin Detail Produk</title>
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
            background-color: #6c63ff !important;
            border-color: #6c63ff !important;
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
            height: 330px;
            border: 1px solid #ccc;
            float: left;
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 10px;

        }

        .col-2 {
            flex: 1;
            margin-right: 150px;
            /* Atur jarak antara gambar dan konten */
        }

        .col-2 img {
            width: 200%;
            /* Pastikan gambar tidak melampaui lebar kolom */
            max-width: 300px;
            /* Atur lebar maksimal gambar */
            height: auto;
            /* Biarkan tinggi gambar menyesuaikan proporsi */
        }
        .img {
            flex: 1;
        }

        .img img {
            width: 100%;
            max-width: 300px;
            height: auto;
        }

        .details {
            flex: 1;
            margin-left: 20px;
        }

        .details h3, .details h4, .details p {
            margin: 10px 0;
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
                top: 35px;
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
    <!--search-->
    <div class="search">
        <div class="container">
            <form action="produk.php">
            <input type="text" name="search" placeholder="Cari Produk" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
                <input type="hidden" name="kat" value="<?php echo isset($_GET['kat']) ? $_GET['kat'] : '' ?>">
                <input type="submit" name="cari" value="Cari Produk">
            </form>
        </div>
    </div>
    <!-- product detail -->
<!-- product detail -->
<div class="section">
        <div class="container">
            <h3>Detail Produk</h3>
            <div class="box">
                <div class="img">
                    <img src="produk/<?php echo $p->product_image ?>" alt="Product Image">
                </div>
                <div class="details">
                    <h3><?php echo $p->product_name ?></h3>
                    <h4>Rp. <?php echo number_format($p->product_price) ?></h4>
                    <p>Deskripsi :<br>
                        <?php echo $p->product_description ?>
                    </p>
                    <p>
                        <?php if ($clickCount < 3) { ?>
                            <a href="klik_link.php?id=<?php echo $p->product_id ?>" style="color: blue; text-decoration: underline;">Click to Chat</a>
                        <?php } else { ?>
                            <span>Produk sedang proses negosiasi</span>
                            <?php if ($isAddedByCurrentAdmin) { ?>
                                <br><a href="reset-link.php?id=<?php echo $p->product_id ?>" style="color: red; text-decoration: underline;">Update Link</a>
                            <?php } ?>
                        <?php } ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!--footer-->
    <div class="footer">
        <div class="container">
            <h6>Alamat</h6>
            <p><?php echo $a->admin_address ?></p>

            <h6>Email</h>
                <p><?php echo $a->admin_email ?></p>

                <h6>No.Hp</h6>
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