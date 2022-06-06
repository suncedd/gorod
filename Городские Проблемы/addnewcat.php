<?php
include "db.php"; // подключение к бд

session_start();

if(!empty($_POST['name']))
{ 
    $stmt = mysqli_query($link,"insert into category(`name`) VALUES  ('$_POST[name]')"); // запись в таблицу category

    $_SESSION["message_true_cat"] = true; // присвоение переменной в сессии
    header("Location: admin.php");  
} 
?>