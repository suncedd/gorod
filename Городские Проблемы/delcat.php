<?php
include "db.php"; // подключение к бд

session_start();

$stmt = mysqli_query($link,"DELETE FROM `category` WHERE id = '$_POST[del]'"); // запись в таблицу userinfo

$_SESSION["message_delete_cat"] = true; // присвоение переменной в сессии
header("Location: admin.php");    // открытие личного кабинета

?>