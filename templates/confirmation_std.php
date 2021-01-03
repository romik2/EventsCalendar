<?php

if(isset($_POST['submit']))
    {
        include 'api/config.php';
        include 'api/session.php';
        $res = $link->query("Select participants_users.id_participants FROM participants_users INNER JOIN participants ON participants.id = participants_users.id_participants WHERE participants_users.id_events=".$_GET['id']." and participants_users.id_teacher=".$id."");
        $i = 1;
        while($row = $res->fetch_assoc())
        {
            $arr[$i] = $row['id_participants'];
            $i++;
        }
        print_r($arr);
        $i = 1;
        while ($i < count($arr)){
            $uploaddir = 'uploads/';
            $uploadfile = $uploaddir . basename($_FILES['userfile'.$i]['name']);
    
            if (move_uploaded_file($_FILES['userfile'.$i]['tmp_name'], $uploadfile)) {
              $direction = 'uploads/'.$_FILES['userfile'.$i]['name'];
            }
    
           // $res = $link->query("");
            $i++;
        }
       
        // header ('Location: confirmation_std.php?'.$_GET['id']);  // перенаправление на нужную страницу
        // exit;
    }

?>


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
    .button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
}
</style>

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


   
</body>

<body>
<br><br><br>
<table class="iksweb">
<thead>
<tr>
    <th>Номер</th>
    <th>Фамилия Имя Отчество</th>
    <th>Прикрепить документ</th>
</tr>
</thead>
<tbody>
    <?php
    
    include 'api/config.php';
    include 'api/session.php';

    $res = $link->query("Select participants.firstnamenamepatronomyc, participants.id FROM participants_users INNER JOIN participants ON participants.id = participants_users.id_participants WHERE participants_users.id_events=".$_GET['id']." and participants_users.id_teacher=".$id." ");

    $i = 1;
    while($row = $res->fetch_assoc()):
    ?>
<tr>
    <td><?php echo $i?></td>
    <td><?php echo $row['firstnamenamepatronomyc']?></td>
    <?php 
            if ($roles == 'admin'):?>
    <td>
    <a href="participation_file.php?id=<?php echo $row['id']?>&id_ev=<?php echo $_GET['id']?>">Прикрепить файл</a>
    </td>
    <?php endif;?>
    
    
</tr>
<?php $i++; endwhile;?>

</tbody>
</table>
</body>
