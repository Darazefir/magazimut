<?php

// Инициализируем сессию
session_start();

// Удаляем все переменные сессии
$_SESSION = array();

// уничтожаем сессию

session_destroy();
session_abort();

header("Location: ../index.php");

exit();

?>