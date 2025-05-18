<?php
session_start();
require_once('_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];

    $sql = "DELETE FROM `products` WHERE product_id='$product_id'";
    if ($mysqli->query($sql)) {
        header("location: ../allproducts.php");
    } else {
        echo 'error: ' . $mysqli->error;
    }
}
exit();
