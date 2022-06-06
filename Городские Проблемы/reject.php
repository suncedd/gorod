<?php
include "db.php"; // подключение к бд

session_start();

if(!empty($_POST['reject'])) {
    $stmt = mysqli_query($link,"UPDATE application SET `status`= '2' WHERE id = '$_POST[reject]'"); // смена информации в таблице application

    $_SESSION["message_reject"] = true; // присвоение переменной в сессии
    header("Location: admin.php");  
}
?>