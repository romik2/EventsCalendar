<?php
    include 'api/config.php';
    if(isset($_POST['butt']))
    {
        $res = $link->query("UPDATE `EventsCalendar`.`users` SET `firstname` = '".$_POST['firstname']."', `name` = '".$_POST['name']."', `patronomyc` = '".$_POST['patronomyc']."', `login` = '".$_POST['login']."', `password` = '".$_POST['password']."', `roles` = '".$_POST['roles']."', `ip` = '".$_POST['ip']."' WHERE (`id` = '".$_GET[id]."');");
        header ('Location: users.php');  // перенаправление на нужную страницу
        exit;
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
<?php   

$res = $link->query("SELECT id, name, firstname, patronomyc, login, password, roles, ip From users WHERE id = '".$_GET[id]."'");
        $row = $res->fetch_assoc();

?>
        <div class="login-wr">
          <h2>Дабавить пользователя</h2>
          <form class="form" action="" method="post">
            <input type="text" name = "firstname" placeholder="Фамилия" value="<?php echo $row['firstname']; ?>">
            <input type="text" name = "name" placeholder="Имя" value="<?php echo $row['name']; ?>">
            <input type="text"  name = "patronomyc" placeholder="Отчество" value="<?php echo $row['patronomyc']; ?>">
            <input type="text" name = "login" placeholder="Логин" value="<?php echo $row['login']; ?>">
            <input type="text" name = "password" placeholder="Пароль" value="<?php echo $row['password']; ?>">
            <?php if($row['roles'] == 'admin'): ?>
            <select class="select-css" name="roles" >
            <option disabled>Выберите роль</option>
            <option selected value="admin">Администратор</option>
            <option value="moderator">Модератор</option>
            <option value="user">Пользователь</option>
            </select>
            <?php endif; ?>
            <?php if($row['roles'] == 'moderator'): ?>
            <select class="select-css" name="roles" >
            <option disabled>Выберите роль</option>
            <option value="admin">Администратор</option>
            <option selected value="moderator">Модератор</option>
            <option value="user">Пользователь</option>
            </select>
            <?php endif; ?>
            <?php if($row['roles'] == 'user'): ?>
            <select class="select-css" name="roles" >
            <option disabled>Выберите роль</option>
            <option value="admin">Администратор</option>
            <option value="moderator">Модератор</option>
            <option selected value="user">Пользователь</option>
            </select>
            <?php endif; ?>
            <br>
            <input type="text" name = "ip" placeholder="Доверенный IP" value="<?php echo $row['ip']; ?>">
            
            <br><br>
            <button name="butt"> Изменить </button>
          </form>
        </div>

    </div>
  </div>
</div>

</div>
</body>
</html>