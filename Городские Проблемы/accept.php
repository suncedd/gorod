<?php
include "db.php"; // подключение к бд

session_start();

if(isset($_POST['submit']) and $_FILES){
	move_uploaded_file($_FILES['photo']['tmp_name'], "uploades/".$_FILES['photo']['name']);
}

$_namephoto = $_FILES['photo']['name'];

//echo "<script>alert(\"Результат: $_namephoto,$_POST[submit]\");</script>"; 

if(!empty($_POST['submit'])) {
    $stmt = mysqli_query($link,"UPDATE application SET `status`= '1',`accphoto`= '$_namephoto' WHERE id = '$_POST[submit]'"); // смена информации в таблице application

    $_SESSION["message_accpet"] = true; // присвоение переменной в сессии
    header("Location: admin.php");  
}
?>