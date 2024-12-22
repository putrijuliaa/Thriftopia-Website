<?php
    session_start();
    include 'db.php';
    if($_SESSION['s_login'] != true){
        echo '<script>window.location="signup.php"</script>';
    }
// Mengubah status produk yang sudah lebih dari 3 hari menjadi tidak aktif
mysqli_query($conn, "UPDATE tb_product SET product_status = 0 WHERE product_status = 1 AND TIMESTAMPDIFF(DAY, date_created, NOW()) > 3");


    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thriftopia - User Tambah Produk</title>
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
            background: #35424a;
            color: #ffffff;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }
        footer small {
            display: block;
        }
        .btn-primary {
            background-color: #8cd9a0;
            border: none;
        }
        footer {
            background-color: #807e91;
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
            <h3>Tambah Data Produk</h3>
            <div class="box">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" name="kategori" required>
                            <option value="">--Pilih--</option>
                            <?php
                                $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                                while($r = mysqli_fetch_array($kategori)){
                            ?>
                            <option value="<?php echo $r['category_id']?>"><?php echo $r['category_name'] ?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Produk</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama Produk" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" name="harga" class="form-control" placeholder="Harga" required>
                    </div>
                    <div class="form-group">
                        <label for="gambar"></label>
                        <input type="file" name="gambar"  required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" placeholder="Deskripsi"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status">
                            <option value="">--Pilih--</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
                </form>
                <?php
                 if(isset($_POST['submit'])){
                    //menampung input data form
                    $kategori   = $_POST['kategori'];
                    $nama       = $_POST['nama'];
                    $harga      = $_POST['harga'];
                    $deskripsi  = $_POST['deskripsi'];
                    $status     = $_POST['status'];
                    $admin_id   = $_SESSION['id']; // Ambil admin_id dari session

                    //menampung file data form
                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];
                    $type1 = explode('.', $filename);
                    $type2 = $type1[count($type1) - 1]; // mengambil ekstensi file
                    $newname = 'produk'.time().'.'.$type2;

                    //menampung format file yang diizinkan
                    $tipe_file = array('jpg', 'jpeg', 'png', 'gif');
                    
                    //validasi format file
                    if(!in_array($type2, $tipe_file)){
                        echo '<script>alert("Format file tidak tersedia. Ganti format lainnya!")</script>';
                    }else{
                        //proses upload file + insert database
                        move_uploaded_file($tmp_name, './produk/'.$newname);
                        $insert = mysqli_query($conn, "INSERT INTO tb_product (category_id, product_name, product_price, product_description, product_image, product_status, date_created, added_by) VALUES ('".$kategori."', '".$nama."', '".$harga."', '".$deskripsi."', '".$newname."', '".$status."', NOW(), '".$admin_id."')");

                        if($insert){
                            echo '<script>alert("Produk berhasil di tambahkan")</script>';
                            echo '<script>window.location="user-data-produk.php"</script>';
                        }else{
                            echo 'gagal'.mysqli_error($conn);
                        }
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
    <script>
        CKEDITOR.replace('deskripsi');
    </script>
    <!-- Link Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    

    <!-- End Script -->
</body>

</html>
