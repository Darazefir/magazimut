<?php
require_once("_conn.php");

session_start();
$msg = array();
if (isset($_SESSION['msg'])) {
    $_SESSION['msg'] = 0;
    $msg = 0;
}

// Обработка данных формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["user_name"]);
    $phone = htmlspecialchars($_POST["user_phone"]);
    $email = htmlspecialchars($_POST["user_email"]);
    $pwd = password_hash($_POST["user_pwd"], PASSWORD_DEFAULT);
    $agree = $_POST["agree"];

    // Серверная валидация
    if (empty($name) || empty($phone) || empty($email) || empty($pwd) || empty($agree)) {
        $msg[] = 'Пожалуйста, заполните все поля';
    }

    // Проверка формата email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg[] = "Неверный формат email.";
    }

    // Проверка уникальности email
    $sql = "SELECT `user_id` FROM `users` WHERE user_email = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $msg[] = 'Такая почта уже существует';
    }

    if ($msg>0) {
        $_SESSION['msg'] = $msg;
        header("Location: ../authentication.php");
        exit;
    }

    // Вставка данных в таблицу
    $sql = "INSERT INTO `users`(`user_name`, `user_phone`, `user_email`, `user_password`) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssss", $name, $phone, $email, $pwd);

    if ($stmt->execute()) {
        // Перенаправление на страницу профиля с передачей ID пользователя
        $user_id = $stmt->insert_id;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_name'] = $name;
        header("Location: ../user/index.php");
        exit;
    } else {
        echo "Ошибка регистрации: " . $stmt->error;
    }

    $stmt->close();
}
$msg[] = 'Произошла ошибка';

$mysqli->close();
exit();
?>