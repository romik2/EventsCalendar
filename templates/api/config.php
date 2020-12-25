<?php
$host = 'localhost'; //в кавчках введите адрес сервера 
$database = 'EventsCalendar'; //в кавчках введите имя базы данных
$user = 'root'; //в кавчках введите имя пользователя
$password = 'admins1N'; //в кавчках введите пароль

$link = mysqli_connect($host, $user, $password, $database) //Подключение к БД
    or die("Ошибка " . mysqli_error($link));//Проверям были ли ошибки

$link->set_charset('utf8');//Ставим кадировки UTF-8
?>