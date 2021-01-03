<style>
    * {
    margin: 0;
    padding: 0;
}
	/* Стили таблицы (IKSWEB) */
	table.iksweb{text-decoration: none;border-collapse:collapse;width:100%;text-align:center;}
	table.iksweb th{font-weight:normal;font-size:14px; color:#ffffff;background-color:#354251;}
	table.iksweb td{font-size:13px;color:#354251;}
	table.iksweb td,table.iksweb th{white-space:pre-wrap;padding:19px 5px;line-height:13px;vertical-align: middle;border: 1px solid #354251;}	table.iksweb tr:hover{background-color:#f9fafb}
    table.iksweb tr:hover td{color:#354251;cursor:default;}
    .navbar {
    overflow: hidden;
    background-color: #333;
    position: fixed; /* Set the navbar to fixed position */
    top: 0; /* Position the navbar at the top of the page */
    width: 100%; /* Full width */
    }

    /* Links inside the navbar */
    .navbar a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    /* Change background on mouse-over */
    .navbar a:hover {
        background: #ddd;
        color: black;
    }

</style>
<?php 
 switch ($_GET['month']) {
    case "December":
        $month = 12;
        break;
    case "January":
        $month = 1;
        break;
        case "February":
            $month = 2;
            break;
            case "March":
                $month = 3;
                break;
                case "April":
                    $month = 4;
                    break;
                    case "May":
                        $month = 5;
                        break;
                        case "June":
                            $month = 6;
                            break;
                            case "July":
                                $month = 7;
                                break;
                                case "August":
                                    $month = 8;
                                    break;
                                    case "September":
                                        $month = 9;
                                        break;
                                        case "October":
                                            $month = 10;
                                            break;
                                            case "November":
                                                $month = 11;
                                                break;
                                            }?>
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
    <a href="event_add.php?date=<?php echo $_GET[date]?>&month=<?php echo $month?>&year=<?php echo $_GET[year]?>">Добавить мероприятие</a>
    <a class="a-header" href="event_read.php">Просмотр участников</a>
    <?php endif;?>
    <?php include 'api/session.php';
            if ($roles == 'moderator'):?>
    <a href="/event_add.php?date=<?php echo $_GET[date]?>&month=<?php echo $month?>&year=<?php echo $_GET[year]?>">Добавить мероприятие</a>
    <a class="a-header" href="event_read.php">Просмотр участников</a>
    <?php endif;?>
    <a class="a-header" href="logout.php">Выйти</a>
    </div>

    
        <?php endif;?>


   
</body>

<body>
<br><br><br>
<table class="iksweb">
<thead>
<tr>
    <th>Номер</th>
    <th>Направление</th>
	<th>Название конкурса</th>
	<th>Положение</th>
    <th>Действия</th>
</tr>
</thead>
<tbody>
    <?php
    
    include 'api/config.php';

   
                                                
    $date = $_GET['year'].'-'.$month.'-'.$_GET['date'];

    $res = $link->query("SELECT id, name, provisions, direction, type From events WHERE date='".$date."'");

    $i = 1;
    while($row = $res->fetch_assoc()):
    ?>
<tr>
    <td><?php echo $i?></td>
    <td><?php echo $row['provisions']?></td>
    <td><?php echo $row['name']?></td>
    <?php if ($row['type'] == 1):?>
    <td><a href="<?php echo $row['direction']?>">Перейти</a></td>
    <?php endif;?>
    <?php if ($row['type'] == 0):?>
    <td><a href="<?php echo $row['direction']?>" download>Скачать</a></td>
    <?php endif;?>

    <?php 
            if ($roles == 'admin'):?>
    <td><a href="participation.php?id=<?php echo $row['id']?>&stud=1">Заполнить участников</a> | <a href="confirmation_std.php?id=<?php echo $row['id']?>">Подтверждение участия</a> | <a href="api/delEvent.php?id=<?php echo $row['id']?>">Удалить</a> | <a href="event_reads.php?id=<?php echo $row['id']?>">Список участников</a></td>
    <?php endif;?>
    <?php 
            if ($roles == 'moder'):?>
    <td><a href="participation.php?id=<?php echo $row['id']?>&stud=1">Заполнить участников</a> | <a href="confirmation_std.php?id=<?php echo $row['id']?>">">Подтверждение участия</a> | <a href="api/delEvent.php?id=<?php echo $row['id']?>">Удалить</a> | <a href="event_reads.php?id=<?php echo $row['id']?>">Список участников</a></td>
    <?php endif;?>
    
</tr>
<?php $i++; endwhile;?>
</tbody>
</table>
</body>
