<?php 

	include 'api/config.php';
			$value = '';
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$value = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$value = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} elseif (!empty($_SERVER['REMOTE_ADDR'])) {
		$value = $_SERVER['REMOTE_ADDR'];
	}
	
	$res = $link->query("SELECT count(id) From users WHERE ip='".$value."'");

	$row = $res->fetch_row();	
	if ($row[0] == 1)
	{
		$values = rand(999, 99999);
		setcookie("session", $values, time() + 7200, '/');  /* срок действия 1 час */
		$link->query("UPDATE users
            SET session = '" . $values . "'
			WHERE ip = '" . $value . "'");
		   header ('Location: /index.php');  // перенаправление на нужную страницу
	}
?>

<!DOCTYPE html>

<html lang="ru">
<head>
<meta charset="utf-8">
<title>Календарь мероприятий</title>
<link rel="stylesheet" type="text/css" href="css/login.css" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="">
		
			<h1>Авторизация</h1>
			<div>
				<input type="text" placeholder="Username" required="" id="username" />
			</div>
			<div>
				<input type="password" placeholder="Password" required="" id="password" />
			</div>
			<div>
                <input type="submit" value="Войти" />
                <a href="/index.php">Назад</a>				
			</div>
		</form><!-- form -->
		
	</section><!-- content -->
</div><!-- container -->
</body>
</html>