<?php

if(isset($_POST['submit']))
    {      
        include 'api/config.php';

        $uploaddir = 'uploads/';
        $uploadfile = $uploaddir . basename($_FILES['userfiles']['name']);

        if (move_uploaded_file($_FILES['userfiles']['tmp_name'], $uploadfile)) {
          $direction = 'uploads/'.$_FILES['userfiles']['name'];
        }
        

        $res = $link->query("UPDATE `EventsCalendar`.`participants_users` SET `direction` = '".$direction."' WHERE `id` = '".$_GET['id']."' and `id_events` = '".$_GET['id_ev']."';");
        header ('Location: confirmation_std.php?id='.$_GET['id_ev']);  // перенаправление на нужную страницу
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

<a class="a-header" href="logout.php">Выйти</a>
</div>


    <?php endif;?>
<div id="range2">

<div class="outer">
  <div class="middle">
    <div class="inner">

        <div class="login-wr">
          <h2>Прикрепление файла</h2>
          <!-- Тип кодирования данных, enctype, ДОЛЖЕН БЫТЬ указан ИМЕННО так -->

          <form class="form" enctype="multipart/form-data" action="" method="POST">
        
          <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
          <input name="userfiles" type="file" />
            
            <br><br>
            <button name="submit"> Добавить </button>
          </form>
        </div>

    </div>
  </div>
</div>

</div>
</body>
</html>