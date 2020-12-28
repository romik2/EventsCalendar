<?php

    if(isset($_POST['butt']))
    {
        include 'api/config.php';
        $res = $link->query("INSERT INTO `users` (`firstname`, `name`, `patronomyc`, `login`, `password`, `roles`, `ip`) VALUES ('" . $_POST['firstname'] . "', '" . $_POST['name'] . "', '" . $_POST['patronomyc'] . "', '" . $_POST['login'] . "', '" . $_POST['password'] . "', '" . $_POST['roles'] . "', '" . $_POST['ip'] . "' );");
    }


?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta name="author" content="Script Tutorials" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>Календарь мероприятий</title>

    <!-- add styles and scripts -->
    <link href="css/event_add.css" rel="stylesheet" type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
</head>
<body>
<?php if (!isset($_COOKIE['session'])):?>


<div class="navbar">
<a href="/index.php">Главная</a>
<a class="a-header" href="login.php">Авторизация</a>
</div>


<?php endif; if(isset($_COOKIE['session'])):?>


    <div class="navbar">
<a href="/index.php">Главная</a>
<?php include 'api/session.php';
        if ($roles == 'admin'):?>
<?php endif;?>
       
<a class="a-header" href="logout.php">Выйти</a>
</div>


    <?php endif;?>
<div id="range2">

<div class="outer">
  <div class="middle">
    <div class="inner">

        <div class="login-wr">
          <h2>Дабавить пользователя</h2>
          <form class="form" action="" method="post">
            <input type="text" name = "firstname" placeholder="Фамилия">
            <input type="text" name = "name" placeholder="Имя">
            <input type="text"  name = "patronomyc" placeholder="Отчество">
            <input type="text" name = "login" placeholder="Логин">
            <input type="text" name = "password" placeholder="Пароль">
            <select class="select-css" name="roles">
            <option selected  disabled>Выберите роль</option>
            <option value="admin">Администратор</option>
            <option value="moderator">Модератор</option>
            <option value="user">Пользователь</option>
            </select>
            <br>
            <input type="text" name = "ip" placeholder="Доверенный IP">
            
            <br><br>
            <button name="butt"> Добавить </button>
          </form>
        </div>

    </div>
  </div>
</div>

</div>
</body>
</html>