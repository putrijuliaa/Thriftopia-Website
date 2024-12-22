<?php
error_reporting(); // Menampilkan semua error untuk debugging
session_start();
include 'db.php';
if ($_SESSION['s_login'] != true) {
    echo '<script>window.location="signup.php"</script>';
}
    if(isset($_GET['id'])){
        $delete = mysqli_query($conn, "DELETE FROM tb_category WHERE category_id = '".$_GET['id']."' ");
        echo '<script>window.location="data-kategori.php"</script>';
    }
?>