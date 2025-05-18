<?php
require_once('_conn.php');
session_start();
$msg = array();
if (isset($_SESSION['msg'])) {
    $_SESSION['msg'] = 0;
    $msg[] = '';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['user_email'];
    $pwd = $_POST['user_pwd'];
    $admin = "admin@admin.ru";

    // Проверка на пустое значение
    if (!empty($email) && !empty($pwd)) {
        // Подготовленный запрос для предотвращения SQL-инъекций
        $sql = "SELECT * FROM `users` WHERE `user_email` = (?)";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            die("Ошибка подготовки запроса: " . $mysqli->error);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            die("Query failed: " . $mysqli->error);
        }

        // Проверка на совпадение данных
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($pwd, $row['user_password'])) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_name'] = $row['user_name'];
                if ($email == $admin) {
                    header("Location: ../admin.php");
                    exit();
                } else {
                    header("Location: ../user/index.php");
                    exit();
                }
            } else {
                $msg[] = 'Пароль неверный';
            }
        } else {
            $msg[] = 'Нет пользователя с такой электронной почтой';
        }
    } else {
        $msg[] = 'Произошла ошибка';
    }
}
if ($msg!=0) {
    $_SESSION['msg'] = $msg;
    header("Location: ../authentication.php");
    exit;
}

$mysqli->close();
