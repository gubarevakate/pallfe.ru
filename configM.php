<?php

// Установка соединения с базой данных
$mysqli = new mysqli("localhost", "root", "", "user");
if ($mysqli->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}
?>