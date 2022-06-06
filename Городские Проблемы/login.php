<?php
include "db.php"; // подключение к бд

    session_start(); // старт сессии
    $stmt = mysqli_query($link,"SELECT * FROM userinfo WHERE Login = '".mysqli_real_escape_string($link,$_POST['login'])."'"); // запрос к бд с проверкой введенного логина
    $data = mysqli_fetch_assoc($stmt); 

    if($data['password'] === $_POST['password']) {
        $_SESSION["user_name"] = $_POST['login'];
        header("Location: mylib.php"); // успешный вход
        $_SESSION["message_true"] = true;
        $_SESSION["check_login"] = true;
        $_SESSION["check_status"] = $data['status'];
        $_SESSION["user_id"] = $data['id'];
    }
    else {
        header("Location: auth.php"); 
        $_SESSION["message_false"] = true; // не успешный вход
    } 
?>