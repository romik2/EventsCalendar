<?php

    include 'config.php';

    $res = $link->query("SELECT roles, id From users WHERE session='".$_COOKIE['session']."'");

    $row = $res->fetch_row();
    $roles = $row[0];
    $id = $row[1];
    if ($roles == "")
    {
        if (isset($_SERVER['HTTP_COOKIE'])) { //do we have any
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']); //get all cookies 
            foreach ($cookies as $cookie) { //loop
                $parts = explode('=', $cookie); //get the bits we need
                $name = trim($parts[0]);
                setcookie($name, '', time() - 1000); //kill it
                setcookie($name, '', time() - 1000, '/'); //kill it more
            }
        }
        
        
        header ('Location: /index.php');  // перенаправление на нужную страницу
        exit;
    }
?>