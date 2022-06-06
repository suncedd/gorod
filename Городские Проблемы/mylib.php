<?php
require_once "db.php"; // подключение к бд
session_start();
$name = $_SESSION["user_name"];

$showst = 3;

$messages = $link->query("SELECT * FROM application WHERE userid = '".mysqli_real_escape_string($link,$_SESSION["user_id"])."'");

foreach ($messages as $key => $message) {
        $arrid[$key] = $message['id'];
        $arrdate[$key] = $message['date'];
        $arrcategory[$key] = $message['category'];
        $arrstatus[$key] = $message['status'];
        $arrphoto[$key] = $message['photo'];
}
$max = $key;

if ($_POST['showstatus'] == null) {
    $showst = 3;
}
else {
    $showst = $_POST['showstatus'];
}

?>

<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Личный кабинет</title>
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
            <p>
                Увидел новую проблему? Дай нам знать о ней и мы ее решим!
            </p>
            <p>
               <a class="btn btn-success btn-lg" href="new.php" role="button">Сообщить о проблеме</a>
            </p>
        </div>
    </div>
         
    <h3>Отображаемые заявки:</h3>
    <form method="POST"> 
    <p class="textreg"><select name="showstatus">
                <option value="3">Все</option>
                <option value="0">Новые</option>
                <option value="1">Решенные</option>
                <option value="2">Отклоненные</option>              
            </select></p>  
            <button name="show">Отобразить</button> 
    </form> 

    <div class="container">
        <h2>Ваши заявки</h2>
        <br>
        <div class="row">
            <?php if ($arrid[$max] != null): ?>
                <?php if ($showst == $arrstatus[$max] || $showst == 3): ?>
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                        <p>Номер заявки: <?php echo $arrid[$max]; ?> </p>
                        <p>Дата: <?php echo $arrdate[$max]; ?></p>
                        <p>Категория: <?php echo $arrcategory[$max]; ?></p>
                        <?php if ($arrstatus[$max] == "0"): ?>
                            <p>Статус: новая</p>
                            <img src="uploades/<?php echo $arrphoto[$max]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button class="textreg" name="del" value="<?php echo $arrid[$max]; ?>">Удалить заявку</button>
                            </from>
                        <?php elseif ($arrstatus[$max] == "1"): ?>
                            <p>Статус: решена</p>
                            <img src="uploades/<?php echo $arrphoto[$max]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button disabled class="textreg" name="del" value="<?php echo $arrid[$max]; ?>"><s>Удалить заявку</s></button>
                            </from>
                        <?php elseif ($arrstatus[$max] == "2"): ?>
                            <p>Статус: отклонена</p>
                            <img src="uploades/<?php echo $arrphoto[$max]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button disabled class="textreg" name="del" value="<?php echo $arrid[$max]; ?>"><s>Удалить заявку</s></button>
                            </from>
                        <?php endif; ?>                  
                </div>
            </div>
                <?php endif; ?> 
            <?php else: ?>
                <p>У вас нет заявок!</p>
            <?php endif; ?> 
            <?php if ($max >= "1"): ?>
                <?php if ($showst == $arrstatus[$max-1] || $showst == 3): ?>
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                        <p>Номер заявки: <?php echo $arrid[$max-1]; ?> </p>
                        <p>Дата: <?php echo $arrdate[$max-1]; ?></p>
                        <p>Категория: <?php echo $arrcategory[$max-1]; ?></p>
                        <?php if ($arrstatus[$max-1] == "0"): ?>
                            <p>Статус: новая</p>
                            <img src="uploades/<?php echo $arrphoto[$max-1]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button class="textreg" name="del" value="<?php echo $arrid[$max-1]; ?>">Удалить заявку</button>
                            </from>
                        <?php elseif ($arrstatus[$max-1] == "1"): ?>
                            <p>Статус: решена</p>
                            <img src="uploades/<?php echo $arrphoto[$max-1]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button disabled class="textreg" name="del" value="<?php echo $arrid[$max-1]; ?>"><s>Удалить заявку</s></button>
                            </from>
                        <?php elseif ($arrstatus[$max-1] == "2"): ?>
                            <p>Статус: отклонена</p>
                            <img src="uploades/<?php echo $arrphoto[$max-1]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button disabled class="textreg" name="del" value="<?php echo $arrid[$max-1]; ?>"><s>Удалить заявку</s></button>
                            </from>
                        <?php endif; ?>                  
                </div>
            </div>
                <?php endif; ?> 
            <?php endif; ?> 
            <?php if ($max >= "2"): ?>
                <?php if ($showst == $arrstatus[$max-2] || $showst == 3): ?>
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                        <p>Номер заявки: <?php echo $arrid[$max-2]; ?> </p>
                        <p>Дата: <?php echo $arrdate[$max-2]; ?></p>
                        <p>Категория: <?php echo $arrcategory[$max-2]; ?></p>
                        <?php if ($arrstatus[$max-2] == "0"): ?>
                            <p>Статус: новая</p>
                            <img src="uploades/<?php echo $arrphoto[$max-2]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button class="textreg" name="del" value="<?php echo $arrid[$max-2]; ?>">Удалить заявку</button>
                            </from>
                        <?php elseif ($arrstatus[$max-2] == "1"): ?>
                            <p>Статус: решена</p>
                            <img src="uploades/<?php echo $arrphoto[$max-2]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button disabled class="textreg" name="del" value="<?php echo $arrid[$max-2]; ?>"><s>Удалить заявку</s></button>
                            </from>
                        <?php elseif ($arrstatus[$max-2] == "2"): ?>
                            <p>Статус: отклонена</p>
                            <img src="uploades/<?php echo $arrphoto[$max-2]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button disabled class="textreg" name="del" value="<?php echo $arrid[$max-2]; ?>"><s>Удалить заявку</s></button>
                            </from>
                        <?php endif; ?>                  
                </div>
            </div>
                <?php endif; ?> 
            <?php endif; ?> 
            <?php if ($max >= "3"): ?>
                <?php if ($showst == $arrstatus[$max-3] || $showst == 3): ?>
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                        <p>Номер заявки: <?php echo $arrid[$max-3]; ?> </p>
                        <p>Дата: <?php echo $arrdate[$max-3]; ?></p>
                        <p>Категория: <?php echo $arrcategory[$max-3]; ?></p>
                        <?php if ($arrstatus[$max-3] == "0"): ?>
                            <p>Статус: новая</p>
                            <img src="uploades/<?php echo $arrphoto[$max-3]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button class="textreg" name="del" value="<?php echo $arrid[$max-3]; ?>">Удалить заявку</button>
                            </from>
                        <?php elseif ($arrstatus[$max-3] == "1"): ?>
                            <p>Статус: решена</p>
                            <img src="uploades/<?php echo $arrphoto[$max-3]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button disabled class="textreg" name="del" value="<?php echo $arrid[$max-3]; ?>"><s>Удалить заявку</s></button>
                            </from>
                        <?php elseif ($arrstatus[$max-3] == "2"): ?>
                            <p>Статус: отклонена</p>
                            <img src="uploades/<?php echo $arrphoto[$max-3]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button disabled class="textreg" name="del" value="<?php echo $arrid[$max-3]; ?>"><s>Удалить заявку</s></button>
                            </from>
                        <?php endif; ?>                  
                </div>
            </div>
                <?php endif; ?> 
            <?php endif; ?> 
            <?php if ($max >= "4"): ?>
                <?php if ($showst == $arrstatus[$max-4] || $showst == 3): ?>
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                        <p>Номер заявки: <?php echo $arrid[$max-4]; ?> </p>
                        <p>Дата: <?php echo $arrdate[$max-4]; ?></p>
                        <p>Категория: <?php echo $arrcategory[$max-4]; ?></p>
                        <?php if ($arrstatus[$max-4] == "0"): ?>
                            <p>Статус: новая</p>
                            <img src="uploades/<?php echo $arrphoto[$max-4]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button class="textreg" name="del" value="<?php echo $arrid[$max-4]; ?>">Удалить заявку</button>
                            </from>
                        <?php elseif ($arrstatus[$max-4] == "1"): ?>
                            <p>Статус: решена</p>
                            <img src="uploades/<?php echo $arrphoto[$max-4]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button disabled class="textreg" name="del" value="<?php echo $arrid[$max-4]; ?>"><s>Удалить заявку</s></button>
                            </from>
                        <?php elseif ($arrstatus[$max-4] == "2"): ?>
                            <p>Статус: отклонена</p>
                            <img src="uploades/<?php echo $arrphoto[$max-4]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button disabled class="textreg" name="del" value="<?php echo $arrid[$max-4]; ?>"><s>Удалить заявку</s></button>
                            </from>
                        <?php endif; ?>                  
                </div>
            </div>
                <?php endif; ?> 
            <?php endif; ?> 
            <?php if ($max >= "5"): ?>
                <?php if ($showst == $arrstatus[$max-5] || $showst == 3): ?>
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                        <p>Номер заявки: <?php echo $arrid[$max-5]; ?> </p>
                        <p>Дата: <?php echo $arrdate[$max-5]; ?></p>
                        <p>Категория: <?php echo $arrcategory[$max-5]; ?></p>
                        <?php if ($arrstatus[$max-5] == "0"): ?>
                            <p>Статус: новая</p>
                            <img src="uploades/<?php echo $arrphoto[$max-5]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button class="textreg" name="del" value="<?php echo $arrid[$max-5]; ?>">Удалить заявку</button>
                            </from>
                        <?php elseif ($arrstatus[$max-5] == "1"): ?>
                            <p>Статус: решена</p>
                            <img src="uploades/<?php echo $arrphoto[$max-5]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button disabled class="textreg" name="del" value="<?php echo $arrid[$max-5]; ?>"><s>Удалить заявку</s></button>
                            </from>
                        <?php elseif ($arrstatus[$max-5] == "2"): ?>
                            <p>Статус: отклонена</p>
                            <img src="uploades/<?php echo $arrphoto[$max-5]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button disabled class="textreg" name="del" value="<?php echo $arrid[$max-5]; ?>"><s>Удалить заявку</s></button>
                            </from>
                        <?php endif; ?>                  
                </div>
            </div>
                <?php endif; ?> 
            <?php endif; ?> 
            <?php if ($max >= "6"): ?>
                <?php if ($showst == $arrstatus[$max-6] || $showst == 3): ?>
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                        <p>Номер заявки: <?php echo $arrid[$max-6]; ?> </p>
                        <p>Дата: <?php echo $arrdate[$max-6]; ?></p>
                        <p>Категория: <?php echo $arrcategory[$max-6]; ?></p>
                        <?php if ($arrstatus[$max-6] == "0"): ?>
                            <p>Статус: новая</p>
                            <img src="uploades/<?php echo $arrphoto[$max-6]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button class="textreg" name="del" value="<?php echo $arrid[$max-6]; ?>">Удалить заявку</button>
                            </from>
                        <?php elseif ($arrstatus[$max-6] == "1"): ?>
                            <p>Статус: решена</p>
                            <img src="uploades/<?php echo $arrphoto[$max-6]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button disabled class="textreg" name="del" value="<?php echo $arrid[$max-6]; ?>"><s>Удалить заявку</s></button>
                            </from>
                        <?php elseif ($arrstatus[$max-6] == "2"): ?>
                            <p>Статус: отклонена</p>
                            <img src="uploades/<?php echo $arrphoto[$max-6]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button disabled class="textreg" name="del" value="<?php echo $arrid[$max-6]; ?>"><s>Удалить заявку</s></button>
                            </from>
                        <?php endif; ?>                  
                </div>
            </div>
                <?php endif; ?> 
            <?php endif; ?> 
            <?php if ($max >= "7"): ?>
                <?php if ($showst == $arrstatus[$max-7] || $showst == 3): ?>
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                        <p>Номер заявки: <?php echo $arrid[$max-7]; ?> </p>
                        <p>Дата: <?php echo $arrdate[$max-7]; ?></p>
                        <p>Категория: <?php echo $arrcategory[$max-7]; ?></p>
                        <?php if ($arrstatus[$max-7] == "0"): ?>
                            <p>Статус: новая</p>
                            <img src="uploades/<?php echo $arrphoto[$max-7]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button class="textreg" name="del" value="<?php echo $arrid[$max-7]; ?>">Удалить заявку</button>
                            </from>
                        <?php elseif ($arrstatus[$max-7] == "1"): ?>
                            <p>Статус: решена</p>
                            <img src="uploades/<?php echo $arrphoto[$max-7]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button disabled class="textreg" name="del" value="<?php echo $arrid[$max-7]; ?>"><s>Удалить заявку</s></button>
                            </from>
                        <?php elseif ($arrstatus[$max-7] == "2"): ?>
                            <p>Статус: отклонена</p>
                            <img src="uploades/<?php echo $arrphoto[$max-7]; ?>" height="400" width="300" />
                            <form method="POST" action="delapp.php"> 
                            <button disabled class="textreg" name="del" value="<?php echo $arrid[$max-7]; ?>"><s>Удалить заявку</s></button>
                            </from>
                        <?php endif; ?>                  
                </div>
            </div>
                <?php endif; ?> 
            <?php endif; ?> 
        </div>
    </div>

    <?php
                    session_start(); // проверка на отправку отзыва
                    if ($_SESSION["message_true"] == true){
                        echo "<script>alert(\"Ваша заявка успешно отправлена!\");</script>"; 
                        $_SESSION["message_true"] = false;
                    }  
                    else if ($_SESSION["message_delete"] == true)  {
                        echo "<script>alert(\"Ваша заявка была успешно удалена!\");</script>"; 
                        $_SESSION["message_delete"] = false;
                    }   
                    $_SESSION["check_load"] = false;
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
</body>

</html>