<?php
session_start();
include 'db.php';
if ($_SESSION['s_login'] != true) {
    echo '<script>window.location="signup.php"</script>';
}

// Get the product ID passed from the cron job command
$product_id = isset($argv[1]) ? $argv[1] : null;

// Check if product ID is provided and numeric
if (!is_null($product_id) && is_numeric($product_id)) {
    // Delete the product from the database
    $delete_query = "DELETE FROM tb_product WHERE product_id = $product_id";
    mysqli_query($conn, $delete_query);
}
?>
