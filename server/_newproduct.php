<?php

require_once("_conn.php");

session_start();

// Обработка данных формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $product_description = $_POST["product_description"];
    $product_price = $_POST["product_price"];
    $category_id = $_POST["category_id"];
    $uploaddir = 'assets/products/';
    $uploadfile = $uploaddir . basename($_FILES['product_pic']['name']);

    $sql = "INSERT INTO `products`(`product_name`, `product_description`, `product_pic`, `category_id`, `product_price`) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssii", $product_name, $product_description, $uploadfile, $category_id, $product_price);

    if ($stmt->execute()) {
        if (move_uploaded_file($_FILES['product_pic']['tmp_name'], $uploadfile)) {
        header("Location: ../user/allproducts.php");
        exit;
        }
    } else {
        echo "Ошибка: " . $stmt->error;
    }

    $stmt->close();
}
?>