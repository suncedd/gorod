<?php
require_once "db.php"; // подключение к бд
session_start();
$name = $_SESSION["user_name"];

$messages = $link->query("SELECT * FROM application WHERE status = '1'");

$users = $link->query("SELECT * FROM userinfo");

foreach ($users as $rez => $user) {
    $nameuser[$rez] = $user['login'];
}
$rezuser = $rez;

foreach ($messages as $key => $message) {
        $arrid[$key] = $message['id'];
        $accphoto[$key] = $message['accphoto'];
        $arrphoto[$key] = $message['photo'];
        $arrdate[$key] = $message['date'];
        $arrname[$key] = $message['name'];
        $arropis[$key] = $message['opis'];
        $arrcategory[$key] = $message['category'];
}
$max = $key;

?>
<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Улучши свой город</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/twentytwenty.css">
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
                    <li class="active"><a href="index.php">Главная</a></li>               
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

    <!-- СДЕЛАТЬ div и расположить красиво -->
    <p>Количество пользователей: <?php echo $rezuser+1; ?></p>
    <p>Количество решенных заявок: <?php echo $key+1; ?></p>

    <div class="jumbotron">
        <div class="container">
            <h1>Привет, дорогой друг!</h1>
            <p>
                Вместе мы сможем улучшить наш любимый город. Нам очень сложно узнать обо всех проблемах города, поэтому
                мы
                предлагаем тебе помочь своему городу!
            </p>
            <p>
                Увидел проблему? Дай нам знать о ней и мы ее решим!
            </p>
            <p>
                <?php if ($_SESSION["check_login"] == true): ?>
                    <a class="btn btn-success btn-lg" href="new.php" role="button">Сообщить о проблеме</a>
                        <?php else: ?>
                            <a class="btn btn-success btn-lg" href="auth.php" role="button">Сообщить о проблеме</a>
                        <?php endif; ?> 
                <a class="btn btn-primary btn-lg" href="regis.php" role="button">Присоедениться к проекту</a>
            </p>
        </div>
    </div>

    <div class="container">
        <h2>Последние решенные проблемы</h2>
        <br>
        <div class="row">
            <?php if ($arrid[$max] != null): ?>
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                        <p>Дата: <?php echo $arrdate[$max]; ?></p>
                        <p>Название: <?php echo $arrname[$max]; ?></p>
                        <p>Описание: <?php echo $arropis[$max]; ?></p>
                        <p>Категория: <?php echo $arrcategory[$max]; ?></p>
                    <div class="before-after">
                        <!-- Картинка  "до" -->
                        <img class="before-after__item" src="uploades/<?php echo $arrphoto[$max]; ?>" height="400" width="300" />

                        <!-- Картинка  "после" -->
                        <img class="before-after__item" src="uploades/<?php echo $accphoto[$max]; ?>" height="400" width="300" />
                    </div>
                </div>
            </div>
            <?php else: ?>
                <p>Нет последних заявок!</p>
            <?php endif; ?> 
            <?php if ($max >= "1"): ?>
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                        <p>Дата: <?php echo $arrdate[$max-1]; ?></p>
                        <p>Название: <?php echo $arrname[$max-1]; ?></p>
                        <p>Описание: <?php echo $arropis[$max-1]; ?></p>
                        <p>Категория: <?php echo $arrcategory[$max-1]; ?></p>
                <div class="before-after">
                        <!-- Картинка  "до" -->
                        <img class="before-after__item" src="uploades/<?php echo $arrphoto[$max-1]; ?>" height="400" width="300" />

                        <!-- Картинка  "после" -->
                        <img class="before-after__item" src="uploades/<?php echo $accphoto[$max-1]; ?>" height="400" width="300" />
                    </div>
                </div>
            </div>
            <?php endif; ?> 
            <?php if ($max >= "2"): ?>
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                        <p>Дата: <?php echo $arrdate[$max-2]; ?></p>
                        <p>Название: <?php echo $arrname[$max-2]; ?></p>
                        <p>Описание: <?php echo $arropis[$max-2]; ?></p>
                        <p>Категория: <?php echo $arrcategory[$max-2]; ?></p>
                <div class="before-after">
                        <!-- Картинка  "до" -->
                        <img class="before-after__item" src="uploades/<?php echo $arrphoto[$max-2]; ?>" height="400" width="300" />

                        <!-- Картинка  "после" -->
                        <img class="before-after__item" src="uploades/<?php echo $accphoto[$max-2]; ?>" height="400" width="300" />
                    </div>
                </div>
            </div>
            <?php endif; ?> 
            <?php if ($max >= "3"): ?>
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                        <p>Дата: <?php echo $arrdate[$max-3]; ?></p>
                        <p>Название: <?php echo $arrname[$max-3]; ?></p>
                        <p>Описание: <?php echo $arropis[$max-3]; ?></p>
                        <p>Категория: <?php echo $arrcategory[$max-3]; ?></p>
                <div class="before-after">
                        <!-- Картинка  "до" -->
                        <img class="before-after__item" src="uploades/<?php echo $arrphoto[$max-3]; ?>" height="400" width="300" />

                        <!-- Картинка  "после" -->
                        <img class="before-after__item" src="uploades/<?php echo $accphoto[$max-3]; ?>" height="400" width="300" />
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if ($max >= "4"): ?> 
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                        <p>Дата: <?php echo $arrdate[$max-4]; ?></p>
                        <p>Название: <?php echo $arrname[$max-4]; ?></p>
                        <p>Описание: <?php echo $arropis[$max-4]; ?></p>
                        <p>Категория: <?php echo $arrcategory[$max-4]; ?></p>
                    <div class="before-after">
                        <!-- Картинка  "до" -->
                        <img class="before-after__item" src="uploades/<?php echo $arrphoto[$max-4]; ?>" height="400" width="300" />

                        <!-- Картинка  "после" -->
                        <img class="before-after__item" src="uploades/<?php echo $accphoto[$max-4]; ?>" height="400" width="300" />
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if ($max >= "5"): ?> 
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                        <p>Дата: <?php echo $arrdate[$max-5]; ?></p>
                        <p>Название: <?php echo $arrname[$max-5]; ?></p>
                        <p>Описание: <?php echo $arropis[$max-5]; ?></p>
                        <p>Категория: <?php echo $arrcategory[$max-5]; ?></p>
                    <div class="before-after">
                        <!-- Картинка  "до" -->
                        <img class="before-after__item" src="uploades/<?php echo $arrphoto[$max-5]; ?>" height="400" width="300" />

                        <!-- Картинка  "после" -->
                        <img class="before-after__item" src="uploades/<?php echo $accphoto[$max-5]; ?>" height="400" width="300" />
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if ($max >= "6"): ?> 
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                        <p>Дата: <?php echo $arrdate[$max-6]; ?></p>
                        <p>Название: <?php echo $arrname[$max-6]; ?></p>
                        <p>Описание: <?php echo $arropis[$max-6]; ?></p>
                        <p>Категория: <?php echo $arrcategory[$max-6]; ?></p>
                <div class="before-after">
                        <!-- Картинка  "до" -->
                        <img class="before-after__item" src="uploades/<?php echo $arrphoto[$max-6]; ?>" height="400" width="300" />

                        <!-- Картинка  "после" -->
                        <img class="before-after__item" src="uploades/<?php echo $accphoto[$max-6]; ?>" height="400" width="300" />
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if ($max >= "7"): ?> 
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                        <p>Дата: <?php echo $arrdate[$max-7]; ?></p>
                        <p>Название: <?php echo $arrname[$max-7]; ?></p>
                        <p>Описание: <?php echo $arropis[$max-7]; ?></p>
                        <p>Категория: <?php echo $arrcategory[$max-7]; ?></p>
                        <div class="before-after">
                        <!-- Картинка  "до" -->
                        <img class="before-after__item" src="uploades/<?php echo $arrphoto[$max-7]; ?>" height="400" width="300" />

                        <!-- Картинка  "после" -->
                        <img class="before-after__item" src="uploades/<?php echo $accphoto[$max-7]; ?>" height="400" width="300" />
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php
                    session_start(); // проверка на отправку отзыва
                    if ($_SESSION["message_true"] == true){
                        $name = $_SESSION["user_name"];
                        echo "<script>alert(\"Добро пожаловать $name!\");</script>"; 
                        $_SESSION["message_true"] = false;
                    }        
                ?>
</main>
    <footer class="footer1">
        <img class="footer" src="img/vk.png" height="40" width="40" />
        <img class="footer" src="img/telegram.png" height="40" width="40" />
        <img class="footer" src="img/twitter.png" />
        <img class="footer" src="img/instagram.png" height="40" width="40" />
        <div class="credit">All rights reserved. ©2022.</div>
    </footer>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- Скрипты -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./js/jquery.event.move.js"></script>
    <script src="./js/jquery.twentytwenty.js"></script>
    <script>
        $(function () {
            $(".before-after").twentytwenty({
                move_slider_on_hover: true,
                no_overlay: true,
            });
        });
    </script>

</body>

</html>