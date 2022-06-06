<?php
require_once "db.php"; // подключение к бд
session_start();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <main class="main">
    <nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Городской портал</a>
            </div>
    
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php">Главная</a></li>
                    <li><a href="regis.php">Зарегистрироваться</a></li>                    
                    <li class="dropdown">
                    
                    <?php if ($_SESSION["check_login"] == true): ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $name; ?><span class="caret"></span></a> 
                        <?php else: ?>
                            <li class="active"><a href="auth.php">Войти</a></li>
                        <?php endif; ?> 

                        <ul class="dropdown-menu">
                            <li><a href="mylib.php">Мои заявки</a></li>
                            <li><a href="new.php">Новая заявка</a></li>
                            <?php if ($_SESSION["check_status"] == "1"): ?>
                             <li><a href="admin.php">Админ панель</a></li>       
                    <?php endif; ?> 
                            <li role="separator" class="divider"></li>
                            <li><a href="unauth.php">Выход</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

        <div class="jumbotron">
            <div class="container">
                <div class="blocktop">
                <div class="block">
                <form method="POST" action="login.php">  
                        <h3>Авторизация</h3>
                        <p class="textreg">Логин</p><input required class="inputreg" name="login" type="text" min="5" max = "30">
                        <p class="textreg">Пароль</p><input required class="inputreg" name="password" type="password" min="5" max = "30">
                        <p class="textreg"><button class="btn btn-primary btn-lg">Войти</button></p>
                        </form>
                </div>
            </div>
            </div>
        </div>

        <?php
                    session_start(); // проверка на отправку отзыва
                    if ($_SESSION["message_true"] == true){
                        $name = $_SESSION["user_name"];
                        echo "<script>alert(\"Добро пожаловать $name, ваш аккаунт успешно зарегистрирован.\");</script>"; 
                        $_SESSION["message_true"] = false;
                    }  
                    else if ($_SESSION["message_false"] == true){
                        echo "<script>alert(\"Вход не удался, возможно вы ввели не верные данные.\");</script>"; 
                        $_SESSION["message_false"] = false;
                    }        
                ?>
    </main>

    <footer class="footer1">
        <img class="footer" src="img/vk.png" height="40" width="40"/>
        <img class="footer" src="img/telegram.png" height="40" width="40"/>
        <img class="footer" src="img/twitter.png"/>
        <img class="footer" src="img/instagram.png" height="40" width="40"/>
        <div class="credit">All rights reserved. ©2022.</div>
    </footer>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>