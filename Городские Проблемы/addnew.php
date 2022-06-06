<?php
include "db.php"; // подключение к бд

session_start();

if(isset($_POST['submit']) and $_FILES){
	move_uploaded_file($_FILES['photo']['tmp_name'], "uploades/".$_FILES['photo']['name']);
}

$_namephoto = $_FILES['photo']['name'];
$_userID = $_SESSION["user_id"];

//echo "<script>alert(\"Результат: $_POST[name],$_POST[opis],$_POST[category],$_namephoto,$_userID \");</script>"; 

if(!empty($_POST['name']) && !empty($_POST['opis']) && !empty($_POST['category']))
{ 
    $stmt = mysqli_query($link,"insert into application(`userid`,`name`, `opis`, `category`, `photo`, `status`) VALUES  ('$_userID', '$_POST[name]', '$_POST[opis]', '$_POST[category]', '$_namephoto', '0')"); // запись в таблицу application

    $_SESSION["message_true"] = true; // присвоение переменной в сессии
    header("Location: mylib.php");  
} 
?>