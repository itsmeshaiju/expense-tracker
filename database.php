<?php
$db_host = 'localhost';
$db_name = 'new_project';
$db_user = 'root';
$db_password = '';

$conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
