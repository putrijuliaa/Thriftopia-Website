<?php
error_reporting(); // Menampilkan semua error untuk debugging
session_start();
include 'db.php';
if ($_SESSION['s_login'] != true) {
    echo '<script>window.location="signup.php"</script>';
}

$product_id = $_GET['id'];
$admin_id = $_SESSION['admin_id'];

// Update status link menjadi belum diklik untuk produk yang sesuai
$update = mysqli_query($conn, "UPDATE tb_product SET link_clicked = 0 WHERE product_id = $product_id");

// Redirect ke halaman detail produk setelah reset berhasil
if ($update) {
    header("Location: detail-produk.php?id=$product_id&reset_success=1");
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
exit();
?>