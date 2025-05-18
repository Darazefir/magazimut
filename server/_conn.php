<?php 
$servername = "MySQL-8.0";
$username = "root";
$password = "";
$dbname = "db_magazimut";

$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Ошибка подключения: " . $mysqli->connect_error);
}
?>