<?php
session_start();
include 'db.php';
if ($_SESSION['s_login'] != true) {
    echo '<script>window.location="signup.php"</script>';
}
$admin_id = $_SESSION['id']; // Ambil admin_id dari session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thriftopia - User Data Produk</title>
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
            color: #fff;
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
            background-color: #8cd9a0 !important;
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
        .btn {
            padding: 8px 15px;
            background-color: #378CE7; 
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .btn-sm {
    
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
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
<body>
<header>
    <!-- Header -->
    <nav class=" navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand text-success logo h1 align-self-center" href="user_dashboard.php">
                Thriftopia
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="align-self-center collapse navbar-collapse flex-fill d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="user_dashboard.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profil.php">Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="produk.php">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user-data-produk.php">Data Produk</a>
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
            <h3>Data Produk</h3>
            <div class="box">
                <button class="btn btn-primary mb-2">
                    <a href="user-tambah-produk.php" style="color: white;">Tambah Produk</a>
                </button>
                <table border="1" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Kategori</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) WHERE added_by = '$admin_id' ORDER BY product_id DESC");
                        if (mysqli_num_rows($produk) > 0) {
                            $no = 1;
                            while ($row = mysqli_fetch_array($produk)) {
                        ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['category_name']; ?></td>
                                    <td><?php echo $row['product_name']; ?></td>
                                    <td>Rp. <?php echo number_format($row['product_price']); ?></td>
                                    <td><?php echo $row['product_description']; ?></td>
                                    <td><a href="produk/<?php echo $row['product_image'] ?>" target="_blank"><img src="produk/<?php echo $row['product_image'] ?>" width="50px"></a></td>
                                    <td><?php echo ($row['product_status'] == 0) ? 'Tidak Aktif' : 'Aktif'; ?></td>
                                    <td>
                                        <button class="btn btn-secondary btn-sm me-1" onclick="window.location.href='user-edit-produk.php?id=<?php echo $row['product_id']; ?>'">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm me-1" onclick="if(confirm('Yakin ingin menghapus?')) { window.location.href='hapus-produk.php?id=<?php echo $row['product_id']; ?>' }">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                        ?>
                            <tr>
                                <td colspan="8">Data tidak tersedia</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--footer-->
    <footer>
        <div class="container">
            <small>&copy; 2024 - Kelompok 4</small>
        </div>
    </footer>
     <!-- Start Script -->
     <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
</body>

</html>
