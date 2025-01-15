<?php

// Настройки соединения с базой данных
$host = 'localhost';
$dbname = 'comments_db';
$username = 'root';
$password = '';

// Создание соединения
$conn = new mysqli($host, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8");

?>