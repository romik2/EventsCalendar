<?php

  if(isset($_POST['saveStud']))
      {
        include 'api/config.php';
        include 'api/session.php';
        
        $i = 1;
        while ($i < $_GET['stud']+1)
        {
          $res = $link->query("INSERT INTO `EventsCalendar`.`participants` (`firstnamenamepatronomyc`) VALUES ('".$_POST['FIO'.$i]."');");
          $res = $link->query("Select max(`id`) as `maxid` from `participants`");
          $row = $res->fetch_row();
          $id_participants = $row[0];
          $result = $link->query("INSERT INTO `EventsCalendar`.`participants_users` (`id_participants`, `id_teacher`, `id_events`) VALUES ('".$id_participants."', '".$id."', '".$_GET['id']."');");
          $i++;
        }
        header ('Location: /index.php'); 
        exit();
      }
  if (isset($_POST['addStud']))
      {
          

        $i = 1;
        while($i < $_GET['stud'] + 1)
        {
          $arr[$i] = $_POST['FIO'.$i];
          $i++;
        }
          $text = implode('|', $arr);
          print_r( $arr);
          //путь к файлу
          $path = 'date'.$_COOKIE['session'].'.txt';
          //создаем файл и открываем его для записи
          $file = fopen($path,'w');
          //Записываем строку в файл
          $write = fwrite($file, $text);
          
          //закрываем файл
          fclose($file);

        if (isset($_GET['stud']))
        {
          $stud = $_GET['stud'] + 1;
         header ('Location: participation.php?id='.$_GET[id].'&stud='.$stud.'&h=1');  
        }
        else{
          header ('Location: participation.php?id='.$_GET[id].'&stud=1'); 
        }
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
    <link href="css/parti.css" rel="stylesheet" type="text/css" />
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

    <br><br><br><br>
          <!-- Тип кодирования данных, enctype, ДОЛЖЕН БЫТЬ указан ИМЕННО так -->
          <?php if(isset($_GET['h'])):?>
          <form class="" action="" method="POST">
            <?php
            $file_handle = fopen("date".$_COOKIE['session'].".txt", "r");
            while (!feof($file_handle)) {
               $line = fgets($file_handle);
            }
            $arr = explode("|", $line);
            fclose($file_handle);
            $i = 1;
            $b = $_GET['stud']+1;
            while ($i < $b):
            ?>
            <label for="fname4">Фамилия Имя Отчество (Участник <?php echo $i?>)</label>
            <input type="text" id="fname4" value = "<?php if (isset($arr[$i-1])) echo $arr[$i-1];?>" name="FIO<?php echo $i;?>" class="inputborder">
            <?php $i++; endwhile;?>
            <button name = "addStud" class="button">Добавить</button>
            <button name = "saveStud" class="button">Занести</button>
          </form>
          <?php endif;?>

          <?php if(!isset($_GET['h'])):?>
          <form class="" action="" method="POST">
            <?php
            $i = 1;
            $b = $_GET['stud']+1;
            while ($i < $b):
            ?>
            <label for="fname4">Фамилия Имя Отчество (Участник <?php echo $i?>)</label>
            <input type="text" id="fname4" name="FIO<?php echo $i;?>" class="inputborder">
            <?php $i++; endwhile;?>
            <button name = "addStud" class="button">Добавить</button>
            <button name = "saveStud" class="button">Занести</button>
          </form>
          <?php endif;?>
</div>
</body>
</html>
