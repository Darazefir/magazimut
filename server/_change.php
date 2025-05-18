<?php
session_start();
require_once('_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $app_id = $_POST['app_id'];
    $status_id = $_POST['status'];

    $sql = "UPDATE `apps` SET status_id='$status_id' WHERE app_id='$app_id'";
    if ($mysqli->query($sql)) {
        header("location: ../admin.php");
    } else {
        echo 'error: ' . $mysqli->error;
    }
}
exit();
