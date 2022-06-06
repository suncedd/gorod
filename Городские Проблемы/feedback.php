<?php
include "db.php"; // подключение к бд

session_start();

if(!empty($_POST['fio']) && !empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['passwordrec']))
{ 
    if ($_POST['password'] != $_POST['passwordrec']) {
        $_SESSION["message_false"] = true; // присвоение переменной в сессии
        header("Location: regis.php");    // открытие страницы с отправкой формы 
    }
    else {

        if ($_POST['login'] == "admin" || $_POST['login'] == "Admin") {
            $_status = 1;
        }
        else {
            $_status = 0;
        }

        $stmt = mysqli_query($link,"insert into userinfo(`fio`, `login`, `email`, `password`, `status`) VALUES  ('$_POST[fio]', '$_POST[login]', '$_POST[email]', '$_POST[password]', '$_status')"); // запись в таблицу userinfo
    
        $_SESSION["user_name"] = "$_POST[login]";
        $_SESSION["message_true"] = true; // присвоение переменной в сессии
        $_SESSION["check_login"] = false;
        header("Location: auth.php");    // открытие страницы с отправкой формы      
    }  
} 
?>