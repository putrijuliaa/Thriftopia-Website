<?php
error_reporting(); // Menampilkan semua error untuk debugging
session_start();
include 'db.php';
if ($_SESSION['s_login'] != true) {
    echo '<script>window.location="signup.php"</script>';
}

$product_id = $_GET['id'];
// Ambil informasi produk
$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id='$product_id'");
$p = mysqli_fetch_object($produk);

// Update status link menjadi sudah diklik untuk produk yang sesuai
if ($p->link_click_count < 3) {
    // Update jumlah klik dan status link
    $newClickCount = $p->link_click_count + 1;
    $update = mysqli_query($conn, "UPDATE tb_product SET link_click_count = '$newClickCount', link_clicked = 1 WHERE product_id = '$product_id'");

// Redirect ke WhatsApp jika update berhasil
if ($update) {
    $kontak = mysqli_query($conn, "SELECT admin_telp FROM tb_admin WHERE admin_id = (SELECT added_by FROM tb_product WHERE product_id = '$product_id')");
    $admin = mysqli_fetch_object($kontak);

    // Membentuk URL produk secara dinamis
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $path = "/thriftopia1/thriftopia/detail-produk.php?id=$product_id";
    $product_link = $protocol . $host . $path;

    $message = "Hai, saya tertarik dengan produk Anda. Berikut adalah tautan produknya: $product_link";

    header("Location: https://api.whatsapp.com/send?phone=" . preg_replace('/^\+/', '', $admin->admin_telp) . "&text=" . urlencode($message));
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
} else {
echo "Link sudah tidak aktif.";
}
exit();