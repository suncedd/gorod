<?php
require_once "db.php"; // подключение к бд
session_start();
$name = $_SESSION["user_name"];

$messages = $link->query("SELECT * FROM application");
$shcategory = $link->query("SELECT * FROM category");
$rez = $link->query("SELECT * FROM application WHERE id = '".mysqli_real_escape_string($link,$_POST["reg"])."'");


foreach ($rez as $key => $message) {
        $arrid[$key] = $message['id'];
        $arrdate[$key] = $message['date'];
        $arrcategory[$key] = $message['category'];
        $arrstatus[$key] = $message['status'];
        $arrphoto[$key] = $message['photo'];
        $arrphotoacc[$key] = $message['accphoto'];
}
$max = $key;
?>

<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Панель администратора</title>
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
    <div class="container">
        <h1>Панель администратора</h1>
        <h3>Список заявок</h3>
        <table>
        <tr>
          <td class="table">Номер</td>
          <td class="table">Название</td>
          <td class="table">Описание</td>
          <td class="table">Категория</td>
          <td class="table">Дата подачи</td>
          <td class="table">Статус</td>
          <td class="table">Просмотр информации</td>
        </tr>

        <?php foreach ($messages as $key => $message) /* заполнение таблицы данными*/ : ?> 
                <tr> 
                    <td><?= htmlspecialchars($message['id']) ?></td> 
                    <td><?= htmlspecialchars($message['name']) ?></td>
                    <td><?= htmlspecialchars($message['opis']) ?></td>
                    <td><?= htmlspecialchars($message['category']) ?></td>
                    <td><?= htmlspecialchars($message['date']) ?></td>
                    <?php if ($message['status'] == "0"): ?> 
                    <td><?= htmlspecialchars("Новая") ?></td>
                    <?php elseif ($message['status'] == "1"): ?>
                    <td><?= htmlspecialchars("Выполнена") ?></td> 
                    <?php elseif ($message['status'] == "2"): ?>
                    <td><?= htmlspecialchars("Отклонена") ?></td> 
                    <?php endif; ?>  
                    <form method="POST" action=""> 
                    <td><button name="reg" value="<?php echo $message['id']; ?>">Информация</button></td> 
                    </form>  
                </tr>
            <?php endforeach; ?>
      </table> 
        <br>


        <h3>Выбранная заявка</h3>                        

        <div class="row">
            <?php if ($arrid[$max] != null): ?>
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                        <p>Номер заявки: <?php echo $arrid[$max]; ?> </p>
                        <p>Дата: <?php echo $arrdate[$max]; ?></p>
                        <p>Категория: <?php echo $arrcategory[$max]; ?></p>
                        <?php if ($arrstatus[$max] == "0"): ?>
                            <p>Статус: новая</p>
                            <img src="uploades/<?php echo $arrphoto[$max]; ?>" height="400" width="300" />
                            <form method="POST" action="accept.php" enctype="multipart/form-data"> 
                            <p class="textreg">Фото решения</p>
                            <input required id="file-uploader" class="inputreg" type="file" accept="image/png, image/jpeg" name="photo">
                            <p id="feedback" ></p>           
                            <p id="image-grid"></p>
                            <button class="btn btn-primary btn-lg"  name="submit" value="<?php echo $arrid[$max]; ?>">Выполнить заявку</button>
                            </form>  
                            <br>  
                            <form method="POST" action="delappadmin.php"> 
                            <button class="btn btn-primary btn-lg" name="del" value="<?php echo $arrid[$max]; ?>">Удалить заявку</button>
                            </form>
                            <br>
                            <form method="POST" action="reject.php"> 
                            <button class="btn btn-primary btn-lg" name="reject" value="<?php echo $arrid[$max]; ?>">Отклонить заявку</button>
                            </form>
                        <?php elseif ($arrstatus[$max] == "1"): ?>
                            <p>Статус: выполнена</p> 
                            <img src="uploades/<?php echo $arrphoto[$max]; ?>" height="400" width="300" />
                            <p class="textreg">Фото решения</p>
                            <img src="uploades/<?php echo $arrphotoacc[$max]; ?>" height="400" width="300" />
                            <br>
                            <form method="POST" action="delappadmin.php"> 
                            <button class="btn btn-primary btn-lg" name="del" value="<?php echo $arrid[$max]; ?>">Удалить заявку</button>
                            </form>
                        <?php elseif ($arrstatus[$max] == "2"): ?> 
                            <p>Статус: отклонена</p> 
                            <img src="uploades/<?php echo $arrphoto[$max]; ?>" height="400" width="300" />
                            <br>
                            <form method="POST" action="delappadmin.php"> 
                            <button class="btn btn-primary btn-lg" name="del" value="<?php echo $arrid[$max]; ?>">Удалить заявку</button>
                            </form>   
                        <?php endif; ?>                  
                </div>
            </div> 
            <?php endif; ?>           
        </div>
    </div>

    <h3>Управление категориями заявок</h3>
        <table>
        <tr>
          <td class="table">Номер</td>
          <td class="table">Наименование</td>
          <td class="table">Редактирование</td>
          <td class="table">Удаление</td>
        </tr>

        <?php foreach ($shcategory as $rez => $show) /* заполнение таблицы данными*/ : ?> 
                <tr> 
                    <td><?= htmlspecialchars($show['id']) ?></td> 
                    <form method="POST" action="editcat.php"> 
                    <td><input name="text" value="<?= htmlspecialchars($show['name']) ?>" min="5" max="30"></td>
                    <td><button name="edit" value="<?php echo $show['id']; ?>">Изменить</button></td> 
                    </form> 
                    <form method="POST" action="delcat.php"> 
                    <td><button name="del" value="<?php echo $show['id']; ?>">Удалить</button></td> 
                    </form>   
                </tr>
            <?php endforeach; ?>
      </table> 

      <form method="POST" action="addnewcat.php"> 
      <h4>Добавить новую категорию:</h4>
      <p class="textreg">Наименование</p><input required class="catreg" name="name" type="text" min="5" max = "30">
      <input class="btn btn-primary btn-lg"  name="submit" type="submit" value="Добавить">
      </form>


    <?php
                    session_start(); // проверка на отправку отзыва
                    if ($_SESSION["message_delete"] == true)  {
                        echo "<script>alert(\"Заявка была успешно удалена!\");</script>"; 
                        $_SESSION["message_delete"] = false;
                    } 
                    else if ($_SESSION["message_accept"] == true)  {
                        echo "<script>alert(\"Вы успешно выполнили заявку!\");</script>"; 
                        $_SESSION["message_delete"] = false;
                    }  
                    else if ($_SESSION["message_reject"] == true)  {
                        echo "<script>alert(\"Вы успешно отклонили заявку!\");</script>"; 
                        $_SESSION["message_reject"] = false;
                    } 
                    else if ($_SESSION["message_accpet_cat"] == true)  {
                        echo "<script>alert(\"Вы успешно отредактировали категорию!\");</script>"; 
                        $_SESSION["message_accpet_cat"] = false;
                    }  
                    else if ($_SESSION["message_delete_cat"] == true)  {
                        echo "<script>alert(\"Вы успешно удалили категорию!\");</script>"; 
                        $_SESSION["message_delete_cat"] = false;
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
    <script src="js/addnewphoto.js"></script>
</body>

</html>