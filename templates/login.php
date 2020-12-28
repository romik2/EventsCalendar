<?php 

	include 'api/config.php';
	function generate_string($input, $strength = 16) {
		$input_length = strlen($input);
		$random_string = '';
		for($i = 0; $i < $strength; $i++) {
			$random_character = $input[mt_rand(0, $input_length - 1)];
			$random_string .= $random_character;
		}
	 
		return $random_string;
	}
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
	$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';	

	if ($row[0] == 1)
	{
		$values = generate_string($permitted_chars, 20);
		setcookie("session", $values, time() + 7200, '/');  /* срок действия 1 час */
		$link->query("UPDATE users
            SET session = '" . $values . "'
			WHERE ip = '" . $value . "'");
		   header ('Location: /index.php');  // перенаправление на нужную страницу
		   exit;
	}

	if (isset($_POST['button']))
	{
		$login = $_POST['login']; //Логин пользователя
		$password = $_POST['password']; // Пароль пользователя

		$res = $link->query("SELECT password From users Where login = '" . $login . "'");


		$row = $res->fetch_row();

		if ($password == $row[0] && $password != "unset") {
			$values = generate_string($permitted_chars, 20);
		setcookie("session", $values, time() + 7200, '/');  /* сок действия 1 час */
		$link->query("UPDATE users
            SET session = '" . $values . "'
			WHERE login = '" . $login . "'");
		   header ('Location: /index.php');  // перенаправление на нужную страницу
		   exit;
		}
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
		<form action="" method="POST">
		
			<h1>Авторизация</h1>
			<div>
				<input type="text" placeholder="Username" name="login" required="" id="username" />
			</div>
			<div>
				<input type="password" placeholder="Password" name="password" required="" id="password" />
			</div>
			<div>
				 <input type="submit" name="button" value="Войти" />
                <a href="/index.php">Назад</a>				
			</div>
		</form><!-- form -->
		
	</section><!-- content -->
</div><!-- container -->
</body>
</html>