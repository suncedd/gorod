<?php
include "db.php"; // подключение к бд

session_start();

$stmt = mysqli_query($link,"DELETE FROM `application` WHERE id = '$_POST[del]'"); // запись в таблицу userinfo

$_SESSION["message_delete"] = true; // присвоение переменной в сессии
header("Location: mylib.php");    // открытие личного кабинета

?>