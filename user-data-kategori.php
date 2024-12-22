<?php
session_start();
include 'db.php';
if ($_SESSION['s_login'] != true) {
    echo '<script>window.location="signup.php"</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thriftopia</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <!--header-->
    <header>
        <div class="container">
            <h1><a href="user_dashboard.php">Thriftopia</a></h1>
            <ul>
            <li><a href="user_dashboard.php">Dashboard</a></li>
                <li><a href="user-profil.php">Profil</a></li>
                <li><a href="produk.php">Produk</a></li>
                <li><a href="user-data-kategori.php">Data Kategori</a></li>
                <li><a href="user-data-produk.php">Data Produk</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </header>

    <!--content-->
    <div class="section">
        <div class="container">
            <h3>Data Kategori</h3>
            <div class="box">
                <button class="btn btn-primary mb-2">
                    <a href="tambah-kategori.php" style="color: white;">Tambah Kategori</a>
                </button>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Kategori</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                        if(mysqli_num_rows($kategori) > 0){
                        while ($row = mysqli_fetch_array($kategori)) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['category_name']; ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm me-1" onclick="window.location.href='edit-kategori.php?id=<?php echo $row['category_id']; ?>'">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm me-1" onclick="if(confirm('Yakin ingin menghapus?')) { window.location.href='hapus-kategori.php?id=<?php echo $row['category_id']; ?>' }">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php }}else{ ?>
                            <tr>
                                <td colspan="3">Tidak ada data</td>
                            </tr>
                        <?php
                        }
                         ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--footer-->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - Kelompok 4 </small>
        </div>
    </footer>

    <!-- Link Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
