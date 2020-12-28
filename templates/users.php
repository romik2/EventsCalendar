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
    <a href="users_add.php">Добавить пользователя</a>
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
    <th>Фамилия</th>
	<th>Имя</th>
	<th>Отчество</th>
    <th>Логин</th>
    <th>Пароль</th>
    <th>Роль</th>
    <th>Действие</th>
</tr>
</thead>
<tbody>
    <?php
    
    include 'api/config.php';
    $res = $link->query("SELECT id, firstname, name, patronomyc, login, password, roles From users");

    $i = 1;
    while($row = $res->fetch_assoc()):
    ?>
<tr>
    <td><?php echo $i?></td>
    <td><?php echo $row['firstname']?></td>
	<td><?php echo $row['name']?></td>
    <td><?php echo $row['patronomyc']?></td>
    <td><?php echo $row['login']?></td>
    <td><?php echo $row['password']?></td>
    <td><?php echo $row['roles']?></td>
    <td><a href="">Редактировать</a> | <a href="api/delUsers.php?id=<?php echo $row['id']?>">Удалить</a></td>
</tr>
<?php $i++; endwhile;?>
</tbody>
</table>
</body>
