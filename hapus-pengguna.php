<?php
session_start();
include 'db.php';

if ($_SESSION['s_login'] != true) {
    echo '<script>window.location="signup.php"</script>';
}

// Tangani aksi hapus
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete_query = mysqli_query($conn, "DELETE FROM tb_admin WHERE admin_id = '$id'");
    if ($delete_query) {
        echo '<script>alert("Pengguna berhasil dihapus")</script>';
        echo '<script>window.location="daftar-pengguna.php"</script>';
    } else {
        echo '<script>alert("Pengguna gagal dihapus")</script>';
        echo '<script>window.location="daftar-pengguna.php"</script>';
    }
}
?>
