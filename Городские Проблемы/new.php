<?php
require_once "db.php"; // подключение к бд
session_start();
$name = $_SESSION["user_name"];

$shcategory = $link->query("SELECT * FROM category");

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Новая заявка</title>
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
                            <li><a href="auth.php">Войти</a></li>
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
            <div class="block-regis">
            <form method="POST" action="addnew.php" enctype="multipart/form-data"> 
            <h2>Мы решим вашу проблемы за кротчайший срок!</h2>
            <p class="textreg">Название проблемы</p><input required class="inputreg" name="name" type="text" min="5" max = "30">
            <p class="textreg">Описание</p><input required class="inputreg" name="opis" type="text" min="5" max = "30">
            <p class="textreg">Категория проблемы</p>
            <p class="textreg"><select name="category">
                <?php foreach ($shcategory as $rez => $show) /* заполнение списка данными*/ : ?> 
                    <option value="<?= htmlspecialchars($show['name']) ?>"><?= htmlspecialchars($show['name']) ?></option>
                <?php endforeach; ?>
            </select></p>                      
            <p class="textreg">Фото</p>
            <input required id="file-uploader" class="inputreg" type="file" accept="image/png, image/jpeg" name="photo">
            <p id="feedback" ></p>           
            <p id="image-grid"></p>
            <div class="input_cheack-box">
            <p class="textreg">Временная метка добавления заявки</p>
            <div class="reg">
            <input required class="inputreg reg" name="checkdn" type="checkbox"> 
        </div>
        </div>
            <input class="btn btn-primary btn-lg"  name="submit" type="submit" value="Оформить заявку">
            </form>
        </div>
        </div>
    </div>    
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
    <script src="js/addnewphoto.js"></script>
</body>
</html>