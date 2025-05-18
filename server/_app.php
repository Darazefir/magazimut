<?php
require_once("_conn.php");

session_start();

// Обработка данных формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $delivery = $_POST["delivery_id"];

    $sql = "INSERT INTO `apps`(`user_id`, `product_id`, `delivery_id`) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("iii", $user_id, $product_id, $delivery);

    if ($stmt->execute()) {
        header("Location: ../user/index.php");
        exit;
    } else {
        echo "Ошибка: " . $stmt->error;
    }

    $stmt->close();
}



?>