<?php
include "db.php"; // подключение к бд

session_start();

if(!empty($_POST['text'])) {
    $stmt = mysqli_query($link,"UPDATE category SET `name`= '$_POST[text]' WHERE id = '$_POST[edit]'"); // смена информации в таблице application

    $_SESSION["message_accpet_cat"] = true; // присвоение переменной в сессии
    header("Location: admin.php");  
}
?>