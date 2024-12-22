<?php
    session_start();
    include 'db.php';
    if ($_SESSION['s_login'] != true) {
        echo '<script>window.location="signup.php"</script>';
    }
    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id='".$_GET['id']."'");
    if (mysqli_num_rows($produk) == 0) {
        echo '<script>window.location="data-produk.php"</script>';
    }
    $p = mysqli_fetch_object($produk);
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thriftopia - User Edit Produk</title>
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
                background-color:  #8cd9a0 !important;
                border-color:  #8cd9a0 !important;
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
            <h3>Edit Data Produk</h3>
            <div class="box">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" name="kategori" id="kategori" required>
                            <option value="">--Pilih--</option>
                            <?php
                                $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                                while ($r = mysqli_fetch_array($kategori)) {
                                    echo '<option value="'.$r['category_id'].'"'.($r['category_id'] == $p->category_id ? ' selected' : '').'>'.$r['category_name'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Produk</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Produk" value="<?php echo $p->product_name ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" name="harga" id="harga" class="form-control" placeholder="Harga" value="<?php echo $p->product_price ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar Produk</label><br>
                        <img src="produk/<?php echo $p->product_image ?>" width="100px">
                        <input type="hidden" name="foto" value="<?php echo $p->product_image ?>">
                        <input type="file" name="gambar" id="gambar" class="form-control mt-2">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi"><?php echo $p->product_description ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="">--Pilih--</option>
                            <option value="1" <?php echo ($p->product_status == 1) ? 'selected' : ''; ?>>Aktif</option>
                            <option value="0" <?php echo ($p->product_status == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Ubah</button>
                </form>
                <?php
                 if (isset($_POST['submit'])) {
                    $kategori   = $_POST['kategori'];
                    $nama       = $_POST['nama'];
                    $harga      = $_POST['harga'];
                    $deskripsi  = $_POST['deskripsi'];
                    $status     = $_POST['status'];
                    $foto       = $_POST['foto'];
                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];
                    $type1 = explode('.', $filename);
                    if ($filename != '') {
                        $type2 = $type1[1];
                        $newname = 'produk'.time().'.'.$type2;
                        $tipe_file = array('jpg', 'jpeg', 'png', 'gif');
                        if (!in_array($type2, $tipe_file)) {
                            echo '<script>alert("Format file tidak tersedia. Ganti format lainnya!")</script>';
                        } else {
                            unlink('./produk/'.$foto);
                            move_uploaded_file($tmp_name, './produk/'.$newname);
                            $namagambar = $newname;
                        }
                    } else {
                        $namagambar = $foto;
                    }
                    $update = mysqli_query($conn, "UPDATE tb_product SET category_id = '".$kategori."', product_name = '".$nama."', product_price= '".$harga."', product_description= '".$deskripsi."', product_image = '".$namagambar."', product_status = '".$status."' WHERE product_id = '".$p->product_id."'");
                    if ($update) {
                        echo '<script>alert("Produk berhasil di update")</script>';
                        echo '<script>window.location="user-data-produk.php"</script>';
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
    <script>
        CKEDITOR.replace('deskripsi');
    </script>
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>

</body>

</html>
