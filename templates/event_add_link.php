<?php

if(isset($_POST['butt']))
    {
      switch ($_GET[month]) {
        case 12:
            $month = "December";
            break;
        case 1:
            $month = "January";
            break;
            case 2:
                $month = "February";
                break;
                case 3:
                    $month = "March";
                    break;
                    case 4:
                        $month ="April";
                        break;
                        case 5:
                            $month = "May";
                            break;
                            case 6:
                                $month = "June";
                                break;
                                case 7:
                                    $month = "July";
                                    break;
                                    case 8:
                                        $month = "August";
                                        break;
                                        case 9:
                                            $month = "September";
                                            break;
                                            case 10:
                                                $month = "October";
                                                break;
                                                case 11:
                                                    $month =  "November";
                                                    break;
                                                }
        include 'api/config.php';

        $date = $_GET[year].'-'.$_GET[month].'-'.$_GET[date];

        $res = $link->query("INSERT INTO `events` (`name`, `provisions`, `date`, `direction`, `type`) VALUES ('" . $_POST['name'] . "', '" . $_POST['provisions'] . "', '" . $date . "', '" . $_POST['direction'] . "', 1);");
        header ('Location: /index.php');  // перенаправление на нужную страницу
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
<a href="event_add.php?date=<?php echo $_GET[date]?>&month=<?php echo $_GET[month]?>&year=<?php echo $_GET[year]?>">Положение в виде файла</a>
<a href="event_add_link.php?date=<?php echo $_GET[date]?>&month=<?php echo $_GET[month]?>&year=<?php echo $_GET[year]?>">Положение в виде ссылки</a>
<?php endif;?>
<?php include 'api/session.php';
        if ($roles == 'moderator'):?>
<a href="/event_add.php?date=<?php echo $_GET[date]?>&month=<?php echo $_GET[month]?>&year=<?php echo $_GET[year]?>">Положение в виде файла</a>
<a href="/event_add_link.php?date=<?php echo $_GET[date]?>&month=<?php echo $_GET[month]?>&year=<?php echo $_GET[year]?>">Положение в виде ссылки</a>
<?php endif;?>
<a class="a-header" href="logout.php">Выйти</a>
</div>


    <?php endif;?>
<div id="range2">

<div class="outer">
  <div class="middle">
    <div class="inner">

        <div class="login-wr">
          <h2>Дабавить мероприятие</h2>
          
          <form class="form" action="" method="post">
            <input type="text" name = "name" placeholder="Название мероприятия">
            <input type="text" name = "provisions"  placeholder="Направление">
            <input type="text" name = "direction"  placeholder="Положение">
            
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