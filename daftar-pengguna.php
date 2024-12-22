<?php
session_start();
include 'db.php';

if ($_SESSION['s_login'] != true) {
    echo '<script>window.location="signup.php"</script>';
}

// Tangani aksi hapus
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_query = mysqli_query($conn, "DELETE FROM tb_admin WHERE admin_id = '$id'");
    if ($delete_query) {
        echo '<script>alert("Pengguna berhasil dihapus")</script>';
        echo '<script>window.location="daftar-pengguna.php"</script>';
    } else {
        echo '<script>alert("Pengguna gagal dihapus")</script>';
    }
}

// Ambil data admin
$query_admin = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id ='" . $_SESSION['id'] . "'");
$d = mysqli_fetch_object($query_admin);

// Ambil data pengguna
$query_users = mysqli_query($conn, "SELECT * FROM tb_admin");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thriftopia - Admin Daftar Pengguna</title>
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
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .input-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #8cd9a0;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #8cd9a0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            flex: 1;
        }

        table, th, td {
            border: 1px solid #ddd;
            flex: 1;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
        }

        .btn-delete {
            color: #fff;
            background-color: #e74c3c;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-delete:hover {
            background-color: #c0392b;
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

<!-- Content -->
<div class="section">
    <div class="container">
        <div class="box">
            <h3>Data Pengguna</h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>No HP</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_object($query_users)) {
                            echo "<tr>
                                <td>$no</td>
                                <td>{$row->admin_name}</td>
                                <td>{$row->username}</td>
                                <td>{$row->admin_telp}</td>
                                <td>{$row->admin_email}</td>
                                <td>{$row->admin_address}</td>
                                <td>
                                    <a href='daftar-pengguna.php?delete={$row->admin_id}' onclick='return confirm(\"Apakah Anda yakin ingin menghapus pengguna ini?\")' class='bi bi-trash'>Hapus</a>                                
                                </td>
                            </tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
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
