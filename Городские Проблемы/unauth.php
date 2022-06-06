<?php
include "db.php"; // подключение к бд

    session_start(); // старт сессии
    
    $_SESSION["check_status"] = 0;
    $_SESSION["check_login"] = false;
    $_SESSION["user_id"] = 0;
    header("Location: index.php");
?>